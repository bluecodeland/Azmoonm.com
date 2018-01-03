@extends('layouts.dashboard')

@section('title', 'فرم ثبت نام')

@section('content')
<div class="container print-form">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">فرم ثبت نام مرکز فقهی قائم<sup>(عج)</sup></h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/dashboard">صفحه اصلی</a></li>
      <li><a href="/application/update">فرم ثبت نام</a></li>
      <li>چاپ فرم</li>
    </ol>
    <div class="clearfix"></div>
  </div>

  <div class="clearfix bottom-buffer"></div>
  @if (count($errors) > 0)
  <div class="alert alert-danger">
    خطا! ثبت نام قطعی شده قابل ذخیره نیست. لطفا مشکلات اشاره شده در فرم را رفع و سپس اقدام به ذخیره آن نمایید.
  </div>
  @endif
  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
  @if(Session::has('alert-' . $msg))
  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
  @endif
  @endforeach
  <div class="panel panel-default">
    <div class="panel-heading">
      <a href="#" onClick="window.print();return false">
        <button type="button" class="btn btn-danger">
          <i class="fa fa-btn fa-print "></i> چاپ فرم
        </button>
      </a>
      <a href="{{ url('/application/update') }}">
        <button type="button" class="btn btn-primary">
          <i class="fa fa-btn fa-edit "></i> ویرایش
        </button>
      </a>
      <a href="{{ url('/dashboard') }}">
        <button type="button" class="btn btn-primary">
          <i class="fa fa-btn fa-dashboard "></i> صفحه اصلی
        </button>
      </a>
    </div>
    <div class="panel-body">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-4">عکس</div>
          <div class="col-md-8">
            <img src="/uploads/photo/{{ $user->picture }}" class="photo" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">کد پیگیری</div>
          <div class="col-md-8">
            {{ $user->application->application_reference }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">تاریخ ثبت نام</div>
          <div class="col-md-8">
            {{ $user->application->getIranianDate( $user->application->created_at ) }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">نام</div>
          <div class="col-md-8">     
            {{ $user->firstname }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">نام خانوادگی</div>
          <div class="col-md-8">     
            {{ $user->lastname }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">نام پدر</div>
          <div class="col-md-8">     
            {{ $user->application->fathers_name }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">کد ملی</div>
          <div class="col-md-8">     
            {{ $user->application->national_code }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">شماره شناسنامه</div>
          <div class="col-md-8">     
            {{ $user->application->id_number }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">تاریخ تولد</div>
          <div class="col-md-8">     
            {{ $user->application->birth_date }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">محل تولد</div>
          <div class="col-md-8">     
            {{ $user->application->birth_place }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">محل صدور شناسنامه</div>
          <div class="col-md-8">     
            {{ $user->application->place_of_issue }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">وضعیت تأهل</div>
          <div class="col-md-8">     
            {{ $user->application->getMaritalStatus( $user->application->marital_status ) }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">تعداد اولاد</div>
          <div class="col-md-8">     
            {{ $user->application->children }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">      
          <div class="col-md-4">آدرس پست الکترونیکی</div>
          <div class="col-md-8">     
            {{ $user->email }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">تلفن همراه</div>
          <div class="col-md-8">     
            {{ $user->mobile }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">شماره تلفن ثابت</div>
          <div class="col-md-8">     
            {{ $user->application->landline }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">استان محل سکونت</div>
          <div class="col-md-8">     
            {{ $user->application->state }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">شهر محل سکونت</div>
          <div class="col-md-8">     
            {{ $user->application->city }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">آدرس محل سکونت</div>
          <div class="col-md-8">     
            {{ $user->application->address }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">وضعیت اشتغال</div>
          <div class="col-md-8">     
            {{ $user->application->getEmploymentStatus( $user->application->employment_status ) }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">عنوان شغل</div>
          <div class="col-md-8">     
            {{ $user->application->place_of_work }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">معدل پایه اول</div>
          <div class="col-md-8">     
            {{ $user->application->level_1_grade }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">معدل پایه دوم</div>
          <div class="col-md-8">     
            {{ $user->application->level_2_grade }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">معدل پایه سوم</div>
          <div class="col-md-8">     
            {{ $user->application->level_3_grade }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">معدل پایه چهارم</div>
          <div class="col-md-8">     
            {{ $user->application->level_4_grade }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">معدل پایه پنجم</div>
          <div class="col-md-8">     
            {{ $user->application->level_5_grade }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4">مدرسه محل تحصیل</div>
          <div class="col-md-8">     
            {{ $user->application->current_school }}
          </div>
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <a href="#" onClick="window.print();return false">
        <button type="button" class="btn btn-danger">
          <i class="fa fa-btn fa-print "></i> چاپ فرم
        </button>
      </a>
      <a href="{{ url('/application/update') }}">
        <button type="button" class="btn btn-primary">
          <i class="fa fa-btn fa-edit "></i> ویرایش
        </button>
      </a>
      <a href="{{ url('/dashboard') }}">
        <button type="button" class="btn btn-primary">
          <i class="fa fa-btn fa-dashboard "></i> صفحه اصلی
        </button>
      </a>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
@endsection
