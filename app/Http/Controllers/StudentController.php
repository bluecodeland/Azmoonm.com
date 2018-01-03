<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Application;
use App\Contact;
use App\Exam;
use App\Seat;
use App\User;

class StudentController extends Controller
{
	public function index(){
        $data = array (
            'user' => Auth::user(),
        );
		return view('/student/index', $data);
	}
}
