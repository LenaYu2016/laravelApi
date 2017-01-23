<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CurlTrait;
class SendMessageController extends Controller
{
    use CurlTrait;
    public function index(){
   return view('sendMessage');
    }
    public function send(Request $request){
        $this->validate($request,["number"=>"required","to"=>"required"]);
      $text=$request->input('text');
      $number=$request->input('number');
        $to=$request->input('to');

        $url = 'https://rest.nexmo.com/sms/json?api_key='.env('NEXMO_KEY').'&api_secret='.env('NEXMO_SECRET').'&from='.$number.'&to='.$to.'&text='.$text;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        return redirect('message')->with("suceess","Message has been sent.");
    }

}
