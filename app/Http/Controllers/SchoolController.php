<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\School;
use App\User;
class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $schools = $user->schools()->orderBy('sort_order')->get();
        return view('user.school.index', compact('schools','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();
        $selectedSchools = $user->schools()->pluck('id')->all();
        $schools = School::whereNotIn('id', $selectedSchools)->pluck('name', 'id');
        return view('user.school.create', compact('user','schools'));
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
        
        $requestData = $request->all();
        $user = Auth::user();

        $school_id = $request->school_id;
        $next_school_order = $user->getNextSchoolOrder( $user->id );
        $user->schools()->attach($school_id, ['sort_order' => $next_school_order ]);
        
        Session::flash('flash_message', 'School added!');

        return redirect('user/school');

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
        $school = School::findOrFail($id);

        return view('user.school.show', compact('school'));
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
        $school = School::findOrFail($id);

        return view('user.school.edit', compact('school'));
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
        
        $requestData = $request->all();
        
        $school = School::findOrFail($id);
        $school->update($requestData);

        Session::flash('flash_message', 'School updated!');

        return redirect('user/school');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($school_id)
    {
        $user = Auth::user();
        $user->schools()->detach($school_id);
        $user->reorderSchools($user->id);

        Session::flash('flash_message', 'School deleted!');

        return redirect('user/school');

    }

}
