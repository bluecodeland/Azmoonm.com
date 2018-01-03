<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Option;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;

class OptionsImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $image_options = Option::where('type', 'images')->get();

        return view('admin.settings.images.index', compact('image_options'));
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

        return view('admin.settings.images.edit', compact('option'));
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

        $this->validate($request, [
            'value' => 'required|max:1024',
        ]);

        if(Input::hasFile('value'))
        {
            $option = Option::findOrFail($id);
            $destinationPath = 'uploads/images/';
            $file = Input::file('value');
            $filename = $file->getClientOriginalName();

            $file->move($destinationPath, $file->getClientOriginalName());
            $option->value = $filename;
            $option->save();

        }

        Session::flash('alert-success','تصاویر شما بارگذاری شد.');

        return redirect('admin/settings/images');
    }

}
