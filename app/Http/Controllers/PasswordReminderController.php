<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use Session;
use SoapClient;
use App\Option;
use App\User;

class PasswordReminderController extends Controller
{
    public function index(){
        return view('user.password.reminder');
    }
    public function send(Request $request){
        $password = generatePassword();

        $user = User::where('email', $request->emailmobile)->orWhere('mobile', $request->emailmobile)->first();

        if($user){

            //update password
            DB::table('users')
            ->where('email',$request->emailmobile)
            ->orWhere('mobile',$request->emailmobile)
            ->update(['password' => bcrypt($password)]);

            sendSMS( $user, $password, 'register' );
            sendEmail( $user, $password, 'register' );

            Session::flash('alert-success','رمز عبور به آدرس ایمیل و تلفن همراه شما ارسال شد. در صورت عدم وجود ایمیل در صندوق پستی حتما شاخه هرزنامه های ایمیل خود را بررسی کنید.');

            return redirect('login');

        }else{

            Session::flash('alert-danger','ایمیل یا تلفن همراه یافت نشد.');

            return redirect('reminder');

        }

    }
}
