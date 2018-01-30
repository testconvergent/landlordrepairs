<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio;
class TwilioController extends Controller
{
    public function fnToSendSmsForTradesmanRegistration(){
        $abc=Twilio::message('+918013935369', 'Hello');
        dd($abc,'https://support.twilio.com/hc/en-us/articles/223134347-What-do-the-SMS-statuses-mean-');
    }
    public function sendMobileVerificationCodeForTradesmanRegistration($mcode,$mobile_number){
        $message_string=$mcode.' '.'is your landlordrepairs verification code.';
        Twilio::message($mobile_number, $message_string);
    }    
    public function sendMobileVerificationCodeForCustomerRegistration($mcode,$mobile_number){
        $message_string=$mcode.' '.'is your landlordrepairs verification code.';
        Twilio::message($mobile_number, $message_string);
    }
}
