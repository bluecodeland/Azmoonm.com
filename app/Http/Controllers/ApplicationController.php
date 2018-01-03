<?php
 
namespace App\Http\Controllers;
 
use Auth;
use DB;
use File;
use Excel;
use Session;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use PDO;

use Validator;
use App\User;
use App\Seat;
use App\Application;
use Image;
use Illuminate\Validation\Rule;
use App\School;

class ApplicationController extends Controller
{

    public function index(){

        $data = array (
            'user' => Auth::user(),
        );

        return view('application.index', $data);
    } 

    public function update(){

        $data = array (
            'user' => Auth::user(),
        );

        return view('application.update', $data);
    }

    public function save(Request $request)
    {

        $user = Auth::User();

        $this->validate($request, [
           
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'fathers_name' => 'required|max:255',
            'national_code' => ['required', 'size:10', Rule::unique('applications')->ignore($user->id, 'user_id'),],
            'id_number' => 'required|max:255',
            'birth_date' => 'required|max:10',
            'birth_place' => 'required|max:255',
            'place_of_issue' => 'required|max:255',

            'children' => 'max:2',

            'mobile' => ['required', 'size:11', Rule::unique('users')->ignore($user->id, 'id'),],
            'landline' => 'max:255',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'address' => 'required|max:255',

            // 'employment_status' => '',
            'place_of_work' => 'max:255',

            'level_1_grade' => 'required|max:5',
            'level_2_grade' => 'required|max:5',
            'level_3_grade' => 'required|max:5',
            'level_4_grade' => 'required|max:5',
            'level_5_grade' => 'required|max:5',
            'current_school' => 'required|max:255',
        ]);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->mobile = $request->mobile;

        $user->save();

        $user->application->fathers_name = $request->fathers_name;
        $user->application->national_code = $request->national_code;
        $user->application->id_number = $request->id_number;
        $user->application->birth_date = $request->birth_date;
        $user->application->birth_place = $request->birth_place;
        $user->application->place_of_issue = $request->place_of_issue;
        $user->application->marital_status = $request->marital_status;
        $user->application->children = $request->children;
        $user->application->landline = $request->landline;
        $user->application->state = $request->state;
        $user->application->city = $request->city;
        $user->application->address = $request->address;
        $user->application->employment_status = $request->employment_status;
        $user->application->place_of_work = $request->place_of_work;
        $user->application->level_1_grade = $request->level_1_grade;
        $user->application->level_2_grade = $request->level_2_grade;
        $user->application->level_3_grade = $request->level_3_grade;
        $user->application->level_4_grade = $request->level_4_grade;
        $user->application->level_5_grade = $request->level_5_grade;
        $user->application->current_school = $request->current_school;
        $user->application->form_complete = 1;

        $user->application->save();

        return redirect('/user/school');
    }

    public function printForm()
    {
        $data = array (
            'user' => Auth::user(),
        );
        return view('application.print', $data);
    }

    public function card()
    {
        //if no seat exists, then create a new seat
        $user = Auth::user();
        $seat_number = "";
        if(!$user->seat){
            $seat = new Seat;
            $seat->exam_id = 1;
            $seat->seat_number = $seat->getAvailableSeat();
            $user->seat()->save($seat);
            $seat_number = $seat->seat_number;
        }

        if($user->seat){
            $seat_number = $user->seat->seat_number;
        }

        $data = array (
            'user' => $user,
            'seat_number' => $seat_number,
        );
        return view('application.card', $data);
    }

    public function results()
    {
        $data = array (
            'user' => Auth::user(),
        );
        return view('application.results', $data);
    }

    public function all(){
        $applications =  Application::all()->filter(function ($item) {
            return $item->user->hasRole('prospect');
        })->sortBy('created_at');

        $data = array (
            'applications' => $applications,
        );
        return view('/admin/application/index', $data);
    }

    public function complete(){
        $applications =  Application::all()->filter(function ($item) {
            if($item->user->hasRole('prospect') && $item->user->picture <> '00000000.png' && $item->form_complete == 1 && $item->user->schoolCount() >= 3){
                return $item;               
            }
        })->sortBy('created_at');
        $data = array (
            'applications' => $applications,
        );
        return view('/admin/application/index', $data);
    }

