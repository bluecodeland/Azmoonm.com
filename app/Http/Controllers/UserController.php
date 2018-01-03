<?php

namespace App\Http\Controllers;

use File;
use Image;
use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Application;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showProfile()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

    public function savePassword(Request $request)
    {
        $user = Auth::user();
        if($request->password==$request->password_confirmation){
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect('logout');
        }else{
            //Add error handler
            echo "تکرار رمز عبور اشتباه است";
        }
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        if($request->password==$request->password_confirmation){
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect('logout');
        }else{
            //Add error handler
            echo "تکرار رمز عبور اشتباه است";
        }
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->roles()->detach();
        Application::where('user_id', $request->id)->delete();
        $user->delete();

        Session::flash('alert-success', 'کاربر حذف شده!');

        return Redirect::back();
    }

    public function getAdmins()
    {
        return 1;
    }

    public function picture(){

        $data = array (
            'user' => Auth::user(),
        );

        return view('user.picture.index', $data);
    }

    public function savePictureView(){

        $data = array (
            'user' => Auth::user(),
        );

        return view('user.picture.save', $data);
    }

    public function uploadPicture(Request $request)
    {

        $this->validate($request, [
            'picture' => 'required|max:1024',
        ]);

        if(Input::hasFile('picture'))
        {
            $user = Auth::User();
            $destinationPath = 'uploads/photo/';
            $file = Input::file('picture');
            $extension = $file->getClientOriginalExtension();

            //delete existing file if it exists
            if($user->picture!='00000000.png')
            {
                File::delete($destinationPath . $user->picture);
            }

            if($user->hasRole('prospect')){
                $fileName = $user->application->application_reference . '_' . time() . '.' . $extension;
            }else{
                $fileName = $user->id . '_' . time() . '.' . $extension;            
            }
            $file->move($destinationPath, $fileName);

            $user->picture = $fileName;
            $user->save();
        }

        $data = array (
             'user' => Auth::user(),
        );

        Session::flash('alert-success','عکس شما بارگذاری شد.');

        return redirect('/user/picture/save');
    }

    public function savePicture(Request $request){
        $user = Auth::User();
        $req=json_decode($request->imageData);
        $destination = 'uploads/photo/';
        $oldFileName = $request->filename;

        $imagick = Image::make($destination . $oldFileName);
        $mime = $imagick->mime;

        if ($mime == 'image/jpeg')
            $extension = '.jpg';
        elseif ($mime == 'image/png')
            $extension = '.png';
        elseif ($mime == 'image/gif')
            $extension = '.gif';
        else
            $extension = '';

        $height = $imagick->height();
        $width = $imagick->width();

        //resize based on scale
        $imagick->resize( $width * $req->scale, $height * $req->scale);
        //rotate image
        $imagick->rotate(360 - $req->angle);
        //crop image
        $imagick->crop($req->w, $req->h, $req->x, $req->y);
        //Write image to disk
        if($user->hasRole('prospect')){
            $newFileName = $user->application->application_reference . '_' . time() . $extension;
        }else{
            $newFileName = $user->id . '_' . time() . $extension;
        }
        $imagick->save($destination . $newFileName);

        $user->picture = $newFileName;
        $user->save();

        $data = array (
             'user' => Auth::user(),
        );

        Session::flash('alert-success','تصویر شما با موفقیت بارگذاری شد. در ادامه، فرم زیر را تکمیل بفرمایید.');

        if(Auth::user()->hasRole('superuser')) {
            return redirect('/admin');
        }

        if(Auth::user()->hasRole('admin')) {
            return redirect('/admin');
        }

        if(Auth::user()->hasRole('schooladmin')) {
            return redirect('/schooladmin');
        }

        if(Auth::user()->hasRole('prospect')) {
            return redirect('/application/update');
        }
    }

}