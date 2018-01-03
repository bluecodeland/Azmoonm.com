@extends('layouts.dashboard')

@section('title', 'نمایش فرم ثبت نام')

@section('content')
<div class="container print-form">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">نمایش فرم ثبت نام</h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/admin">مدیریت سایت</a></li>
      <li>نمایش فرم ثبت نام</li>
    </ol>
    <div class="clearfix"></div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <a href="#" onClick="window.print();return false">
        <button type="button" class="btn btn-danger">
          <i class="fa fa-btn fa-print "></i> چاپ فرم
        </button>
      </a>
    </div>
    <div class="panel-body">
      <div class="col-md-6 col-xs-12">
        <div class="row">
          <div class="col-md-4 col-xs-6">عکس</div>
          <div class="col-md-8 col-xs-6">
            <img src="/uploads/photo/{{ $user->picture }}" class="photo large" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-xs-6">کد پیگیری</div>
          <div class="col-md-8 col-xs-6">
            {{ $user->application->application_reference }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">تاریخ ثبت نام</div>
          <div class="col-md-8 col-xs-6">
            {{ $user->application->getIranianDate( $user->application->created_at ) }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">نام</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->firstname }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">نام خانوادگی</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->lastname }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">نام پدر</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->fathers_name }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">کد ملی</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->national_code }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">شماره شناسنامه</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->id_number }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">تاریخ تولد</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->birth_date }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">محل تولد</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->birth_place }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">محل صدور شناسنامه</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->place_of_issue }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">وضعیت تأهل</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->getMaritalStatus( $user->application->marital_status ) }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">تعداد اولاد</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->children }}
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xs-12">
        <div class="row">      
          <div class="col-md-4 col-xs-6">آدرس پست الکترونیکی</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->email }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">تلفن همراه</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->mobile }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">شماره تلفن ثابت</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->landline }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">استان محل سکونت</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->state }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">شهر محل سکونت</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->city }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">آدرس محل سکونت</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->address }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">وضعیت اشتغال</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->getEmploymentStatus( $user->application->employment_status ) }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">عنوان شغل</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->place_of_work }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">معدل پایه اول</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->level_1_grade }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">معدل پایه دوم</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->level_2_grade }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">معدل پایه سوم</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->level_3_grade }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">معدل پایه چهارم</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->level_4_grade }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">معدل پایه پنجم</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->level_5_grade }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">مدرسه محل تحصیل</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->current_school }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">مدارس/مرکز</div>
          <div class="col-md-8 col-xs-6">     
            @foreach($user->schools as $item)
            {{ $item->pivot->sort_order }}. {{ $item->label }}<br>
            @endforeach
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">ایجاد شده</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->created_at }}
          </div>
        </div>
        <div class="row">      
          <div class="col-md-4 col-xs-6">به روز شده</div>
          <div class="col-md-8 col-xs-6">     
            {{ $user->application->updated_at }}
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
    </div>
  </div>
  <div class="clearfix"></div>
</div>
@endsection
