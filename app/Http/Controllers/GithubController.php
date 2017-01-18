<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
class GithubController extends Controller
{
    protected $githubClient;
    public function handleGithub(Request $request)
    {

        $this->githubClient= new Client(); //GuzzleHttp\Client

        $result = $this->githubClient->request('GET', 'https://api.github.com/users/'. $request->input('name'));

        return view('github.githubProfile',['result'=>json_decode($result->getBody()),'name'=> $request->input('name')]);


    }
}
