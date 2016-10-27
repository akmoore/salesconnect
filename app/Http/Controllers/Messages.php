<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Twilio\Rest\Client;

class Messages extends Controller
{
	protected $client;

	public function __construct(){
		$this->client = new Client(config('services.twilio.sid'), config('services.twilio.token'));
	}

    public function sendMessage(Request $request){
    	$this->client->messages->create(
    		'+12252889870',
    		[
    			'from' => config('services.twilio.phone'),
    			'body' => 'Hey Ken, just seeing if this works.'
    		]
    	);
    	// return [config('services.twilio.phone')];
    	return 'sent';
    }
}
// $sid = 'ACc0e00caa24095b6d5702472932d5787b';
// $token = 'your_auth_token';
// $client = new Client($sid, $token);

// $client->messages->create(
//     // the number you'd like to send the message to
//     '+15558675309',
//     array(
//         // A Twilio phone number you purchased at twilio.com/console
//         'from' => '+15017250604',
//         // the body of the text message you'd like to send
//         'body' => 'Hey Jenny! Good luck on the bar exam!'
//     )
// );

// 'twilio' => [
//         'sid' => env('TWILIO_ACCOUNT_SID'),
//         'token' => env('TWILIO_AUTH_TOKEN'),
//         'phone' => env('TWILIO_NUMBER')
//     ],