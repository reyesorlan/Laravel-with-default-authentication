<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nookal_API;
use Carbon\Carbon;

class NookalController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 28800);
        Nookal_API::apiKey(env('NOOKAL_API_KEY'));
    }

    public function getPatients()
    {
        $hasNextPage = true;
        $page = 1;

        $patients = [];

        while ($hasNextPage) {
            $res = Nookal_API::gateway()->patients([
                "page_length" => 200,
                "page" => $page,
            ]);
            $items = $res->children();
            $hasNextPage = $res->hasNextPage();
            foreach ($items as $key => $val) {
                $data = [
                    "api" => 'nkl',
                    "uid" => $val->ID(),
                    "first_name" => $val->firstName(),
                    "middle_name" => $val->middleName(),
                    "nick_name" => $val->nickName(),
                    "last_name" => $val->lastName(),
                    "birth_date" => $val->DOB() == '0000-00-00' ? null : $val->DOB(),
                    "gender" => $val->gender(),
                    "email" => $val->email(),
                    "mobile_phone" => $val->mobile(),

                    "address_line_1" => $val->address()->addressLine1(),
                    "address_line_2" => $val->address()->addressLine2(),
                    "city" => $val->address()->city(),
                    "state" => $val->address()->state(),
                    "country" => $val->address()->country(),
                    "postal_code" => $val->address()->postcode(),
                    "online_code" => $val->onlineCode(),
                    "creation_date" => $val->dateCreated(),
                    "last_modified_date_time" => $val->dateModified(),
                ];
                array_push($patients, $data);
                // TempPatient::create($data);
            }

            $page++;
        }

        return response()->json(compact('patients'), 200);
    }

}
