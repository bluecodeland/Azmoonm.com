@extends('layouts.dashboard')

@section('title', 'آپلود عکس')

@section('content')
<div class="container picture">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">آپلود عکس</h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/dashboard">صفحه اصلی</a></li>
      <li>آپلود عکس</li>
    </ol>
    <div class="clearfix"></div>
  </div>
  
  <div class="page-advice">
    <strong>طلبه گرامی:</strong> لطفا نکات زیر را مطالعه و سپس اقدام به بارگذاری عکس نمایید. پس از انتخاب فایل بر روی دکمه "ادامه ثبت نام" کلیک کنید.
  </div>
  <div class="page-advice">
    <strong>شرایط عکس برای ثبت نام:</strong> از آنجایی که تصویر شما یک بخش مهم از ثبت نام شماست، لذا در انتخاب عکس خود دقت لازم را انجام دهید. لطفا توجه داشته باشید که اگر عکس شما دارای شرایط لازم که در ذیل آمده است نباشد شما باید فرآیند بارگذاری عکس جدید را انجام دهید.
    <ul>
      <li><strong>ابعاد:</strong> عکس شما باید در ابعاد 3 در 4 باشد.</li>
      <li><strong>رنگ:</strong> عکس شما باید رنگی باشد.</li>
      <li><strong>زمینه عکس:</strong> عکس شما باید دارای زمینه سفید باشد.</li>
      <li><strong>فرمت فایل عکس:</strong> فایل عکس شما باید با فرمت JPG باشد.</li>
      <li><strong>حجم فایل:</strong> حد اکثر حجم فایل عکس شما نباید بیشتر از 1 مگابایت باشد.</li>
      <li><strong>جهت عکس:</strong> چرخش عکس باید به گونه ای باشد که صورت در بالا باشد.</li>
      <li><strong>مدل عکس:</strong> عکس باید شامل سر و صورت و شانه ها باشد. از گرفتن عکس های ایستاده و غیره با موبایل خودداری کنید.</li>
    </ul>
  </div>
  <div class="clearfix bottom-buffer"></div>

  <form id="form-photo" action="{{ URL::to('user/picture') }}" method="POST" class="" enctype="multipart/form-data">
    {{ csrf_field() }}
    <!-- upload picture -->
    <div class="panel panel-default picture-upload">
      <div class="panel-body">
        <div class="col-sm-9">
           <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
            <label for="tasks" class="col-sm-4 control-label"> </label>
            <div class="col-sm-8 col-offset-4 photo">
              <input type="file" name="picture" id="picture" class="form-control filestyle" data-classButton="btn btn-primary" data-input="true"  data-iconName="fa fa-btn fa-folder" data-buttonText="انتخاب فایل" data-buttonName="btn-primary">
              @if ($errors->has('picture'))
              <span class="help-block">
                <strong>{{ $errors->first('picture') }}</strong>
              </span>
              @endif
              <a href="{{ url()->previous() }}">
                <button type="button" class="btn btn-warning"><i class="fa fa-arrow-right" aria-hidden="true"></i> صفحه قبلی</button>
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-save "></i> ادامه ثبت نام
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>


  <div class="clearfix"></div>
</div>
@endsection
