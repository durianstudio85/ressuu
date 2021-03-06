<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'https://ressuu.me/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'facebook_id' => 'max:255',
            'twitter_id' => 'max:255',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'facebook_id' => $data['facebook_id'],
            'twitter_id' => $data['twitter_id'],
        ]);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        
        try {
            $socialUser = Socialite::driver('facebook')->user();

         } catch (Exception $e) {
            
         return redirect('/');
         }

         $user = User::where("facebook_id",$socialUser->getId())->first();

             if(!$user){
                 $user = User::create([
                        'facebook_id' => $socialUser->getId(),
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),   
           
                ]);

                  auth()->login($user);
                  return redirect()->to('/home');

               }else{

                 auth()->login($user);
                  return redirect()->to('/home');
                
               }   
            
         //Auth::guard('admin')->login($user);    
    }

        /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function tredirectToProvider(){

        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function thandleProviderCallback(){
        
        try {
            $socialUser = Socialite::driver('twitter')->user();

         } catch (Exception $e) {
            
         return redirect('/');
         }

         $user = User::where("twitter_id",$socialUser->getId())->first();

             if(!$user){
                 $user = User::create([
                        'twitter_id' => $socialUser->getId(),
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),   
           
                ]);

                  auth()->login($user);
                  return redirect()->to('/home');

               }else{

                 auth()->login($user);
                  return redirect()->to('/home');
                
               }          
         //Auth::guard('admin')->login($user);    
    }


}
