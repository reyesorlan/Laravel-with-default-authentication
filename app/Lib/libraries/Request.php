<?php

/**
 * Created by PhpStorm.
 * User: James Fulton
 * Date: 7/12/2017
 * Time: 3:24 PM
 */

class Nookal_Request extends Nookal_Base
{


    /**
     * Builds the request and sends it to the Nookal API Servers
     *
     * @param $data
     * @param $url
     * @return mixed
     * @throws Exception
     */
    public static function request($data, $url)
    {

        if (!is_array($data)) {

            throw new Exception('Required data is missing');
        }

        $data   = http_build_query($data);

        $ch        = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL                 => $url,
            CURLOPT_CONNECTTIMEOUT      => 0,
            CURLOPT_TIMEOUT                => 3000,
            CURLOPT_HTTPHEADER             => array('Content-Type: application/x-www-form-urlencoded; charset=UTF-8', 'Content-Length: ' . strlen($data)),
            CURLOPT_CUSTOMREQUEST        => "POST",
            CURLOPT_POSTFIELDS          => $data,
            CURLOPT_SSL_VERIFYPEER      => false,
            CURLOPT_RETURNTRANSFER        => true
        ));

        $response   = curl_exec($ch);

        $r          = array();
        if (curl_errno($ch)) {

            print_r($response);
            echo "\n\n";
            exit('curl error : ' . curl_error($ch));
        } else {

            $r = json_decode($response, true);

            if (empty($r) && !empty($response)) {

                print_r($response);
                die();
            }
            if (empty($r) && empty($response)) {
                print_r($response);
                print_r(curl_error($ch));
                echo "HAS NO DATA\n";
                die();
            }
            unset($response);
        }

        curl_close($ch);

        return $r;
    }

    /**
     * @param $url
     * @param $filePath
     * @return array
     */
    public static function s3Upload($url, $filePath)
    {

        $ch = curl_init($url);

        $fp = fopen($filePath, 'rb');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_PUT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        curl_setopt($ch, CURLOPT_INFILESIZE, filesize($filePath));
        curl_setopt($ch, CURLOPT_INFILE, $fp);

        $code   = 0;
        $error  = array();
        if (curl_exec($ch))
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        else
            $error = array(
                'code'  => curl_errno($ch),
                'message' => curl_error($ch)
            );

        @curl_close($ch);

        // Parse body into XML
        if (!empty($error)) {
            $array = array(
                'status'    => 'failure',
                'details'   => array(
                    'errorMessage'  => $error['message'],
                    'errorCode'     => $error['code']
                )
            );
        } else {

            $array = array(
                'status'        => 'success',
                'data'          => array(
                    'api_call'  => 's3Uploader',
                    'results'   => array(
                        'status'    => true,
                        'code'      => $code
                    )
                ),
                'details'       => array(
                    'totalItems'    => 1,
                    'currentItems'  => 1
                ),
                'settings'      => array(
                    'currentPage'   => 1,
                    'nextPage'      => NULL,
                    'pageLength'    => 1
                ),
            );
        }

        if ($fp !== false && is_resource($fp)) fclose($fp);

        return $array;
    }
}
