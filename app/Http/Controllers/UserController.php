<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;

use Mail;

class UserController extends Controller
{

	public function createUser(Request $req)
	{

		$data = $req->validate([
			'email' => ['email', 'unique:users'],
			'username' => ['unique:users'],
			'password' => ['min:8'],
			'first_name' => ['required'],
			'last_name' => ['required'],
		]);

		$user = User::create([
			"username" => $data['username'],
			"first_name" => $data['first_name'],
			"last_name" => $data['last_name'],
			"email" => $data['email'],
			"password" => Hash::make($data['password']),
		]);


		//permissions
		$permissions = [];
		foreach ($req->permissions as $k => $v) {
			if ($v) {
				$permissions[] = $k;
			}
		}
		$permissions = Permission::whereIn('name', $permissions)->get();

		$user->permissions()->attach($permissions, ['remarks' => 'permitted by ' . Auth::user()->username]);

		return response()->json(["message" => "User Created!"], 201);
	}

	public function modifyUser($id, Request $req)
	{
		$data = $req->validate([
			'email' => ['email',  'required', 'unique:users,email,' . $id],
			'username' => ['required', 'unique:users,username,' . $id],
			'first_name' => ['required'],
			'last_name' => ['required'],
		]);

		$user = User::find($id);


		$user->update([
			"username" => $data['username'],
			"first_name" => $data['first_name'],
			"last_name" => $data['last_name'],
			"email" => $data['email']
		]);

		if (isset($req->password)) {

			$data = $req->validate([
				'password' => ['min:6'],
			]);

			$user->update([
				"password" => Hash::make($data['password']),
			]);
		}

		if (isset($req->photo) && $req->photo != "") {
			if (str_contains($req->photo, 'data:image/png;base64,')) {
				$img = str_replace('data:image/png;base64,', '', $req->photo);
				$img = str_replace(' ', '+', $img);
				$type = "png";
			} elseif (str_contains($req->photo, 'data:image/jpeg;base64,')) {
				$img = str_replace('data:image/jpeg;base64,', '', $req->photo);
				$img = str_replace(' ', '+', $img);
				$type = "jpg";
			}
			$photoName = $user->username . '_' . uniqid() . '.' . $type;
			Storage::disk('profile')->put($photoName, base64_decode($img));
			$photoUrl = Storage::disk('profile')->url($photoName);

			if (isset($user->photo) && !empty($user->photo)) {
				$photoArr = explode('/', $user->photo);
				Storage::disk('profile')->delete($photoArr[count($photoArr) - 1]);
			}

			$user->update([
				"photo" => $photoUrl,
			]);
		}


		//permissions
		if (isset($req->permissions)) {
			$permissions = [];
			foreach ($req->permissions as $k => $v) {
				if ($v) {
					$permissions[] = $k;
				}
			}
			$permissions = Permission::whereIn('name', $permissions)->get();

			$user->permissions()->detach();

			$user->permissions()->attach($permissions, ['remarks' => 'permitted by ' . Auth::user()->username]);
		}

		return response()->json($user, 200);
	}

	public function deleteUser($id)
	{
		$user = User::find($id);
		$user->permissions()->detach();
		$user->delete();

		return response()->json(["message" => "User Deleted!"], 200);
	}

	public function register(Request $req)
	{
		$user = User::create([
			"username" => $req->username,
			"first_name" => $req->first_name,
			"last_name" => $req->last_name,
			"email" => $req->email,
			"password" => Hash::make($req->password),
		]);

		if ($user) {
			$token = $user->createToken("token")->plainTextToken;

			$cookie = cookie("jwt", $token);

			return response()->json(compact("user"))->withCookie($cookie);
		}

		return response()->json(["error" => "Something went wrong"], 500);
	}

	public function login(Request $req)
	{

		if (!Auth::attempt($req->only("username", "email", "password"))) {
			return response()->json(["error" => "Invalid Credential"], Response::HTTP_UNAUTHORIZED);
		}

		$user = Auth::user();

		$token = $user->createToken("token")->plainTextToken;

		$cookie = cookie("jwt", $token);

		//log

		return response()->json(["message" => "Welcome to " . env('APP_NAME'), "authToken" => "Authenticated"])->withCookie($cookie);
	}

	public function user()
	{
		$user = Auth::user();
		$user->permissions;
		return response()->json($user);
	}

	public function users(Request $req)
	{
		$sort = $req->sort;
		$order = $req->order;
		$filter = $req->filter;
		$perPage = $req->perPage;
		$page = $req->page;
		$userID = $req->userID;

		$query = User::with('permissions')
			->withCount('permissions')
			->orderBy($sort, $order);

		if (isset($userID) && $userID != "") {
			$query->where('id', $userID);
		}

		if (isset($filter) && $filter != "") {
			$query->where('first_name', 'LIKE', '%' . $filter . '%')
				->orWhere('username', 'LIKE', '%' . $filter . '%')
				->orWhere('last_name', 'LIKE', '%' . $filter . '%')
				->orWhere('email', 'LIKE', '%' . $filter . '%');
		}

		$query = $query->paginate($perPage, ['*'], 'page', $page);

		return response()->json($query);
	}

	public function photout()
	{
		//log

		$cookie = Cookie::forget("jwt");
		return response()->json(["message" => "Thank you, see you soon!"])->withCookie($cookie);
	}

	public function forgot(Request $req)
	{
		$credentials = $req->validate(['email' => 'required|email']);

		$user = User::where('email', $req->email)->first();
		if (!empty($user)) {

			$token = $this->generateRandomString(10);

			$passRes = DB::table('password_resets')
				->where(['email' => $req->email])
				->first();

			if( $passRes ) 
			{	
				DB::table('password_resets')
					->where(['email' => $req->email])
					->update(["token" => $token, "created_at" => date("Y-m-d H:i:s")]);
			}
			else
			{
				DB::table('password_resets')
				->insert(['email' => $req->email, "token" => $token, "created_at" => date("Y-m-d H:i:s")]);
			}

			$email = $req->email;
			$emailSent = Mail::send('emails.passwordreset', ['token' => $token], function ($message) use ($email) {
                $message->from('nxt@nxt.work', 'Inspire Class App Reset Password');
            
                $message->to($email)->cc('orlan@nxt.work')->subject("Inspire Class App Reset Password");
            });

			// Password::sendResetLink($credentials);
			return response()->json(["msg" => 'Reset password link sent on your email.']);
		} else {
			return response()->json(["msg" => "not found"], 400);
		}
	}

	public function reset(Request $req)
	{
		$credentials = $req->validate([
			'token' => 'required|string',
			'password' => 'required|string'
		]);

		$passRes = DB::table('password_resets')
			->where(['email' => $req->email])
			->first();

		if ($req->token === $passRes->token) {
			$user = User::where('email', $passRes->email)->first();
			$user->password = Hash::make($req->password);
			$user->save();
			DB::table('password_resets')
				->where(['email' => $req->email])
				->delete();
			return response()->json(["msg" => "Password has been successfully changed"]);
		} else {
			return response()->json(["msg" => "Invalid token provided"], 400);
		}
	}

	public function listUsers( Request $request )
	{
		$users = User::orderBy('first_name')->select('id', 'first_name', 'last_name')->get()->toArray();

		return response()->json(["users" => $users], 200);
	}

	public function getPermissions( Request $request )
	{
		$permissions = Permission::select('id', 'name')->get()->toArray();
		return response()->json(compact('permissions'), 200);

	}

	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
