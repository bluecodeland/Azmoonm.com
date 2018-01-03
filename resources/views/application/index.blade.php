@extends('layouts.dashboard')

@section('title', 'فرم ثبت نام')

@section('content')
<div class="container">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">فرم ثبت نام</h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/dashboard">صفحه اصلی</a></li>
      <li><a href="/user/picture">عکس برای ثبت نام</a></li>
      <li>فرم ثبت نام</li>
    </ol>
    <div class="clearfix"></div>
  </div>

  <div class="col-md-12 bottom-buffer">
    <p class="">
      <strong>طلبه گرامی!</strong> لطفا نکات زیر را مطالعه و سپس اقدام به تکمیل فرم ثبت نام در آزمون نمایید. با تشکر
    </p>
    <p>

    <ol>
      <li>تمامی قسمت ها ضروری است، لطفا کامل و با دقت آن ها را تکمیل کنید.</li>
      <li>عکس انتخابی شما باید حتما با فرمت JPG و حجم آن نیز حد اکثر یک مگابایت باشد. </li>
      <li>پس از تکمیل و ذخیره فرم و اطمینان از صحت اطلاعات وارد شده، اقدام به چاپ کارت شرکت در آزمون نمایید.</li>
      <li>در صورت داشتن هر گونه سوال یا مشکل در ثبت نام با تلفن مرکز فقهی قائم<sup>(عج)</sup> تماس برقرار نمایید.</li>
      <li> از طریق نام کاربری qaimcallcenter در برنامه اسکایپ نیز می توانید با مرکز فقهی قائم<sup>(عج)</sup> ارتباط برقرار کنید</li>
    </ol>

    </p>
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

  <form action="{{ URL::to('application/update') }}" method="POST" class="form-horizontal bottom-buffer" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="panel panel-default">
      <!-- personal -->
      <div class="panel-body panel-extra">
        <h2>مشخصات فردی</h2>
        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
          <label for="firstname" class="col-sm-3 control-label">نام</label>
          <div class="col-sm-6">
            <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname') }}">
            @if ($errors->has('firstname'))
            <span class="help-block">
              <strong>{{ $errors->first('firstname') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
          <label for="lastname" class="col-sm-3 control-label">نام خانوادگی</label>
          <div class="col-sm-6">
            <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}">
            @if ($errors->has('lastname'))
            <span class="help-block">
              <strong>{{ $errors->first('lastname') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('fathers_name') ? ' has-error' : '' }}">
          <label for="fathers_name" class="col-sm-3 control-label">نام پدر</label>
          <div class="col-sm-6">
            <input type="text" name="fathers_name" id="fathers_name" class="form-control" value="{{ old('fathers_name') }}">
            @if ($errors->has('fathers_name'))
            <span class="help-block">
              <strong>{{ $errors->first('fathers_name') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('national_code') ? ' has-error' : '' }}">
          <label for="national_code" class="col-sm-3 control-label">کد ملی</label>
          <div class="col-sm-6">
            <input type="text" name="national_code" id="national_code" class="form-control" value="{{ old('national_code') }}">
            @if ($errors->has('national_code'))
            <span class="help-block">
              <strong>{{ $errors->first('national_code') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('id_number') ? ' has-error' : '' }}">
          <label for="id_number" class="col-sm-3 control-label">شماره شناسنامه</label>
          <div class="col-sm-6">
            <input type="text" name="id_number" id="id_number" class="form-control" value="{{ old('id_number') }}">
            @if ($errors->has('id_number'))
            <span class="help-block">
              <strong>{{ $errors->first('id_number') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
          <label for="birth_date" class="col-sm-3 control-label">تاریخ تولد</label>
          <div class="col-sm-6">
            <input type="text" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date') }}" placeholder="مانند ۱۳۷۰/۰۵/۱۳">
            @if ($errors->has('birth_date'))
            <span class="help-block">
              <strong>{{ $errors->first('birth_date') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('birth_place') ? ' has-error' : '' }}">
          <label for="birth_place" class="col-sm-3 control-label">محل تولد</label>
          <div class="col-sm-6">
            <input type="text" name="birth_place" id="birth_place" class="form-control" value="{{ old('birth_place') }}">
            @if ($errors->has('birth_place'))
            <span class="help-block">
              <strong>{{ $errors->first('birth_place') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('place_of_issue') ? ' has-error' : '' }}">
          <label for="place_of_issue" class="col-sm-3 control-label">محل صدور شناسنامه</label>
          <div class="col-sm-6">
            <input type="text" name="place_of_issue" id="place_of_issue" class="form-control" value="{{ old('place_of_issue') }}">
            @if ($errors->has('place_of_issue'))
            <span class="help-block">
              <strong>{{ $errors->first('place_of_issue') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : '' }}">
          <label for="marital_status" class="col-sm-3 control-label">وضعیت تأهل</label>
          <div class="col-sm-6">
            <label class="radio-inline"><input type="radio" id="marital_status" name="marital_status" value="0" checked>مجرد</label>
            <label class="radio-inline"><input type="radio" id="marital_status" name="marital_status" value="1">متاهل</label>
            @if ($errors->has('marital_status'))
            <span class="help-block">
              <strong>{{ $errors->first('marital_status') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('children') ? ' has-error' : '' }}">
          <label for="children" class="col-sm-3 control-label">تعداد اولاد</label>
          <div class="col-sm-6">
            <input type="text" name="children" id="children" class="form-control" value="{{ old('children') }}">
            @if ($errors->has('children'))
            <span class="help-block">
              <strong>{{ $errors->first('children') }}</strong>
            </span>
            @endif
          </div>
        </div>
      </div>

      <!-- communications -->
      <div class="panel-body panel-extra">
        <h2>بخش مربوط به راه های ارتباطی</h2>
        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
          <label for="mobile" class="col-sm-3 control-label">تلفن همراه</label>
          <div class="col-sm-6">
            <input type="text" name="mobile" id="mobile" class="form-control" value="{{ $user->mobile }}">
            @if ($errors->has('mobile'))
            <span class="help-block">
              <strong>{{ $errors->first('mobile') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('landline') ? ' has-error' : '' }}">
          <label for="landline" class="col-sm-3 control-label">شماره تلفن ثابت</label>
          <div class="col-sm-6">
            <input type="text" name="landline" id="landline" class="form-control" value="{{ old('landline') }}"placeholder="مانند ۱۲۳۴۵۶۷۸-۰۲۱">
            @if ($errors->has('landline'))
            <span class="help-block">
              <strong>{{ $errors->first('landline') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
          <label for="state" class="col-sm-3 control-label">استان محل سکونت</label>
          <div class="col-sm-6">
            <input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}">
            @if ($errors->has('state'))
            <span class="help-block">
              <strong>{{ $errors->first('state') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
          <label for="city" class="col-sm-3 control-label">شهر محل سکونت</label>
          <div class="col-sm-6">
            <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
            @if ($errors->has('city'))
            <span class="help-block">
              <strong>{{ $errors->first('city') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
          <label for="address" class="col-sm-3 control-label">آدرس محل سکونت</label>
          <div class="col-sm-6">
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
            @if ($errors->has('address'))
            <span class="help-block">
              <strong>{{ $errors->first('address') }}</strong>
            </span>
            @endif
          </div>
        </div>
      </div>

      <!-- work -->
      <div class="panel-body panel-extra">
        <h2> وضعیت اشتغال</h2>
        <div class="form-group{{ $errors->has('employment_status') ? ' has-error' : '' }}">
          <label for="employment_status" class="col-sm-3 control-label">وضعیت اشتغال</label>
          <div class="col-sm-6">
            <label class="radio-inline"><input type="radio" id="employment_status" name="employment_status" value="0" checked>غیر شاغل</label>
            <label class="radio-inline"><input type="radio" id="employment_status" name="employment_status" value="1">شاغل</label>
            @if ($errors->has('employment_status'))
            <span class="help-block">
              <strong>{{ $errors->first('employment_status') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('place_of_work') ? ' has-error' : '' }}">
          <label for="place_of_work" class="col-sm-3 control-label">عنوان شغل</label>
          <div class="col-sm-6">
            <input type="text" name="place_of_work" id="place_of_work" class="form-control" value="{{ old('place_of_work') }}">
            @if ($errors->has('place_of_work'))
            <span class="help-block">
              <strong>{{ $errors->first('place_of_work') }}</strong>
            </span>
            @endif
          </div>
        </div>
      </div>
      
      <!-- grades -->
      <div class="panel-body panel-extra">
        <h2>مشخصات حوزوی</h2>
        <div class="form-group{{ $errors->has('level_1_grade') ? ' has-error' : '' }}">
          <label for="level_1_grade" class="col-sm-3 control-label">معدل پایه اول</label>
          <div class="col-sm-6">
            <input type="text" name="level_1_grade" id="level_1_grade" class="form-control" value="{{ old('level_1_grade') }}" placeholder="مانند ۱۹/۹۰">
            @if ($errors->has('level_1_grade'))
            <span class="help-block">
              <strong>{{ $errors->first('level_1_grade') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('level_2_grade') ? ' has-error' : '' }}">
          <label for="level_2_grade" class="col-sm-3 control-label">معدل پایه دوم</label>
          <div class="col-sm-6">
            <input type="text" name="level_2_grade" id="level_2_grade" class="form-control" value="{{ old('level_2_grade') }}">
            @if ($errors->has('level_2_grade'))
            <span class="help-block">
              <strong>{{ $errors->first('level_2_grade') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('level_3_grade') ? ' has-error' : '' }}">
          <label for="level_3_grade" class="col-sm-3 control-label">معدل پایه سوم</label>
          <div class="col-sm-6">
            <input type="text" name="level_3_grade" id="level_3_grade" class="form-control" value="{{ old('level_3_grade') }}">
            @if ($errors->has('level_3_grade'))
            <span class="help-block">
              <strong>{{ $errors->first('level_3_grade') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('level_4_grade') ? ' has-error' : '' }}">
          <label for="level_4_grade" class="col-sm-3 control-label">معدل پایه چهارم</label>
          <div class="col-sm-6">
            <input type="text" name="level_4_grade" id="level_4_grade" class="form-control" value="{{ old('level_4_grade') }}">
            @if ($errors->has('level_4_grade'))
            <span class="help-block">
              <strong>{{ $errors->first('level_4_grade') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('level_5_grade') ? ' has-error' : '' }}">
          <label for="level_5_grade" class="col-sm-3 control-label">معدل پایه پنجم</label>
          <div class="col-sm-6">
            <input type="text" name="level_5_grade" id="level_5_grade" class="form-control" value="{{ old('level_5_grade') }}">
            @if ($errors->has('level_5_grade'))
            <span class="help-block">
              <strong>{{ $errors->first('level_5_grade') }}</strong>
            </span>
            @endif
          </div>
        </div>
        <div class="form-group{{ $errors->has('current_school') ? ' has-error' : '' }}">
          <label for="current_school" class="col-sm-3 control-label">نام شهر و مدرسه محل تحصیل فعلی</label>
          <div class="col-sm-6">
            <input type="text" name="current_school" id="current_school" class="form-control" value="{{ old('current_school') }}" placeholder="مانند قم - مدرسه قائم (عج)">
            @if ($errors->has('current_school'))
            <span class="help-block">
              <strong>{{ $errors->first('current_school') }}</strong>
            </span>
            @endif
          </div>
        </div>
      </div>
      <div class="panel-footer application-form">
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-btn fa-save "></i> ذخیره
        </button>
      </div>
    </div>
  </form>
  <div class="clearfix"></div>
</div>
@endsection
