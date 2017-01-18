<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
class GithubController extends Controller
{
    protected $githubClient;
    public function handleGithub()
    {
        $this->githubClient= new Client(); //GuzzleHttp\Client

        $result = $this->githubClient->request('GET', 'https://api.github.com/users/LenaYu2016'

        );



        echo $result->getBody();



    }
}
