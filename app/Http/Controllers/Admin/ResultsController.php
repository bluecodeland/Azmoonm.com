<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Result;
use App\Seat;
use Auth;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;

class ResultsController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\View\View
    //  */
    // public function index(Request $request)
    // {
    //     $keyword = $request->get('search');
    //     $perPage = 25;

    //     if (!empty($keyword)) {
    //         $results = Result::where('user_id', 'LIKE', "%$keyword%")
				// ->orWhere('aptitude_results', 'LIKE', "%$keyword%")
				// ->orWhere('fiqh_results', 'LIKE', "%$keyword%")
				// ->orWhere('usul_results', 'LIKE', "%$keyword%")
				// ->orWhere('essay_results', 'LIKE', "%$keyword%")
				
    //             ->paginate($perPage);
    //     } else {
    //         $results = Result::paginate($perPage);
    //     }

    //     return view('admin.results.index', compact('results'));
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\View\View
    //  */
    // public function create()
    // {
    //     return view('admin.results.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param \Illuminate\Http\Request $request
    //  *
    //  * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    //  */
    // public function store(Request $request)
    // {
        
    //     $requestData = $request->all();
        
    //     Result::create($requestData);

    //     Session::flash('flash_message', 'Result added!');

    //     return redirect('admin/results');
    // }

    // *
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  *
    //  * @return \Illuminate\View\View
     
    // public function show($id)
    // {
    //     $result = Result::findOrFail($id);

    //     return view('admin.results.show', compact('result'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  *
    //  * @return \Illuminate\View\View
    //  */
    // public function edit($id)
    // {
    //     $result = Result::findOrFail($id);

    //     return view('admin.results.edit', compact('result'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  int  $id
    //  * @param \Illuminate\Http\Request $request
    //  *
    //  * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    //  */
    // public function update($id, Request $request)
    // {
        
    //     $requestData = $request->all();
        
    //     $result = Result::findOrFail($id);
    //     $result->update($requestData);

    //     Session::flash('flash_message', 'Result updated!');

    //     return redirect('admin/results');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  *
    //  * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    //  */
    // public function destroy($id)
    // {
    //     Result::destroy($id);

    //     Session::flash('flash_message', 'Result deleted!');

    //     return redirect('admin/results');
    // }


    /**
     * allow user to select excel file for import
     *
     * @return \Illuminate\View\View
     */
    public function import()
    {
        $data = array (
            'user' => Auth::user(),
        );

        return view('admin.results.import', $data);
    }

    public function upload( Request $request )
    {

        $count_import_success = 0;
        $count_import_fail = 0;
        $this->validate($request, [
            'file' => 'required',
        ]);

        if(Input::hasFile('file'))
        {
            $user = Auth::User();
            $destinationPath = 'uploads/excel/';
            $file = Input::file('file');
            $extension = $file->getClientOriginalExtension();

            if($extension == 'xls' OR $extension == 'xlsx'){
                $fileName = 'exam' . '_' . time() . '_' . $user->id . '.' . $extension;
                $file->move($destinationPath, $fileName);
                
                Excel::selectSheets('Sheet1')->load($destinationPath . $fileName, function($reader) {

                    // Getting all results
                    $rows = $reader->get();

                    $rows->each(function($row) {

                        $seats = Seat::all();
                        if($row->shmarh_sndl<>""){

                            $seat_exists = $seats->contains('seat_number', $row->shmarh_sndl);
                            if($seat_exists){
                                
                                // get the user_id by looking at the seat table
                                $user_id = Seat::where('seat_number', '=', $row->shmarh_sndl)->first()->user_id;

                                // attempt to find the record or create a new one
                                $results = Result::firstOrNew(array('user_id' =>  $user_id));
                                $results->user_id  = $user_id;
                                $results->aptitude_results = (int)$row->nmrh_hosh;
                                $results->fiqh_results = (int)$row->nmrh_fkh;
                                $results->usul_results = (int)$row->nmrh_asol;
                                $results->essay_results = (int)$row->nmrh_tshrh;
                                $results->save();
                                
                                // increment counter
                                $count_import_success++;

                            }else{

                                // increment counter
                                $count_import_fail++;

                            }

                        }


                    });

                });

                Session::flash('alert-success',"وارد $count_import_success با موفقیت و $count_import_fail ناموفق.");
                return redirect('/admin/results/import');

            }else{
                Session::flash('alert-danger','این یک فایل اکسل نیست.');
                return redirect('/admin/results/import');
            }

        }else{
            Session::flash('alert-danger','فایل آپلود نشد.');
            return redirect('/admin/results/import');
        }

    }

}
