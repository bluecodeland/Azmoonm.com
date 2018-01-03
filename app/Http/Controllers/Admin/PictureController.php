<?php

namespace App\Http\Controllers\Admin;

use App\Application;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Role;
use App\Seat;
use App\User;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Image;
use Session;

class PictureController extends Controller 
{
    public function pictureIndex(){

        $data = array (
            'user' => User::find(session('manage_user_id')),
        );
        return view('admin.users.picture.index', $data);
    }

    public function pictureUpload(Request $request)
    { echo session('manage_user_id');
        echo $request->manage_user_id;
        $this->validate($request, [
            'picture' => 'required',
        ]);

        if(Input::hasFile('picture'))
        {
            $user = User::find(session('manage_user_id'));
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
             'user' => User::find(session('manage_user_id')),
        );

        Session::flash('alert-success','عکس شما بارگذاری شد.');

        return redirect('/admin/users/picture/view');
    }

    public function pictureView(){

        $data = array (
            'user' => User::find(session('manage_user_id')),
        );

        return view('admin.users.picture.view', $data);
    }

    public function pictureSave(Request $request){
        $user = User::find(session('manage_user_id'));
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
             'user' => User::find(session('manage_user_id')),
        );

        Session::flash('alert-success','تصویر شما با موفقیت بارگذاری شد. در ادامه، فرم زیر را تکمیل بفرمایید.');

            return redirect('/admin/users/');
    }
}