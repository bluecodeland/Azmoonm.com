<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Application;
use App\Role;
use App\Seat;
use App\User;
use Illuminate\Http\Request;
use Session;
use Illuminate\Validation\Rule;
use DB;

class DataManagementController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = array (
            $users = User::all(),
        );

        return view('admin.settings.data-management.index', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function execute(Request $request)
    {

        $incomplete_applications_deleted = 0;
        $existing_seats = Seat::all()->count();
        $new_seats_added = 0;


        if($request->delete_incomplete_applications == "1"){
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

            foreach($users as $item){
                $user = User::find($item->id);
                if($request->send_deletion_sms == "1"){
                    sendSMS( $user, '', 'times-up' );
                }
                if($request->send_deletion_email == "1"){
                    sendEmail( $user, '', 'times-up' );
                }
                $user->roles()->detach();
                Application::where('user_id', $user->id)->delete();
                $user->delete();
                $incomplete_applications_deleted++;
            }

        }
        if($request->delete_all_seats == "1"){
            //delete all existing seats
            Seat::query()->truncate();
        }
        if($request->add_new_seats == "1"){

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
                ->havingRaw("users.picture <> '00000000.png' AND applications.form_complete = 1 AND count(school_user.school_id) >= 3")
                ->orderBy('users.id')
                ->get();

            foreach($users as $item){
                $user = User::find($item->id);
                if(!$user->seat){
                    $new_seats_added++;
                    $seat = new Seat;
                    $seat->exam_id = 1;
                    $seat->seat_number = $seat->getAvailableSeat();
                    $user->seat()->save($seat);
                }
            }
        }
        $results = 'فرم ها حذف شده = ' . $incomplete_applications_deleted . ' | ';
        $results .= 'صندلی حذف شده = ' . $existing_seats . ' | ';
        $results .= 'صندلی اختصاص داده = ' . $new_seats_added ;

        Session::flash('alert-success', getHindiNumerals($results));

        $data = array (
            $users = User::all(),
        );

        return view('admin.settings.data-management.index', $data);
    }

    /**
     * Deletes all incomplete prospect records from the system
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function deleteIncomplete()
    {

    }

    /**
     * Allocate seats to all completed record
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function allocateSeats()
    {

    }

}
