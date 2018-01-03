@extends('layouts.dashboard')

@section('title', 'صفحه من')

@section('content')
<div class="container applicant-dashboard">
  <div class="page-header page-heading">
    <h1 class="pull-right">صفحه اصلی</h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li>صفحه اصلی</li>
    </ol>
    <div class="clearfix"></div>
  </div>
  <div class="page-advice">
    <strong>داوطلب گرامی:</strong> چنانچه ظرف مدت 48 ساعت نسبت به تکمیل ثبت نام اقدام نفرمائید، سامانه به صورت خودکار کاربری شما را حذف نموده و بایستی برای ثبت نام، از ابتدا مراحل را طی نمایید.
  </div>
  <div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12 bottom-buffer-2">
      <div class="panel panel-default">
        <div class="panel-heading"><small>زمانبندی پذیرش</small></div>
        <table class="table">
          @foreach ($schedules as $schedule)
          <tr>
            <td><small>{{ $schedule->type->label }}</small></td>
            <td><small>{{ $schedule->getDeadline() }}</small></td>
          </tr>
          @endforeach
        </table>
      </div>
      <div class="panel panel-info">
        <div class="panel-heading"><i class="fa fa-file-pdf-o"></i> دانلود <a href="/uploads/files/{{ $options->get('instructions')->value }}"><strong>دفترچه راهنما</strong></a></div>
      </div>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading"><strong>ثبت نام</strong></div>
        <table class="table">

          <tr><!-- start: upload picture -->
            <td class="col-md-1">
              @if ($registration_open)
              <a href="{{ url('/user/picture') }}"><i class="fa fa-camera fa-3x"></i></a>
              @else
              <i class="fa fa-camera fa-3x"></i>
              @endif
            </td>
            <td class="col-md-10">
              <h3>
                @if ($registration_open)
                <a href="{{ url('/user/picture') }}">آپلود عکس جدید</a>
                @else
                آپلود عکس جدید
                @endif
              </h3>
            </td>
            <td class="col-md-1">
              @if ($user->picture != "00000000.png")
              <i class="fa fa-check-circle fa-3x text-success text-success"></i>
              @endif
            </td>
          </tr><!-- end: upload picture -->

          <tr><!-- start: application form -->
            <td class="col-md-1">
              @if ($registration_open AND $user->picture != "00000000.png")
              <a href="{{ url('/application/update') }}"><i class="fa fa-edit fa-3x"></i></a>
              @else
              <i class="fa fa-edit fa-3x"></i>
              @endif
            </td>
            <td class="col-md-10">
              <h3>
                @if ($registration_open AND $user->picture != "00000000.png")
                <a href="{{ url('/application/update') }}">تکمیل یا ویرایش فرم ثبت نام</a>
                @else
                تکمیل یا ویرایش فرم ثبت نام
                @endif
              </h3>
            </td>
            <td class="col-md-1">
              @if ( !is_null($user->application) AND $user->application->form_complete == 1 )
              <i class="fa fa-check-circle fa-3x text-success"></i>
              @endif
            </td>
          </tr><!-- end: application form -->

          <tr><!-- start: school selection -->
            <td class="col-md-1">
              @if ( $registration_open AND !is_null($user->application) AND $user->application->form_complete == 1 )
              <a href="{{ url('/user/school') }}"><i class="fa fa-university fa-3x"></i></a>
              @else
              <i class="fa fa-university fa-3x"></i>
              @endif
            </td>
            <td class="col-md-10">
              <h3>
                @if ( $registration_open AND !is_null($user->application) AND $user->application->form_complete == 1 )
                <a href="{{ url('/user/school') }}">انتخاب مرکز/مدرسه فقهی</a>
                @else
                انتخاب مرکز/مدرسه فقهی
                @endif
              </h3>
            </td>
            <td class="col-md-1">
              @if ( !is_null($user->application) AND $user->application->form_complete == 1 AND $user->getSchoolsCount($user->id) >= 3 )
              <i class="fa fa-check-circle fa-3x text-success"></i>
              @endif
            </td>
          </tr><!-- end: school selection -->

          <tr><!-- start: print card -->
            <td class="col-md-1">
              @if ($user->application->form_complete == 1 AND $print_card_open == 1)
              <a href="{{ url('/application/card') }}"><i class="fa fa-image fa-3x"></i></a>
              @else
              <i class="fa fa-image fa-3x"></i>
              @endif
            </td>
            <td class="col-md-10">
              <h3>
                @if ($user->application->form_complete == 1 AND $print_card_open == 1)
                <a href="{{ url('/application/card') }}">چاپ کارت ورود به جلسه آزمون</a>
                @else
                چاپ کارت ورود به جلسه آزمون
                @endif
              </h3>
            </td>
            <td class="col-md-1">
              @if ($user->application->form_complete == 1 AND $user->hasSeat($user->id))
              <a href="{{ url('/application/card') }}">
                <i class="fa fa-check-circle fa-3x text-success"></i>
              </a>
              @endif
            </td>
          </tr><!-- end: print card -->

          <tr><!-- start: get results -->
            <td class="col-md-1">
              @if ($results_open == 1)
              <a href="{{ url('/user/results') }}"><i class="fa fa-trophy fa-3x"></i></a>
              @else
              <i class="fa fa-trophy fa-3x"></i>
              @endif
            </td>
            <td class="col-md-10">
              <h3>
                @if ($results_open == 1)
                <a href="{{ url('/user/results') }}"> نمرات آزمون</a>
                @else
                چاپ کارت ورود به جلسه آزمون
                @endif
              </h3>
            </td>
            <td class="col-md-1">
              @if ($user->viewedResults($user->id))
              <a href="{{ url('/user/results') }}">
                <i class="fa fa-check-circle fa-3x text-success"></i>
              </a>
              @endif
            </td>
          </tr><!-- end: get results -->

        </table>
      </div>
    </div>
  </div>
</div>

@endsection
