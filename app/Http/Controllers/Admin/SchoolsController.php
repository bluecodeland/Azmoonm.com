<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\School;
use App\User;
use App\Option;
use Illuminate\Http\Request;
use Session;
use Illuminate\Validation\Rule;
use SoapClient;

class SchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $schools = School::where('name', 'LIKE', "%$keyword%")
				->orWhere('label', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $schools = School::paginate($perPage);
        }

        return view('admin.settings.schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.settings.schools.create');
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
        $this->validate($request, [
            'name' => 'required|max:255',
            'label' => 'required|max:255',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'mobile' => 'required|size:11|unique:users',
            'email' => 'required|email|max:255|unique:users',
        ]);

        $password = generatePassword();
        $user = User::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'mobile' => $request['mobile'],
            'email' => strtolower($request['email']),
            'password' => bcrypt($password),
        ]);

        $school = School::create([
            'name' => $request['name'],
            'label' => $request['label'],
            'admin_id' => $user->id,
        ]);

        $school->admin->assign('schooladmin');

        $options = Option::all()->keyBy('name');
        $text =     $options->get('site_name_fa')->value . " " . $options->get('site_url')->value . PHP_EOL . PHP_EOL . 
                    "نام كاربري: " . $user->email . PHP_EOL . PHP_EOL . 
                    "كلمه ي عبور: " . $password ;
        date_default_timezone_set('Asia/Tehran');
        $client = new SoapClient('http://ip.sms.ir/ws/SendReceive.asmx?wsdl');
        $parameters['userName'] = env('SMS_USERNAME', '12345');
        $parameters['password'] = env('SMS_PASSWORD', '12345');
        $parameters['mobileNos'] = array(doubleval(getArabicNumerals($user->mobile)));
        $parameters['messages'] = array($text);
        $parameters['lineNumber'] = env('SMS_LINENUMBER', '12345');
        $parameters['sendDateTime'] = date("Y-m-d")."T".date("H:i:s");
        $client->SendMessageWithLineNumber($parameters);

        Session::flash('alert-success','رمز عبور به آدرس ایمیل شما ' . $user->email .' ارسال شد. در صورت عدم وجود ایمیل در صندوق پستی حتما شاخه هرزنامه های ایمیل خود را بررسی کنید.');

        return redirect('admin/settings/schools');
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

        return view('admin.settings.schools.show', compact('school'));
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

        return view('admin.settings.schools.edit', compact('school'));
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
        $school = School::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'label' => 'required|max:255',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'mobile' => ['required', 'size:11', Rule::unique('users')->ignore($school->admin->id, 'id'),],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($school->admin->id, 'id'),],
        ]);

        $school->name = $request['name'];
        $school->label = $request['label'];
        $school->save();

        $school->admin->firstname = $request['firstname'];
        $school->admin->lastname = $request['lastname'];
        $school->admin->mobile = $request['mobile'];
        $school->admin->email = strtolower($request['email']);
        $school->admin->save();

        Session::flash('alert-success','مدرسه ویرایش شده');

        return redirect('admin/settings/schools');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $school = School::find($id);
        User::destroy($school->admin_id);
        //School::destroy($id);

        Session::flash('flash_message', 'School deleted!');

        return redirect('admin/settings/schools');
    }
}
