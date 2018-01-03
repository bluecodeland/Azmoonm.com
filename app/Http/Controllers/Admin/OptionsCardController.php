<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Option;
use Illuminate\Http\Request;
use Session;

class OptionsCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $card_options = Option::where('type', 'card')->get();

        return view('admin.settings.card.index', compact('card_options'));
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

        return view('admin.settings.card.edit', compact('option'));
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

        return redirect('admin/settings/card');
    }

}
