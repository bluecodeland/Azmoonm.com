<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class SettingController extends Controller
{
    /**
     * Show site settings
     *
     * @param  none
     * @return Response
     */
    public function index()
    {
        $data = array (
            'user' => Auth::user(),
        );
        
        return view('admin.settings.index', $data);
    }

}
