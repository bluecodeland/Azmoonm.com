@extends('layouts.dashboard')

@section('title', 'زمانبندی پذیرش')

@section('content')
<div class="container comments">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">زمانبندی پذیرش</h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/admin">مدیریت سایت</a></li>
      <li><a href="/admin/settings">تنظیمات</a></li>
      <li>زمانبندی پذیرش</li>
    </ol>
    <div class="clearfix"></div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading"><strong>زمانبندی پذیرش</strong></div>
    <table class="table">
      @foreach ($schedules as $schedule)
      <tr>
        <td>{{ $schedule->type->label }}</td>
        <td>{{ $schedule->getDeadline2() }}</td>
        <td>
          <a href="/admin/settings/admissions/{{ $schedule->id }}" class="pull-left">
            <button type="button" class="btn btn-primary">
              <i class="fa fa-btn fa-edit "></i> ویرایش
            </button>
          </a>
        </td>
      </tr>
      @endforeach
    </table>
  </div>

</div>
@endsection
