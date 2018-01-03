@extends('layouts.dashboard')

@section('title', 'مدیریت سایت')

@section('content')

<div class="container">
  <div class="col-sm-4 col-md-3 sidebar">
    <div class="mini-submenu">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </div>
    <div class="list-group">
      <span href="#" class="list-group-item active">
        <i class="fa fa-bar-chart"></i> مدیریت سایت
      </span>
      <a href="/admin/applications/all" class="list-group-item">
        <i class="fa fa-file-text"></i> تمام ثبت نام ها <span class="badge">{{ $applications_count }}</span>
      </a>
      <a href="/admin/applications/unprinted_cards" class="list-group-item">
        <i class="fa fa-id-card"></i> کارت
      </a>
      <a href="/admin/reports" class="list-group-item">
        <i class="fa fa-download"></i> گزارش ها
      </a>
      @if(Auth::user()->hasRole('superuser'))
      <a href="/admin/users" class="list-group-item">
        <i class="fa fa-users"></i> کاربران
      </a>
      <a href="/admin/settings" class="list-group-item">
        <i class="fa fa-cog"></i> تنظیمات
      </a>
      @endif
    </div>
  </div>

  <div class="col-sm-8 col-md-9">
    <div class="row graph-row">
      <div class="col-md-12">
        {!! $bar_chart->render() !!}
      </div>
    </div>
    <div class="row graph-row">
      <div class="col-md-12">
        {!! $line_graph->render() !!}
      </div>
    </div>
  </div>

</div>
@endsection
