<?php

namespace App\Http\Traits;

use App\Models\ApiAuth;
use Carbon\Carbon;

trait MsTeamsTrait
{
    //Credentials used for Office 365 Tenant
    private static $o365creds = array(
        'clientId' => '580f99e2-e5e9-42b5-980a-77a94a5ab1cd',
        'objectId' => '9172074f-c227-44ea-ab77-4fa3d252400f',
        'tenantId' => '1f3fd258-18d9-46e5-88eb-3f3d51f12e4d',
        'secretId' => 'a54778b6-7719-49b0-bc5b-a08da97ed3b9',
        'secretValue' => 'L_b7Q~fwYNDZpd2mAj1fDQ1MmUrJM15TCcPn1',

        'infoUserId' => [
            'dbfb7b4f-5e09-468c-8cb0-0af56758d609', //UserId for info@inspirephysiotherapy.com.au
            '326960d3-bad2-4266-96ff-b319b7113986', //UserId for HomeOffice@inspirephysiotherapy.com.au
            '296c07d9-3fbd-4822-a907-8998374e047c', //UserId for ReceptionRoom@inspirephysiotherapy.com.au
            'c1e90f1b-3276-4d09-8a8f-a53828ee1a85' //UserId for BackOffice@inspirephysiotherapy.com.au
        ],
    );


    //Consent link - used in step 3 of this process: https://docs.microsoft.com/en-us/graph/auth-v2-service (already done)


    static function getAuth()
    {
        $token = ApiAuth::where('type', 'msteams')->first();

        if (isset($token) && !empty($token) && Carbon::parse($token->created_at)->diffInHours(now()) < 5) {
            return $token->token;
        }

        $tokenRequestUrl = 'https://login.microsoftonline.com/' . self::$o365creds['tenantId'] . '/oauth2/v2.0/token';
        $tokenRequestPostFields = array(
            "client_id" => self::$o365creds['clientId'],
            "scope" => 'https://graph.microsoft.com/.default',
            "client_secret" => self::$o365creds['secretValue'],
            "grant_type" => 'client_credentials',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $tokenRequestUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $tokenRequestPostFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tokenResponse = curl_exec($ch);
        curl_close($ch);
        $tokenResponseArray = json_decode($tokenResponse, true);
        $authToken = $tokenResponseArray['access_token'];

        ApiAuth::where('type', 'msteams')->delete();
        ApiAuth::create(['type' => 'msteams', 'token' => $authToken]);

        return  $authToken;
    }

    static function newContact($newContact)
    {
        // $newContact = array(

        //     'birthday' => '1988-01-20T00:00:00Z',
        //     'emailAddresses' => array(
        //         array(
        //             'address' => 'test@examplepatient.com',
        //             'name' => 'TestFirst TestLast'
        //         )
        //     ),
        //     'givenName' => 'TestFirst',
        //     'surname' => 'TestLast',
        //     'companyName' => 'TestFirst TestLast (Patient)', //IMPORTANT - If company name is not set it won't show up in teams
        //     'mobilePhone' => '0424004422',
        //     'personalNotes' => 'https://www.nookal.com/example/patienturl/12345',
        //     'jobTitle' => 'Patient' //IMPORTANT - This is how we know to sync in future

        // );
        //Documentation of format here: https://docs.microsoft.com/en-us/graph/api/resources/contact?view=graph-rest-1.0

        foreach (self::$o365creds['infoUserId'] as $key => $value) {
            self::apiCall('users/' . $value . '/contacts', $newContact);
        }
        return true;
    }
    static function getContacts()
    {
        $url = 'users/' . self::$o365creds['infoUserId'][3] . '/contacts?$filter=contains(jobTitle,\'Patient\')';
        $contacts = [];
        while ($url != null) {
            $data = self::apiCall($url);

            if (isset($data['value']))
                $contacts =  array_merge($contacts, $data['value']);

            if (isset($data["@odata.nextLink"]))
                $url = str_replace('https://graph.microsoft.com/v1.0/', '', $data["@odata.nextLink"]);
            else
                $url = null;
        }

        return $contacts;
    }


    public static function apiCall($path = null, $postJson = NULL)
    {
        $authToken = self::getAuth(); //Auth token required in header

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.microsoft.com/v1.0/' . $path);

        //We we have vals to post - send POST request (otherwise default is GET)
        if ($postJson) {
            $jsonPostData = json_encode($postJson, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            // echo 'POST Data: ' . $jsonPostData . PHP_EOL;
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPostData);
        };

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: ' . $authToken,
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tokenResponse = curl_exec($ch);
        curl_close($ch);

        return json_decode($tokenResponse, true);
    }
}
