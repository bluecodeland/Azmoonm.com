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

class AcademicController extends Controller
{
	public function index(){
	    $applications =  Application::all()->filter(function ($item) {
            return $item->user->hasRole('prospect');
        });

        $applications_count_completed =  Application::all()->filter(function ($item) {
            if($item->user->hasRole('prospect') && isset($item->user->seat->seat_number)){
                return $item;               
            }
        })->count();

        $applications_count_incomplete =  Application::all()->filter(function ($item) {
            if($item->user->hasRole('prospect') && !($item->user->seat)){
                return $item;               
            }
        })->count();

		$contacts_count = Contact::all()->count();

        $printed_card_count =  Application::all()->filter(function ($item) {
            if($item->user->hasRole('prospect') && ($item->printed_card_at!="")){
                return $item;               
            }
        })->count();

		$data = array (
			'applications_count'  => $applications->count(),
			'applications_count_completed'  => $applications_count_completed,
			'applications_count_incomplete'  => $applications_count_incomplete,
			'contacts_count'  => $contacts_count,
            'printed_card_count'  => $printed_card_count, 
		);
		return view('/academic/index', $data);
	}
}
