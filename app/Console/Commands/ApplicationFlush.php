<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\User;
use App\Application;

class ApplicationFlush extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'application:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush incomplete application from the system.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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

        $now = time();
        foreach($users as $item){
            $diff = floor($now - strtotime($item->created_at)) / (60 * 60 * 24);
            if($diff < 1) {
                // do nothing!
            }elseif($diff > 1 AND $diff < 3) {
                if($item->reminder == 0){
                    $user = User::find($item->id);
                    sendSMS( $user, '', 'reminder' );
                    sendEmail( $user, '', 'reminder' );
                    $user->reminder = 1;
                    $user->save();
                }else{
                    // do nothing!
                }
            }elseif($now-strtotime($item->created_at) >= 3) {
                $user = User::find($item->id);
                sendSMS( $user, '', 'delete' );
                sendEmail( $user, '', 'delete' );
                $user->roles()->detach();
                Application::where('user_id', $user->id)->delete();
                $user->delete();
            }
        }
        return true;
    }
}
