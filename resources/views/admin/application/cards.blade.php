@extends('layouts.exam')

@section('title', 'کارت ورود')

@section('content')
  <?php $i=0 ?>
  @foreach ($applications as $application)
    <?php $i++ ?>
    <?php
      $seat_number = '';
      if(isset($application->user->seat->seat_number)){
        $seat_number = $application->user->seat->seat_number;
      }
    ?>
    <div class="print-all-cards-<?php echo ($i % 2 != 0) ? 'first' : 'second' ?>">
      <div class="well container-fixed exam-card">
        <div class="row">
          <div class="col-xs-3">
            <img src="/uploads/images/{{ $options->get('logo_bw')->value }}" alt="logo" alt="logo" class="img-responsive logo" >
          </div>
          <div class="col-xs-6">
            <div class="row text-center small title"><strong>کارت ورود به جلسه آزمون</strong></div>
            <!--<div class="row text-center small">{{ $options->get('site_title')->value }}</div>-->
            <div class="row text-center small">پذیرش مشترک جمعی از مدارس و مراکز فقهی</div>  
          </div>
          <div class="col-xs-3"><img src="/uploads/photo/{{ $application->user->picture }}" class="img-responsive" /></div>
        </div>
        <div class="row details">
          <div class="col-xs-6 small">شماره صندلی: <strong>{{ $seat_number }}</strong></div>
          <div class="col-xs-6 small">شماره داوطلبی: <strong>{{ $application->user->application->application_reference }}</strong></div>
          <div class="col-xs-6 small">نام: <strong>{{ $application->user->firstname }}</strong></div>
          <div class="col-xs-6 small">نام خانوادگی: <strong>{{ $application->user->lastname }}</strong></div>
          <div class="col-xs-6 small">نام پدر: <strong>{{ $application->user->application->fathers_name }}</strong></div>
          <div class="col-xs-6 small">شماره شناسنامه: <strong>{{ $application->user->application->id_number }}</strong></div>
          <div class="col-xs-6 small">ساعت حضور داوطلب: <strong>{{ $options->get('exam_arrive')->value }}</strong></div>
          <div class="col-xs-6 small">کد ملی: <strong>{{ $application->user->application->national_code }}</strong></div>
          <div class="col-xs-6 small">ساعت شروع آزمون: <strong>{{ $options->get('exam_start')->value }}</strong></div>
          <div class="col-xs-6 small">تاریخ آزمون: <strong>{{ $options->get('exam_date')->value }}</strong></div>
          <!--<div class="col-xs-12 small card-note">{{ $options->get('card_notes')->value }}</div>-->
          <div class="col-xs-12 small card-note">
             <p>
              1. نیم ساعت قبل از شروع آزمون در محل برگزاری حاضر باشید.  <br />
              2. همراه داشتن کارت ورود به جلسه الزامیست.
            </p>  
          </div>
          <div class="col-xs-12 small card-address"><i class="fa fa-home fa-lg"></i> نشانی: <strong>{{ $options->get('exam_address')->value }}</strong></div>
        </div>
      </div>
    </div>
    <?php if($i % 2 == 0){ ?>
    <div style="page-break-after:always;"></div>
    <?php } ?>
  @endforeach
  <?php echo $i ?>

@endsection
