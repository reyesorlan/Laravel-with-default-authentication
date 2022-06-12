<?php

namespace App\Http\Traits;

use App\Models\ApiAuth;
use Carbon\Carbon;

trait MBTrait
{
    static function getDatas($route, $target, $ids, $page = false)
    {
        $targetSplit =  explode('.', $target);
        $data = [];
        $offset = 0;
        $count = 0;
        $resOffset = 1;
        foreach ($ids as $k => $v) {
            $routeID = $route . $v;

            $items = [];
            if ($page) {
                while ($offset < $resOffset) {
                    $routeID = $routeID . "&limit=200&offset=" . $offset;
                    $res = self::curlFetch($routeID);
                    if (isset($res["PaginationResponse"])) {
                        $resOffset = $res["PaginationResponse"]['TotalResults'];

                        $items = array_merge($items, $res[$target]);

                        $count++;
                        $offset = ($count * 200) + 1;
                    } else {
                        break;
                    }
                }

                foreach ($items as $key => $value) {
                    $items[$key]['client_id'] =  $v;
                }

                $data = array_merge($data, $items);
            } else {

                $res = self::curlFetch($routeID);
                if (!isset($res['Error'])) {
                    $items = $res;
                    foreach ($targetSplit as $key => $value) {
                        $items = $items[$value];
                    }
                    $data = array_merge($data, $items);
                }
            }
        }


        return $data;
    }

    static function getData($route, $target)
    {
        $offset = 0;
        $count = 0;
        $resOffset = 1;
        $data = [];

        while ($offset < $resOffset) {
            $res = self::curlFetch($route, $offset);
            if (isset($res["PaginationResponse"])) {
                $resOffset = $res["PaginationResponse"]['TotalResults'];

                $data = array_merge($data, $res[$target]);

                $count++;
                $offset = ($count * 200) + 1;
            } else {
                break;
            }
        }

        return $data;
    }

    private static function curlFetch($route, $offset = null)
    {
        $token = self::getToken();
        $curl = curl_init();

        $fullRoute = $route;
        if (isset($offset))
            $fullRoute = $route . '?limit=200&offset=' . $offset;

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mindbodyonline.com/public/v6' . $fullRoute,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Api-Key: ' . env("MB_API_KEY"),
                'SiteId: ' . env('MB_SITE_ID'),
                'authorization: ' . $token,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

    private static function getToken()
    {
        try {
            $mb = ApiAuth::where('type', 'MB')->first();
            if (Carbon::parse($mb->created_at)->diffInMinutes(now()) > 60) {
                return self::getAccessToken();
            } else {
                return $mb->token;
            }
        } catch (\Throwable $th) {
            return self::getAccessToken();
        }
    }

    private static function getAccessToken()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.mindbodyonline.com/public/v6/usertoken/issue',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "Username":"' . env('MB_USERNAME') . '",
                "Password":"' . env('MB_PASSWORD') . '"
            }',
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Api-Key: ' . env("MB_API_KEY"),
                'SiteId: ' . env('MB_SITE_ID'),
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $res =  json_decode($response);

        if (isset($res->AccessToken)) {
            ApiAuth::where('type', "MB")->delete();
            $data = [
                'token' => $res->AccessToken,
                'type' => "MB"
            ];
            ApiAuth::create($data);
            return $res->AccessToken;
        } else
            return false;
    }
}