    public function incomplete(){
        $applications =  Application::all()->filter(function ($item) {
            if($item->user->hasRole('prospect') && ( $item->user->picture == '00000000.png' && $item->form_complete == 0 && $item->user->schoolCount() < 3)){
                return $item;               
            }
        })->sortBy('created_at');
        $data = array (
            'applications' => $applications,
        );
        return view('/admin/application/index', $data);
    }

    public function printed(){
        $applications =  Application::all()->filter(function ($item) {
            if($item->user->hasRole('prospect') && !($item->printed_card_at=="" || $item->getPrintedCardAtYear() <= 0) ) {
                return $item;               
            }
        });
        $data = array (
            'applications' => $applications,
        );
        return view('/admin/application/printed', $data);
    }

    public function view(Request $request)
    {
        $user = User::find($request->id);
        $data = array (
            'user'     => $user,
        );
        return view('/admin/application/view', $data);
    }

    public function reports(){

        $data = array (
            'user' => Auth::user(),
        );

        return view('admin.reports.index', $data);
    }

    public function export( $report )
    {

        Excel::create('قائم فهرست ثبت نام', function($excel) {

            $excel->sheet('کل ثبت نام', function($sheet) {

                DB::setFetchMode(PDO::FETCH_ASSOC);

                $data = DB::table('users')
                    ->leftJoin('applications', 'users.id', '=', 'applications.user_id')
                    ->leftJoin('seats', 'users.id', '=', 'seats.user_id')
                    ->join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->select(
                        'users.id', 
                        'users.firstname',
                        'users.lastname',
                        'users.mobile',
                        'users.email',
                        'users.picture',

                        'applications.application_reference', 
                        'applications.fathers_name', 
                        'applications.national_code', 
                        'applications.id_number', 
                        'applications.birth_date', 
                        'applications.birth_place', 
                        'applications.place_of_issue', 
                        'applications.marital_status', 
                        'applications.children', 
                        'applications.landline', 
                        'applications.state', 
                        'applications.city', 
                        'applications.address', 
                        'applications.employment_status', 
                        'applications.place_of_work', 
                        'applications.level_1_grade', 
                        'applications.level_2_grade', 
                        'applications.level_3_grade', 
                        'applications.level_4_grade', 
                        'applications.level_5_grade', 
                        'applications.current_school', 
                        'applications.printed_card_at', 
                        'applications.canceled', 
                        'applications.created_at', 
                        'applications.updated_at', 

                        'seats.seat_number')
                    ->where('roles.name','=','prospect')
                    ->get();

                DB::setFetchMode(PDO::FETCH_CLASS);

                $sheet->setOrientation('landscape');
                $sheet->setRightToLeft(true);
                $sheet->fromArray($data, null, 'A1', false, true);
                
                // change title row to farsi
                $sheet->row(1, array(
                    'شماره کاربر',          // users.id
                    'نام',  // users.firstname
                    'نام خانوادگی',  // users.lastname
                    'تلفن همراه',  // users.mobile
                    'پست الکترونیکی',  // users.email
                    'عکس',  // users.picture

                    'شماره داوطلب',  // applications.application_reference 
                    'نام پدر', // applications.fathers_name 
                    'کد ملی',  // applications.national_code 
                    'شماره شناسنامه',  // applications.id_number 
                    'تاریخ تولد',  // applications.birth_date 
                    'محل تولد',  // applications.birth_place 
                    'محل صدور شناسنامه',  // applications.place_of_issue 
                    'وضعیت تاهل',  // applications.marital_status 
                    'تعداد اولاد',  // applications.children 
                    'تلفن ثابت',  // applications.landline 
                    'استان',  // applications.state 
                    'شهر',  // applications.city 
                    'آدرس',  // applications.address 
                    'وضعیت اشتغال',  // applications.employment_status 
                    'محل کار',  // applications.place_of_work 
                    'معدل پایه اول',  // applications.level_1_grade 
                    'معدل پایه دوم',  // applications.level_2_grade 
                    'معدل پایه سوم',  // applications.level_3_grade 
                    'معدل پایه چهارم',  // applications.level_4_grade 
                    'معدل پایه پنجم',  // applications.level_5_grade 
                    'مدرسه فعلی',  // applications.current_school 
                    'تاریخ چاپ کارت',  //applications.printed_card_at
                    'انصراف',  // applications.canceled 
                    'تاریخ ایجاد',  // applications.created_at 
                    'تاریخ ویرایش',  // applications.updated_at 

                    'شماره صندلی',  // seats.seat_number
                    
                ));

            });

            $schools = School::all();
            foreach($schools as $school){
                
                $excel->sheet($school->label, function($sheet)  use($school){

                    DB::setFetchMode(PDO::FETCH_ASSOC);

                    $data = DB::table('users')
                        ->leftJoin('applications', 'users.id', '=', 'applications.user_id')
                        ->leftJoin('seats', 'users.id', '=', 'seats.user_id')
                        ->join('role_user', 'users.id', '=', 'role_user.user_id')
                        ->join('roles', 'role_user.role_id', '=', 'roles.id')
                        ->join('school_user', 'users.id', '=', 'school_user.user_id')
                        ->select(
                            'users.id', 
                            'users.firstname',
                            'users.lastname',
                            'users.mobile',
                            'users.email',
                            'users.picture',

                            'applications.application_reference', 
                            'applications.fathers_name', 
                            'applications.national_code', 
                            'applications.id_number', 
                            'applications.birth_date', 
                            'applications.birth_place', 
                            'applications.place_of_issue', 
                            'applications.marital_status', 
                            'applications.children', 
                            'applications.landline', 
                            'applications.state', 
                            'applications.city', 
                            'applications.address', 
                            'applications.employment_status', 
                            'applications.place_of_work', 
                            'applications.level_1_grade', 
                            'applications.level_2_grade', 
                            'applications.level_3_grade', 
                            'applications.level_4_grade', 
                            'applications.level_5_grade', 
                            'applications.current_school', 
                            'applications.printed_card_at', 
                            'applications.canceled', 
                            'applications.created_at', 
                            'applications.updated_at', 

                            'seats.seat_number',

                            'school_user.sort_order')

                        ->where('roles.name','=','prospect')
                        ->where('school_user.school_id','=',$school->id)
                        ->orderBy('school_user.sort_order', 'asc')
                        ->orderBy('users.lastname', 'asc')
                        ->orderBy('users.firstname', 'asc')

                        ->get();

                    DB::setFetchMode(PDO::FETCH_CLASS);

                    $sheet->setOrientation('landscape');
                    $sheet->setRightToLeft(true);
                    $sheet->fromArray($data, null, 'A1', false, true);
                    
                    // change title row to farsi
                    $sheet->row(1, array(
                        'شماره کاربر',          // users.id
                        'نام',  // users.firstname
                        'نام خانوادگی',  // users.lastname
                        'تلفن همراه',  // users.mobile
                        'پست الکترونیکی',  // users.email
                        'عکس',  // users.picture

                        'شماره داوطلب',  // applications.application_reference 
                        'نام پدر', // applications.fathers_name 
                        'کد ملی',  // applications.national_code 
                        'شماره شناسنامه',  // applications.id_number 
                        'تاریخ تولد',  // applications.birth_date 
                        'محل تولد',  // applications.birth_place 
                        'محل صدور شناسنامه',  // applications.place_of_issue 
                        'وضعیت تاهل',  // applications.marital_status 
                        'تعداد اولاد',  // applications.children 
                        'تلفن ثابت',  // applications.landline 
                        'استان',  // applications.state 
                        'شهر',  // applications.city 
                        'آدرس',  // applications.address 
                        'وضعیت اشتغال',  // applications.employment_status 
                        'محل کار',  // applications.place_of_work 
                        'معدل پایه اول',  // applications.level_1_grade 
                        'معدل پایه دوم',  // applications.level_2_grade 
                        'معدل پایه سوم',  // applications.level_3_grade 
                        'معدل پایه چهارم',  // applications.level_4_grade 
                        'معدل پایه پنجم',  // applications.level_5_grade 
                        'مدرسه فعلی',  // applications.current_school 
                        'تاریخ چاپ کارت',  //applications.printed_card_at
                        'انصراف',  // applications.canceled 
                        'تاریخ ایجاد',  // applications.created_at 
                        'تاریخ ویرایش',  // applications.updated_at 

                        'شماره صندلی',  // seats.seat_number
                        
                        'ترتیب',  // school_user.sort_order
                        
                    ));

                });
            
            } //end foreach

        })->export('xls');

    }

