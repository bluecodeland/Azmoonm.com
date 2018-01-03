<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Option;
use Illuminate\Http\Request;
use Session;

class OptionsSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $social_options = Option::where('type', 'social')->get();

        return view('admin.settings.social.index', compact('social_options'));
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
        $option = Option::findOrFail($id);

        return view('admin.settings.social.edit', compact('option'));
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
        
        $option = Option::findOrFail($id);
        $option->update($requestData);

        Session::flash('flash_message', 'Option updated!');

        return redirect('admin/settings/social');
    }

}
