<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Schedule;

class DashboardController extends Controller
{
	public function index(){

		$data = array (
			'user' => Auth::user(),
            'schedules' => Schedule::all(),
            'registration_open' => Schedule::isRegistrationOpen('1'),
            'print_card_open' => Schedule::isPrintCardOpen('1'),
            'view_results_open' => Schedule::isViewResultsOpen('1'),
            'results_open' => Schedule::isViewResultsOpen('1'),
		);
		
		return view('dashboard', $data);
   	}
}
