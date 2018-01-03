@extends('layouts.dashboard')

@section('title', 'تغیر رمز عبور')

@section('content')
<div class="container">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">تغیر رمز عبور</h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/dashboard">صفحه اصلی</a></li>
      <li>تغیر رمز عبور</li>
    </ol>
    <div class="clearfix"></div>
  </div>
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">تغیر رمز عبور</div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/save_password') }}">
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">رمز عبور</label>

              <div class="col-md-6">
                <input type="password" class="form-control" name="password">

                @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">تاییدیه ی رمز عبور</label>

              <div class="col-md-6">
                <input type="password" class="form-control" name="password_confirmation">

                @if ($errors->has('password_confirmation'))
                <span class="help-block">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  <i class="fa fa-btn fa-user"></i> تغییر رمز
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
