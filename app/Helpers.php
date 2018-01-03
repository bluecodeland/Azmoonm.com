<?php
// retruns 0-9
function getArabicNumerals($string) {
    $hindi = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $arabic = range(0, 9);
    return str_replace($hindi, $arabic, $string);
}

//returns ۰-۹
function getHindiNumerals($string) {
    $hindi = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $arabic = range(0, 9);
    $string = str_replace($arabic, $hindi, $string);
    $string = str_replace(' ', '&nbsp;', $string);
    return $string;
}

function getGregorianDate($string) {
    $gdate = jDateTime::toGregorian(substr($string,0,4), substr($string,5,2), substr($string,8,2));
    $date = $gdate[0] . "-" . sprintf('%02d', $gdate[1]) . "-" . sprintf('%02d', $gdate[2]) . " " . substr($string,11,2) . ":" . substr($string,14,2) . ":" . substr($string,17,2);
    
    return $date;
}

function generatePassword($length = 8) {
    $chars = 'abcdefghkmnrstuvwxy3456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}

function getApplicationsCount( $type ){
    $query = DB::table("users")
        ->select
            (
                DB::raw('users.id, users.picture, users.created_at, users.reminder, applications.form_complete, roles.name'), 
                DB::raw('count(school_user.school_id) as school_count')
            )
        ->join('role_user', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->leftJoin('applications', 'users.id', '=', 'applications.user_id')
        ->leftJoin('school_user', 'users.id', '=', 'school_user.user_id')
        ->where('roles.name','prospect')
        ->groupBy('users.id', 'users.picture', 'applications.form_complete');
    if($type=='all'){
    }elseif($type=='complete'){
        $query->havingRaw("users.picture <> '00000000.png' AND applications.form_complete = 1 AND count(school_user.school_id) >= 3");
    }elseif($type=='incomplete'){
        $query->havingRaw("users.picture = '00000000.png' OR applications.form_complete = 0 OR count(school_user.school_id) < 3");
    }
    $count = $query->orderBy('users.id')->get()->count();
    return $count;
}

//deletes user accounts where the application has not been completed 1 week after registration
function deleteUnusedAccounts(){
    $users = DB::table("users")
        ->select
            (
                DB::raw('users.id, users.picture, users.created_at, users.reminder, applications.form_complete, roles.name'), 
                DB::raw('count(school_user.school_id) as school_count')
            )
        ->join('role_user', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->leftJoin('applications', 'users.id', '=', 'applications.user_id')
        ->leftJoin('school_user', 'users.id', '=', 'school_user.user_id')
        ->where('roles.name','prospect')
        ->groupBy('users.id', 'users.picture', 'applications.form_complete')
        ->havingRaw("users.picture = '00000000.png' OR applications.form_complete = 0 OR count(school_user.school_id) < 3")
        ->orderBy('users.id')
        ->get();

    $now = time();
    foreach($users as $item){
        $diff = floor($now - strtotime($item->created_at)) / (60 * 60 * 24);
        if($diff < 1) {
            // do nothing!
        }elseif($diff > 1 AND $diff < 3) {
            if($item->reminder == 0){
                $user = App\User::find($item->id);
                sendSMS( $user, '', 'reminder' );
                sendEmail( $user, '', 'reminder' );
                $user->reminder = 1;
                $user->save();
            }else{
                // do nothing!
            }
        }elseif($now-strtotime($item->created_at) >= 3) {
            $user = App\User::find($item->id);
            sendSMS( $user, '', 'delete' );
            sendEmail( $user, '', 'delete' );
            $user->roles()->detach();
            App\Application::where('user_id', $user->id)->delete();
            $user->delete();
        }
    }
    return true;
}

function sendSMS( $user, $password, $template ){
    $options = App\Option::all()->keyBy('name');
    if($template == 'register'){
        $mobile = $user->mobile;
        if($user->hasRole('prospect')){
            $text = $options->get('site_name_fa')->value . " " . $options->get('site_url')->value . PHP_EOL . PHP_EOL . 
                    "نام كاربري: " . $user->email . PHP_EOL . PHP_EOL . "كلمه ي عبور: " . $password . PHP_EOL . PHP_EOL . 
                    "داوطلب گرامی: چنانچه ظرف مدت 48 ساعت نسبت به تکمیل ثبت نام اقدام نفرمائید، سامانه به صورت خودکار کاربری شما را حذف نموده و بایستی برای ثبت نام، از ابتدا مراحل را طی نمایید. ";
        }else{ //if not prospect then do not show 48 hour warning
            $text = $options->get('site_name_fa')->value . " " . $options->get('site_url')->value . PHP_EOL . PHP_EOL . 
                    "نام كاربري: " . $user->email . PHP_EOL . PHP_EOL . "كلمه ي عبور: " . $password . PHP_EOL . PHP_EOL;            
        }
        soapSMS( $mobile, $text );             
    }elseif($template == 'reminder'){
        $mobile = $user->mobile;
        $text = $options->get('site_name_fa')->value . " " . $options->get('site_url')->value . PHP_EOL . PHP_EOL . 
                    "داوطلب گرامی: چنانچه ظرف مدت 48 ساعت نسبت به تکمیل ثبت نام اقدام نفرمائید، سامانه به صورت خودکار کاربری شما را حذف نموده و بایستی برای ثبت نام، از ابتدا مراحل را طی نمایید. " . PHP_EOL . PHP_EOL . 
                    "نام كاربري: " . $user->email;
        soapSMS( $mobile, $text );             
    }elseif($template == 'delete'){
        $mobile = $user->mobile;
        $text = $options->get('site_name_fa')->value . " " . $options->get('site_url')->value . PHP_EOL . PHP_EOL . 
                    "با توجه به عدم تکمیل ثبت نام، کاربری شما حذف گردید. در صورت تمایل فرآیند ثبت نام را از ابتدا انجام دهید. " . PHP_EOL . PHP_EOL .
                    "نام كاربري: " . $user->email;
        soapSMS( $mobile, $text );             
    }elseif($template == 'times-up'){
        $mobile = $user->mobile;
        $text = $options->get('site_name_fa')->value . " " . $options->get('site_url')->value . PHP_EOL . PHP_EOL . 
                    "با توجه به عدم تکمیل ثبت نام، کاربری شما حذف گردید. " . PHP_EOL . PHP_EOL .
                    "نام كاربري: " . $user->email;
        soapSMS( $mobile, $text );             
    }      

}
function soapSMS( $mobile, $text ){
    $options = App\Option::all()->keyBy('name');
    date_default_timezone_set('Asia/Tehran');
    $client = new SoapClient('http://ip.sms.ir/ws/SendReceive.asmx?wsdl');
    $parameters['userName'] = env('SMS_USERNAME', '12345');
    $parameters['password'] = env('SMS_PASSWORD', '12345');
    $parameters['mobileNos'] = array(doubleval(getArabicNumerals($mobile)));
    $parameters['messages'] = array($text);
    $parameters['lineNumber'] = env('SMS_LINENUMBER', '12345');
    $parameters['sendDateTime'] = date("Y-m-d")."T".date("H:i:s");
    $client->SendMessageWithLineNumber($parameters);
}
function sendEmail($user, $password, $template ){
    if($template == 'register'){
        Mail::send('emails.register', ['user' => $user, 'password' => $password], function ($m) use ($user) {
            $options = App\Option::all()->keyBy('name');
            $m->from($options->get('register_email')->value, $options->get('site_name_en')->value);
            $m->to($user->email, $user->name)->subject($options->get('site_title')->value.' - کلمه عبور');
        });        
    }elseif($template == 'reminder'){
        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            $options = App\Option::all()->keyBy('name');
            $m->from($options->get('register_email')->value, $options->get('site_name_en')->value);
            $m->to($user->email, $user->name)->subject($options->get('site_title')->value.' - یادآور');
        });        
    }elseif($template == 'delete'){
        Mail::send('emails.delete', ['user' => $user], function ($m) use ($user) {
            $options = App\Option::all()->keyBy('name');
            $m->from($options->get('register_email')->value, $options->get('site_name_en')->value);
            $m->to($user->email, $user->name)->subject($options->get('site_title')->value.' - حذف شده');
        });        
    }elseif($template == 'times-up'){
        Mail::send('emails.timesup', ['user' => $user], function ($m) use ($user) {
            $options = App\Option::all()->keyBy('name');
            $m->from($options->get('register_email')->value, $options->get('site_name_en')->value);
            $m->to($user->email, $user->name)->subject($options->get('site_title')->value.' - حذف شده');
        });        
    }
}