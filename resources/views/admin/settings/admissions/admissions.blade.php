@extends('layouts.dashboard')

@section('title', 'ویرایش زمانبندی پذیرش')

@section('content')
<div class="container">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">ویرایش زمانبندی پذیرش</h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/admin">مدیریت سایت</a></li>
      <li><a href="/admin/settings">تنظیمات</a></li>
      <li><a href="/admin/settings/admissions">زمانبندی پذیرش</a></li>
      <li>ویرایش</li>
    </ol>
    <div class="clearfix"></div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading"><strong>ویرایش زمانبندی پذیرش</strong></div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/settings/admissions/update') }}/{{ $schedule->id }}">
            {!! csrf_field() !!}
            <div class="form-group{{ $errors->has('$schedule->type->name') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label" for="deadline">{{ $schedule->type->label }}</label>
              <div class="col-md-6">
                <div class="input-group">
                  <input type="text" class="form-control" id="deadline" name="deadline" placeholder="تاریخ به همراه زمان" value="{{ $schedule->getDeadlineDateTime() }}" />
                  <div class="input-group-addon" data-mddatetimepicker="true" data-targetselector="#deadline" data-trigger="click" data-enabletimepicker="true">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </div>
                </div>
                @if ($errors->has('$schedule->deadline'))
                <span class="help-block">
                  <strong>{{ $errors->first('$schedule->deadline') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-btn fa-save"></i> ذخیره
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
