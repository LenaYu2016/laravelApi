<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mockery\CountValidator\Exception;
use Socialite;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $githubClient;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
       if(!isset($data['account_type'])){

           $data['avatar']=null;
           $data['account_type']='normal';
       }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
                'avatar'=>$data['avatar'],
            'account_type'=>$data['account_type']
        ]);

    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try{
        $user = Socialite::driver($provider)->user();
        ;}catch(Exception $e){
            return redirect('/');
        }

       if($user) {
           $authuser = $this->findOrCreateUser($user, $provider);

          if($authuser){
              Auth::login($authuser);
          }else{
              return redirect()->to('login');
          }
       }
        return redirect('/home');
    }
    public function findOrCreateUser($user,$provider){
        $authuser=User::where([
             [ 'account_type', '=', $provider],
              ['password', '=', bcrypt($user->getId())]
        ])->first();

        $emailUk=$this->checkEmail($user->getEmail());


        if(($emailUk!=null)||($authuser!=null ) ){

            return false;
        }
        $userinfo=['name'=>$user->getName(),'email'=>$user->getEmail(),
            'password'=>bcrypt($user->getId()),'account_type'=>$provider,'avatar'=>$user->getAvatar(),
        ];

        return $this->create($userinfo);
    }
    public function checkEmail($email){
       return User::FindByEmail($email)->first()? User::FindByEmail($email)->first():null;

    }
    public function handleGithub()
    {
        $this->githubClient= new Client(); //GuzzleHttp\Client

            $result = $this->githubClient->request('GET', 'https://api.github.com/users/LenaYu2016'

            );



        echo $result->getBody();



    }

}
