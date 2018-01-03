<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Schedule;

use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\Facades\jDateTime;

class AdmissionController extends Controller
{
    /**
     * Show all admissions settings
     *
     * @param  none
     * @return Response
     */
    public function index()
    {
        $data = array (
            'user' => Auth::user(),
            'schedules' => Schedule::all(),
        );
        
        return view('admin.settings.admissions.index', $data);
    }

    /**
     * Show the admissions
     *
     * @param  none
     * @return Response
     */
    public function admissionsIndex($id)
    {
        $data = array (
            'user' => Auth::user(),
            'schedule' => Schedule::find($id),
        );
        
        return view('admin.settings.admissions.admissions', $data);
    }

    /**
     * Show the profile for the given user.
     *
     * @param  none
     * @return Response
     */
    public function admissionsUpdate(Request $request, $id)
    {

        $schedule = Schedule::find($id);
        $schedule->deadline = getGregorianDate(getArabicNumerals($request->deadline));
        $schedule->save();

        return redirect('/admin/settings/admissions');
    }

}
