<?php
namespace App\Http\Controllers;
trait CurlTrait{
    public function curl($url,$data,$count,$method,$header){
        $ch = curl_init();
//set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,$method, $count);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}