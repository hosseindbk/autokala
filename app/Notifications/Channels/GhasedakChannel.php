<?php


namespace App\Notifications\Channels;


use Ghasedak\Exceptions\ApiException;
use Ghasedak\Exceptions\HttpException;
use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;

class GhasedakChannel
{
    public function send($notifiable , Notification $notification)
    {
        if(! method_exists($notification , 'toGhasedakSms')) {
            throw new \Exception('toGhasedakSms not found');
        }

        $data = $notification->toGhasedakSms($notifiable);


        $message = $data['text'];
        $receptor = $data['phone'];
        $code = $data['code'];
        $lineNumber = "2000235";
        $apiKey = config('services.Ghasedak.key');

        try
        {
            $api = new GhasedakApi($apiKey);
            $api->Verify($receptor,1,'autokala',$code);
           
            //$api->SendSimple($receptor,$message,$lineNumber);
        }
        catch(ApiException $e){
            throw $e;
        }
        catch(HttpException $e){
            throw $e;
        }
    }
}
