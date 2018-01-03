<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Auth;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Application;
use App\Contact;
use App\Exam;
use App\Seat;
use App\User;

class ContactController extends Controller
{
    public function index()
    {
		$contacts     = Contact::all();

		$data = array (
			'contacts'     => $contacts,
		);
		return view('/admin/contacts/index', $data);
	}

    public function create(Request $request)
    {
		$this->validate($request, [
			'email' => 'required|email|max:255',
			'name' => 'required|max:255',
			'subject' => 'required|max:255',
			'message' => 'required|max:1024',
		]);

        $contact = new Contact;

		$contact->email = $request->email;
		$contact->name = $request->name;
		$contact->subject = $request->subject;
		$contact->message = $request->message;

        $contact->save();

		$request->session()->flash('alert-success', 'پیغام شما با موفقیت ارسال شد.');

        return Redirect::back();
    }

    public function reply(Request $request)
    {
		$contact = Contact::find($request->id);
		$data = array (
			'contact'     => $contact,
		);
		return view('/admin/contacts/reply', $data);
	}

    public function send(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|max:255',
            'name' => 'required|max:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:2048',
        ]);

		$contact = new Contact;

        $contact->email = $request->email;
        $contact->name = $request->name;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->parent_id = $request->id;

        $contact->save();

		$request->session()->flash('alert-success', 'Your message was successful sent!');

        $user = Auth::user();

        Mail::send('emails.message', ['user' => $user], function ($m) use ($user) {
            $m->from('info@qaim.ir', 'Your Application');

            $m->to('mohsin.shah@gmail.com', 'test')->subject('Your Reminder!');
        });

        return redirect('/admin/contacts/index');
    }

}
