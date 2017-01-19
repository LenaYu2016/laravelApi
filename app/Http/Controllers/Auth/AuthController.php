<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;

class AuthController extends Controller
{

    public function redirectToProvider($provider)
    {   if($provider=='github')
        return Socialite::driver($provider)->scopes(['user', 'gist','repo'])->redirect();
        return Socialite::driver($provider)->redirect();
    }

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
                session(['auth2' => $user->token]);
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
        if($authuser) {
            return $authuser;
        }
        if($emailUk) {
            return $emailUk;
        }
        $userinfo=['name'=>$user->getName(),'email'=>$user->getEmail(),
            'password'=>bcrypt($user->getId()),'account_type'=>$provider,'avatar'=>$user->getAvatar(),
        ];

        return $this->create($userinfo);
    }
    public function checkEmail($email){
        return User::FindByEmail($email)->first()? User::FindByEmail($email)->first():null;

    }
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


}
