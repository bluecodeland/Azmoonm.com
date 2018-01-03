<?php

namespace App\Http\Controllers\SchoolAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\School;
use Charts;
use Excel;
use PDO;

class SchoolAdminController extends Controller
{

    public function index()
    {
		$user = Auth::user();
		$school = School::where('admin_id',$user->id)->first();
		$applications_count = 		$schools_data = DB::table('school_user')
				        ->join('role_user', 'school_user.user_id', '=', 'role_user.user_id')
				        ->join('roles', 'role_user.role_id', '=', 'roles.id')
				        ->select(DB::raw('count(*) as count_row'))
				        ->where("school_user.school_id", $school->id)
				        ->where('roles.name','=','prospect')
				        ->count();

        $order_full = array('اول','دوم','سوم','چهارم','پنجم','ششم','هفتم','هشتم','نهم','دهم','یازدهم','دوازدهم','سیزدهم','چهاردهم','پانزدهم','شانزدهم','هجدهم','هفدهم','نوزدهم','بیستم');
        $schools = School::all()->pluck('label');
        $school_count = School::count();
        $order = array_slice($order_full, 0, $school_count);

		$schools_data = DB::table('school_user')
				        ->join('role_user', 'school_user.user_id', '=', 'role_user.user_id')
				        ->join('roles', 'role_user.role_id', '=', 'roles.id')
				        ->select(DB::raw('count(*) as count_row'))
				        ->groupBy(DB::raw("sort_order, school_id"))
				        ->where("school_user.school_id", $school->id)
				        ->where('roles.name','=','prospect')
				        ->get();
		$school_array = array_column($schools_data->toArray(),'count_row');

		$bar_chart = Charts::create('bar', 'morris')
		            ->title("درخواست ها (" . $applications_count . ")")
		            ->labels($order)
		    		->values($school_array);

		$data = array (
			'user' => $user,
			'school' => $school,
			'applications_count' => $applications_count,
			'bar_chart' => $bar_chart, 
		);
		
		return view('schooladmin.index', $data);
    }


        public function export()
    {

        Excel::create('قائم فهرست ثبت نام', function($excel) {

		$user = Auth::user();
		$school = School::where('admin_id',$user->id)->first();

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

        })->export('xls');

    }
}
