<?php

namespace App\Http\Traits;

trait UtilsTrait
{
    static function to_snake_case($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('_', $ret);
    }

    static function optimizeKeys($arr)
    {
        $reArr = [];

        if (isset($arr['customer'])) {
            foreach ($arr['customer'] as $key => $val) {
                $temp = [];
                foreach ($val as $k => $v) {
                    if ($k == 'custNo') {
                        $temp['octane_id'] = $v;
                    } else {
                        $temp[self::to_snake_case($k)] = $v;
                    }
                }

                if (!empty($temp)) {
                    $reArr[] = $temp;
                }
            }
        } else {
            foreach ($arr as $key => $val) {
                if (!empty($val)) {
                    $reArr[self::to_snake_case($key)] = $val;
                }
            }
        }


        return $reArr;
    }
}