    public function printExam()
    {
        $applications =  Application::all()->filter(function ($item) {
            if($item->user->hasRole('prospect') && isset($item->user->seat->seat_number)){
                return $item;    
            }
        })->sortBy(function ($item) {
            return $item->user->seat->seat_number;    
        });

        $data = array (
            'applications' => $applications,
        );
        return view('admin.application.exam', $data);
    }


    public function Cards()
    {
        $applications =  Application::all()->filter(function ($item) {
            if($item->user->hasRole('prospect') && isset($item->user->seat->seat_number)){
                return $item;    
            }
        })->sortBy(function ($item) {
            return $item->user->seat->seat_number;
        });

        $data = array (
            'applications' => $applications,
        );
        return view('admin.application.cards', $data);
    }


    public function unprintedCards()
    {
        $applications =  Application::all()->filter(function ($item) {
            //if($item->user->hasRole('prospect') && isset($item->user->seat->seat_number) && ($item->printed_card_at=="" || $item->getPrintedCardAtYear() <= 0)){
            if($item->user->hasRole('prospect') ){
                return $item;    
            }
        })->sortBy(function ($item) {
            return ($item->user->firstname);    
        })->sortBy(function ($item) {
            return ($item->user->lastname);    
        });

        $data = array (
            'applications' => $applications,
        );
        return view('admin.application.cards', $data);
    }


