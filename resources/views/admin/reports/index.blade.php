@extends('layouts.dashboard')

@section('title', 'گزارش ها')

@section('content')
<div class="container comments">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">گزارش ها</h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/admin">مدیریت سایت</a></li>
      <li>گزارش ها</li>
    </ol>
    <div class="clearfix"></div>
  </div>

  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-2">
          <a href="/admin/reports/export/all">
            <button type="button" class="btn btn-primary">
              <i class="fa fa-btn fa-download "></i> دانلود
            </button>
          </a>
        </div>
        <div class="col-md-10">دانلود فهرست ثبت نام در آزمون ورودی.</div>
      </div>
    </div>
  </div>
</div>
@endsection
