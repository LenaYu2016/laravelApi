<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Socialite;

class GithubController extends Controller
{
    protected $githubClient;
    protected $baseUrl='https://api.github.com';
    protected $auth2token;
    function __construct()
    {   $this->auth2token= session('auth2');
        $this->githubClient=new Client(
            ['base_uri' =>$this->baseUrl,
            ]
        );
    }

    public function handleGithub(Request $request)
    {
        $result = $this->githubClient->request('GET', 'users/'. $request->input('name'));

        return view('github.githubProfile',['result'=>json_decode($result->getBody()),'name'=> $request->input('name')]);


    }
    public function githubPostGists(Request $request){

        $this->validate($request,['filename'=>'required|min:3']);


        $data='{"files":{"'.$request->input('filename').'": {"content": "'.$request->input('code').'"}}}';
        $url=$this->baseUrl.'/gists?access_token='.session('auth2');

        ;if($this->curl($url,$data,1,'CURLOPT_POST')){
            \Session::flash('message','Post gists successfully!');

       }else{
        \Session::flash('meessage','fail to post.');
        }
       return redirect('/home');

    }
    public function curl($url,$data,$count,$method){
        $ch = curl_init();
//set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,$method, $count);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'User-Agent: curl/7.45.0',
            'Content-Type:application/json'
        ));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
