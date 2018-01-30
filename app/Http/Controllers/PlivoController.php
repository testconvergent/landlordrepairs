<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Plivo;
class PlivoController extends Controller
{
    public function sendVerificationSmsForTradesmenSignUp($mobile_number){
        $params = array(
            'src' => +447792903473,
            'dst' => $mobile_number,
            'text' => 'Hello world!'
        );
        
        Plivo::sendSMS($params);
    }
}
