<?php

namespace App\Traits;


use App\Models\Sms;
use App\Models\SmsLog;
use App\Models\SmsSetting;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

trait SmsableMokhaberat
{

    private $fast_url;
    private $send_url;
    private $username;
    private $password;
    private $from_number;


    public static function getToken()
    {
        $client = new Client();
        $body = ['UserApiKey' => config('smsirlaravel.api-key'), 'SecretKey' => config('smsirlaravel.secret-key'), 'System' => 'laravel_v_1_4'];
        //Remove Verify false in production
        $result = $client->post(config('smsirlaravel.webservice-url') . 'api/Token', ['json' => $body, 'connect_timeout' => 30]);
        return json_decode($result->getBody(), true)['TokenKey'];
    }
    public static function sendVerification($code,$number)
    {
        $client = new Client();
        $body   = ['Code'=>$code,'MobileNumber'=>$number];
        $result = $client->post(config('smsirlaravel.webservice-url').'api/VerificationCode',['json'=>$body,'headers'=>['x-sms-ir-secure-token'=>self::getToken()],'connect_timeout'=>30]);

        return json_decode($result->getBody(),true);
    }

    public function sendFastSmsMokhaberat($number, $pattern_code, $input_data)
    {
        $params = [];
        foreach ($input_data as $key => $value) {
            $params[] = ['Parameter' => $key, 'ParameterValue' => $value];
        }
        $client = new Client();
        $body = ['ParameterArray' => $params, 'TemplateId' => $pattern_code, 'Mobile' => $number];
        //Remove Verify false in production
        $result = $client->post(config('smsirlaravel.webservice-url') . 'api/UltraFastSend', ['json' => $body, 'headers' => ['x-sms-ir-secure-token' => self::getToken()], 'connect_timeout' => 30]);

        return json_decode($result->getBody(), true);

    }


}
