@extends('layouts.dashboard')

@section('title', 'کارت ورود به جلسه آزمون')

@section('content')
<div class="container">
  <div class="panel panel-default panel-heading-card">
    <div class="panel-heading">
      <a href="#" onClick="window.print();return false">
        <button type="button" class="btn btn-danger">
          <i class="fa fa-btn fa-print "></i> چاپ فرم
        </button>
      </a>
      <a href="{{ url('/dashboard') }}">
        <button type="button" class="btn btn-primary">
          <i class="fa fa-btn fa-dashboard "></i> صفحه اصلی
        </button>
      </a>
    </div>
    <div class="panel-body">
      <div class="well container-fixed exam-card">
        <div class="row">
          <div class="col-xs-3">
            <img src="/uploads/images/{{ $options->get('logo_bw')->value }}" alt="logo" alt="logo" class="img-responsive logo" >
          </div>
          <div class="col-xs-6">
            <div class="row text-center small title"><strong>کارت ورود به جلسه آزمون</strong></div>
            <div class="row text-center small">{{ $options->get('site_title')->value }}</div>
          </div>
          <div class="col-xs-3"><img src="/uploads/photo/{{ $user->picture }}" class="img-responsive" /></div>
        </div>
        <div class="row details">
          <div class="col-xs-6 small">شماره صندلی: <strong>{{ $seat_number }}</strong></div>
          <div class="col-xs-6 small">شماره داوطلبی: <strong>{{ $user->application->application_reference }}</strong></div>
          <div class="col-xs-6 small">نام: <strong>{{ $user->firstname }}</strong></div>
          <div class="col-xs-6 small">نام خانوادگی: <strong>{{ $user->lastname }}</strong></div>
          <div class="col-xs-6 small">نام پدر: <strong>{{ $user->application->fathers_name }}</strong></div>
          <div class="col-xs-6 small">شماره شناسنامه: <strong>{{ $user->application->id_number }}</strong></div>
          <div class="col-xs-6 small">ساعت حضور داوطلب: <strong>{{ $options->get('exam_arrive')->value }}</strong></div>
          <div class="col-xs-6 small">کد ملی: <strong>{{ $user->application->national_code }}</strong></div>
          <div class="col-xs-6 small">ساعت شروع آزمون: <strong>{{ $options->get('exam_start')->value }}</strong></div>
          <div class="col-xs-6 small">تاریخ آزمون: <strong>{{ $options->get('exam_date')->value }}</strong></div>
          <div class="col-xs-12 small card-note">{{ $options->get('card_notes')->value }}</div>
          <div class="col-xs-12 small card-address"><i class="fa fa-home fa-lg"></i> نشانی: <strong>{{ $options->get('exam_address')->value }}</strong></div>       
        </div>
      </div>
    </div>
  </div> 
</div>
@endsection 
