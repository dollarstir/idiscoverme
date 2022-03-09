<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\UserEmailAddress;
use App\UserContact;
use App\SystemSetup;
use Auth;
class LoginController extends Controller
{
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){
        if(!SystemSetup::count()){
            return redirect('/system/setup');
        }
        $setup = SystemSetup::take(1)->get()->first();
        return view("auth.login",compact("setup"));
    }

    public function index(){
        $data = request()->validate([
            'phoneEmail'=>'required',
            'password'=>'required'
        ]);

        if(!empty($this ->userIDViaEmail()))
            $user_id = $this ->userIDViaEmail();
        else
            $user_id = $this ->userIDViaPhone();

       $credentials  = [ 'id' => $user_id , 'password' => request()->password ];
        if(Auth::attempt($credentials,request()->remember)){ 
            return redirect('/profile');
        }else{
            return back()->with("error","Invalid credentials");
        }
    
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    private function userIDViaEmail(){
        $email = filter_var(request()->phoneEmail,FILTER_SANITIZE_STRING);
        $request = UserEmailAddress::where("address",$email)->get();
        if($request->count())
            return $request->first()->user_id;
        else
            return "";
    }

    private function userIDViaPhone(){
        $phone = preg_replace("#[^0-9]#","",request()->phoneEmail);
        $request = UserContact::where("phoneNumber",$phone)->get();
        if($request->count())
            return $request->first()->user_id;
        else 
            return "";
    }
}
