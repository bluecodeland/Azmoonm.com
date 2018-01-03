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

class UsersController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::where('name','!=','schooladmin')->pluck('label', 'id');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [          
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'mobile' => 'required|size:11|unique:users',
            'email' => 'required|email|max:255|unique:users',
        ]);
        $requestData = $request->all();
        
        $password = generatePassword();
        $user = User::create($requestData);
        $role = Role::findOrFail($request->role_id);
        $user->roles()->save($role);
        $user->password = bcrypt($password);
        $user->save();

        if($role->name == "prospect"){
            $application_reference = rand(100000, 999999);
            $datetime = date("Y-m-d H:i:s");
            $application = Application::create([
                'user_id' => $user->id,
                'application_reference' => $application_reference,
                'submission_date' => '0000-00-00 00:00:00',
                'created_at' => $datetime,
                'updated_at' => $datetime,
            ]);
        }

        if($request->send_password == "1"){
            sendSMS( $user, $password, 'register' );
            sendEmail( $user, $password, 'register' );
        }

        Session::flash('alert-success', 'کاربر اضافه شده');

        Session::put('manage_user_id', $user->id);
        return redirect('admin/users/picture/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $this->validate($request, [          
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'mobile' => ['required', 'size:11', Rule::unique('users')->ignore($id, 'id'),],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($id, 'id'),],
        ]);

        $requestData = $request->all();
        
        $user = User::findOrFail($id);
        $user->update($requestData);

        Session::flash('alert-success', 'کاربر به روز رسانی');

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->roles()->detach();
        Application::where('user_id', $id)->delete();
        $user->delete();

        Session::flash('alert-success', 'کاربر حذف شده!');

        return redirect('admin/users');
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

        $x = 0;
        foreach($users as $item){
            $user = User::find($item->id);
            sendSMS( $user, '', 'times-up' );
            sendEmail( $user, '', 'times-up' );
            $user->roles()->detach();
            Application::where('user_id', $user->id)->delete();
            $user->delete();
            $x++;
        }

        echo getHindiNumerals("فرم ها حذف شده $x");

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
        //delete all existing seats
        echo Seat::all()->count() . "<br>";
        Seat::query()->truncate();

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

        $x = 0;
        foreach($users as $item){
            $user = User::find($item->id);
            if(!$user->seat){
                $x++;
                $seat = new Seat;
                $seat->exam_id = 1;
                $seat->seat_number = $seat->getAvailableSeat();
                $user->seat()->save($seat);
            }
        }
        echo getHindiNumerals("صندلی اختصاص داده $x");
    }

}
