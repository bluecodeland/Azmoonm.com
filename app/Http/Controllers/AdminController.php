<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Application;
use App\Contact;
use App\Exam;
use App\Role;
use App\Seat;
use App\User;
use App\School;
use Session;
use DB;
use Charts;
use DateTime;
use DateInterval;
use DatePeriod;

class AdminController extends Controller
{
	public function index(){

        $applications_count = Application::count();

        $order_full = array('اول','دوم','سوم','چهارم','پنجم','ششم','هفتم','هشتم','نهم','دهم','یازدهم','دوازدهم','سیزدهم','چهاردهم','پانزدهم','شانزدهم','هجدهم','هفدهم','نوزدهم','بیستم');
        $schools = School::all()->pluck('label');
        $school_count = School::count();
        $order = array_slice($order_full, 0, $school_count);

        $bar_chart = Charts::multi('bar', 'morris')
            ->title("درخواست ها در هر مدرسه")
            ->labels($schools);
        for ($i = 0; $i < $school_count; $i++) {
            $schools_data = DB::table('school_user')
                        ->join('role_user', 'school_user.user_id', '=', 'role_user.user_id')
                        ->join('roles', 'role_user.role_id', '=', 'roles.id')
                        ->select(DB::raw('count(*) as count_row'))
                        ->groupBy(DB::raw("sort_order, school_id"))
                        ->where("sort_order", $i+1)
                        ->where('roles.name','=','prospect')
                        ->get();
            $school_array = array_column($schools_data->toArray(),'count_row');
            $bar_chart->dataset($order[$i], $school_array);
        }

        $applications_incomplete = DB::table("applications")
            ->select(DB::raw('date(users.created_at) as created_at, count(*) as count_row'))
            ->join('users', 'applications.user_id', '=', 'users.id')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->leftJoin('school_user', 'users.id', '=', 'school_user.user_id')
            ->groupBy(DB::raw("date(`users`.`created_at`)"))
            ->orderBy(DB::raw("date(`users`.`created_at`)"))
            ->whereRaw(DB::raw("`roles`.`name` = 'prospect' AND (`users`.`picture` ='00000000.png' OR `applications`.`form_complete` = '0' )"))
            ->havingRaw(DB::raw("count(school_user.school_id) < 3"))
            ->get();

        $applications_complete = DB::table("applications")
            ->select(DB::raw('date(applications.created_at) as created_at, count(*) as count_row'))
            ->groupBy(DB::raw("date(`applications`.`created_at`)"))
            ->orderBy(DB::raw("date(`applications`.`created_at`)"))
            ->get();

        $min = DB::table("applications")
            ->join('users', 'applications.user_id', '=', 'users.id')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->whereRaw(DB::raw("`roles`.`name` = 'prospect'"))
            ->min(DB::raw("date(users.created_at)"));

        $max = DB::table("applications")
            ->join('users', 'applications.user_id', '=', 'users.id')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->whereRaw(DB::raw("`roles`.`name` = 'prospect'"))
            ->max(DB::raw("date(users.created_at)"));

        $begin = new DateTime( $min );
        $begin = date_sub($begin, date_interval_create_from_date_string('1 day'));
        $end = new DateTime( $max );
        $end = date_add($end, date_interval_create_from_date_string('2 day'));
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        $applications_incomplete_array = array();
        $applications_complete_array = array();
        $labels_array = array();

        foreach ( $period as $dt ){
            $incomplete = 0;
            $complete = 0;
            $labels_array[] = getHindiNumerals( jdate( $dt->format('Y-m-d') )->format('%y-%m-%d') );
            foreach($applications_incomplete as $item){
                if($dt->format('Y-m-d') == $item->created_at){
                    $incomplete = $item->count_row;
                }
            }
            $applications_incomplete_array[] = $incomplete;

            foreach($applications_complete as $item){
                if($dt->format('Y-m-d') == $item->created_at){
                    $complete = $item->count_row;
                }
            }
            $applications_complete_array[] = $complete - $incomplete;
        }

        $line_graph = Charts::multi('area', 'morris')
        ->title(getHindiNumerals($applications_count) . " درخواست ها")
        ->colors(['#cb4b4b','#0b62a4',])
        ->labels($labels_array)
        ->dataset('ناقص', $applications_incomplete_array)
        ->dataset('کامل',  $applications_complete_array);

		$data = array (
            'applications_count' => $applications_count,
            'bar_chart' => $bar_chart,
            'line_graph' => $line_graph,
		);
		return view('/admin/index', $data);
   	}
    
    public function users(){
        return view('admin.users.index', ['users' => User::all()]);
    }
    public function createUser(){
        $roles =  Role::all()->filter(function ($item) {
            if($item->name != 'prospect') {
                return $item;               
            }
        });

        $data = array (
            'roles' => $roles,
        );
        return view('admin.users.create', $data);
    }
    public function storeUser(Request $request)
    {
        $this->validate($request, [          
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'mobile' => 'required|size:11|unique:users',
            'email' => 'required|email|max:255|unique:users',
        ]);

        $user = new User;

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        //$user->password = $request->password;
        $user->picture = '00000000.png';

        $user->save();

        $user->roles()->attach($request->role_id);

        return redirect('admin/users');
    }
    public function showUser( Request $request){
        return view('admin.users.show', ['user' => User::findOrFail($request->id)]);
    }
    public function editUser( Request $request ){
        return view('admin.users.edit', ['user' => User::findOrFail($request->id)]);
    }
    public function updateUser( Request $request ){
        $user = User::find($request->id);

        $this->validate($request, [
           
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'fathers_name' => 'required|max:255',
            'national_code' => 'required|max:255|unique:applications,national_code,'.$request->id,
            'id_number' => 'required|max:255',
            'birth_date' => 'required|max:10',
            'birth_place' => 'required|max:255',
            'place_of_issue' => 'required|max:255',

            'children' => 'max:2',

            'landline' => 'required|max:255',
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

        $user->application->save();

        Session::flash('alert-success','{{ $user->firstname}} {{ $user->lastname}} has been updates.');

        return redirect('admin/users');
    }

    public function deleteUser( Request $request, User $user){
        $user = User::find($request->id);
        $user->roles()->detach();
        Application::where('user_id', $request->id)->delete();
        $user->delete();
        
        return redirect('admin/users');
    }
    
}
