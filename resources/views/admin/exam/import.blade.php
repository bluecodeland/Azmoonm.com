@extends('layouts.dashboard')

@section('title', 'واردات نتایج آزمون')

@section('content')
<div class="container">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">واردات نتایج آزمون</h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/admin">مدیریت سایت</a></li>
      <li><a href="/admin/exam">نتایج آزمون</a></li>
      <li>واردات نتایج آزمون</li>
    </ol>
    <div class="clearfix"></div>
  </div>

  @if (count($errors) > 0)
  <div class="alert alert-danger">
    خطا! نتایج آزمون وارد نشده.
  </div>
  @endif
  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
  @endforeach

  <form id="form-photo" action="{{ URL::to('admin/exam/upload') }}" method="POST" class="" enctype="multipart/form-data">
    {{ csrf_field() }}

    <!-- file -->
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-sm-9">
          <h2>فایل واردات</h2>
          <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
            <label for="tasks" class="col-sm-4 control-label">آپلود فایل</label>
            <div class="col-sm-8 photo">
              <input type="file" name="file" id="file" class="form-control filestyle" data-classButton="btn btn-primary" data-input="true"  data-iconName="fa fa-btn fa-folder" data-buttonText="انتخاب فایل" data-buttonName="btn-primary">
               <input type="submit" name="filesub" id="filesub" class="btn btn-primary" data-classButton="btn btn-primary" data-input="true"  data-iconName="fa fa-btn fa-folder" data-buttonText="ارسال" data-buttonName="btn-primary" value="ذخیره فایل">
              @if ($errors->has('file'))
              <span class="help-block">
                <strong>{{ $errors->first('file') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  <div class="clearfix"></div>
</div>

@endsection