    public function printedCards()
    {
        $applications =  Application::all()->filter(function ($item) {
            if($item->user->hasRole('prospect') && isset($item->user->seat->seat_number) && !($item->printed_card_at=="" || $item->getPrintedCardAtYear() <= 0)){
                return $item;    
            }
        })->sortBy(function ($item) {
            return $item->user->seat->seat_number;    
        });

        $data = array (
            'applications' => $applications,
        );
        return view('admin.application.cards', $data);
    }


    public function examIndex()
    {
        $applications =  Application::all()->filter( function ($item) {
            if($item->user->hasRole('prospect') && $item->accepted_exam > 0 ){
                return $item;    
            }
        } );

        $data = array (
            'applications' => $applications,
            'user' => Auth::user(),
        );

        return view('admin.exam.index', $data);
    }

    public function examImport()
    {
        $data = array (
            'user' => Auth::user(),
        );

        return view('admin.exam.import', $data);
    }

    public function examUpload( Request $request )
    {

        $this->validate($request, [
            'file' => 'required',
        ]);

        if(Input::hasFile('file'))
        {
            $user = Auth::User();
            $destinationPath = 'uploads/excel/';
            $file = Input::file('file');
            $extension = $file->getClientOriginalExtension();

            if($extension == 'xls'){
                $fileName = 'exam' . '_' . time() . '_' . $user->id . '.' . $extension;
                $file->move($destinationPath, $fileName);
                
                Excel::selectSheets('نتیجه آزمون')->load($destinationPath . $fileName, function($reader) {

                    // Getting all results
                    $rows = $reader->get();

                    $rows->each(function($row) {

                        if($row->accepted == 1){
                            $user = User::find($row->id);
                            $user->application->accepted_exam = $row->accepted;
                            $user->application->interview_at = $row->interview_at;
                            $user->application->save();
                        }else{
                            $user = User::find($row->id);
                            $user->application->accepted_exam = null;
                            $user->application->interview_at = $row->interview_at;
                            $user->application->save();
                        }

                    });

                });

                Session::flash('alert-success','Data imported');
                return redirect('/admin/exam/import');

            }else{
                Session::flash('alert-danger','This is not an Excel file.');
                return redirect('/admin/exam/import');
            }

        }else{
            Session::flash('alert-danger','File was not uploaded.');
            return redirect('/admin/exam/import');
        }

    }

}