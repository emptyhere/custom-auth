<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User; 
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Notifiable, HasApiTokens;
use DB;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public $successStatus = 200;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/createuser';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //$this->redirectTo = route('createuser');
    }



    public function store(Request $request)
    {
        $credentials = $request->only('name', 'password');
        /*
        if (Auth::attempt($credentials)) {
            return 'Succes. Is logged:'.Auth::check(); //redirect()->route('createuser');
        }
         else {
            return 'Something gone wrong. Is logged:'.Auth::check();  
        }*/

        
        if (Auth::attempt(['name' => request('name'), 'password' => request('password')])) { 
            /*$user = Auth::user(); 
            $success['api_token'] =  $user->createToken('token')-> accessToken; 
            return response()->json(['api_token' => $success], $this-> successStatus); */

            $api_token = $request->api_token;
            $gen_token = Str::random(60);
            $getUserToken = DB::table('users')->where('name', $request->name)->update(['api_token' => $gen_token]);
            return response()->json($gen_token);
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    /*
        public function logout(Request $request)
    {
            $api_token = $request->api_token;
            $getUserToken = DB::table('users')->where('api_token', $api_token)->update(['api_token' => 'empty_key']);
            return response()->json($getUserToken, 200, [], 256);
    }*/

}
