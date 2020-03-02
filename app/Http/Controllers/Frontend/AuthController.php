<?php

namespace App\Http\Controllers\Frontend;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\RegistrationEmailNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['only' => 'logout']);

    }


    public function showLogin(){
        return view('frontend.login');
    }

    public function processLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'pass' => 'required|min:5',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only(['email','pass']);

        if(auth()->attempt(['email' => $credentials['email'], 'password' => $credentials['pass']])){
            $user = auth()->user();

            if($user->email_verified_at == null){
                session()->flash('type','warning');
                session()->flash('message','Your account is not activated');
                auth()->logout();
                return redirect()->route('user.login');
            }
            session()->flash('type','success');
            session()->flash('message','Login successfull');
            return redirect()->route('frontend.home');
        }
        session()->flash('type','warning');
        session()->flash('message','Invalid Data');
        return redirect()->route('user.login');
    }

    public function showSignup(){
        return view('frontend.signup');
    }

    public function processSignup(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|min:10|unique:users,phone',
            'pass' => 'required|min:5',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }




//        event(new UserRegistered($user));



        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => bcrypt($request->input('pass')),
                'email_verification_token' => uniqid(time(), true).Str::random(16)
            ]);


            $user->notify(new RegistrationEmailNotification($user));


            session()->flash('type','success');
            session()->flash('message','Account successfully registered');
            return redirect()->route('home');

        } catch (\Exception $e){
            session()->flash('type','warning');
            session()->flash('message',$e->getMessage());
        }

        return redirect()->back();


    }



    public function activate($token = null){
        if ($token==null){
            return redirect('/');
        }

        $user = User::where('email_verification_token',$token)->firstOrFail();


        if($user){
            $user->update([
                'email_verified_at' => Carbon::now(),
                'email_verification_token' => null

                ]);

            session()->flash('type','success');
            session()->flash('message','Account verified successfully');

            return redirect()->route('user.login');
        }


    }


    public function logout(){
        auth()->logout();
        return redirect()->route('frontend.home');
    }



    public function profile(){
        $data = [];
        $data['orders'] = Order::where('user_id',auth()->user()->id)->get();

        return view('frontend.profile',$data);
    }

}


