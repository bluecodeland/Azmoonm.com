<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Option;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\Application;
use App\Schedule;
use Mail;
use Session;
use SoapClient;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

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
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'mobile' => 'required|size:11|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'read_booklet' => 'required',
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
        //overwrite post-registration redirect for first-time login
        //$this->redirectTo = '/user/picture';
        $datetime = date("Y-m-d H:i:s");

        $application_reference = rand(100000, 999999);
        $password = generatePassword();
        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'mobile' => $data['mobile'],
            'email' => strtolower($data['email']),
            'password' => bcrypt($password),
            'picture' => '00000000.png',
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ]);
        $user->assign('prospect');
        $application = Application::create([
            'user_id' => $user->id,
            'application_reference' => $application_reference,
            'submission_date' => '0000-00-00 00:00:00',
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ]);

        sendSMS( $user, $password, 'register' );
        sendEmail( $user, $password, 'register' );

        Session::flash('alert-success','رمز عبور به آدرس ایمیل ' . $user->email .' و تلفن همراه ' . $user->mobile .' ارسال شد. در صورت عدم وجود ایمیل در صندوق پستی حتما شاخه هرزنامه های ایمیل خود را بررسی کنید.');
        
        return $user;
    }

    /**
     * overwrite showRegistrationForm function
     */
    public function showRegistrationForm()
    {
        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        $data = array (
            'schedules' => Schedule::all(),
            'registration_open' => Schedule::isRegistrationOpen('1'),
        );
        
        return view('auth.register', $data);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
