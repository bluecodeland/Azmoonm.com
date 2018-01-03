<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SoapClient;

class SmsController extends Controller
{
	public function index($phone, $msg){
		$time = date("H:i:s");
		$text = $msg.PHP_EOL.$time;
		$to = $phone;
		date_default_timezone_set('Asia/Tehran');
		$client = new SoapClient('http://ip.sms.ir/ws/SendReceive.asmx?wsdl');
		$parameters['userName'] = env('SMS_USERNAME', '12345');
		$parameters['password'] = env('SMS_PASSWORD', '12345');
		$parameters['mobileNos'] = array(doubleval($to));
		$parameters['messages'] = array($text);
		$parameters['lineNumber'] = env('SMS_LINENUMBER', '12345');
		$parameters['sendDateTime'] = date("Y-m-d")."T".$time;
		$result = $client->SendMessageWithLineNumber($parameters);
		echo "Sent! " . $time . "<br />";
		// DEBUG CODE
		// echo "phone: " . $phone . "<br />";
		// echo "msg: " . $msg . "<br />";
		// echo "SMS_USERNAME: " . env('SMS_USERNAME', '12345') . "<br />";
		// echo "SMS_PASSWORD: " . env('SMS_PASSWORD', '12345') . "<br />";
		// echo "SMS_LINENUMBER: " . env('SMS_LINENUMBER', '12345') . "<br />";
		// print_r($result);
	}
}
