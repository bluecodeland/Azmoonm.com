<?php

namespace App\Http\Controllers;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        $data = array (
            'user' => $user,
            'aptitude_results' => $user->results->aptitude_results,
            'fiqh_results' => $user->results->fiqh_results,
            'usul_results' => $user->results->usul_results,
            'essay_results' => $user->results->essay_results,
        );

        return view('user.results.index', $data);
    }

}
