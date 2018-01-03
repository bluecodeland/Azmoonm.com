@extends('layouts.dashboard')

@section('title', 'مدیریت مدرسه')

@section('content')
<div class="container">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">مدیریت {{ $school->name }} </h1>
    <div class="clearfix"></div>
  </div>
</div>

<div class="container">
  <div class="col-sm-4 col-md-3 sidebar">
    <div class="mini-submenu">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </div>
    <div class="list-group">
      <span href="#" class="list-group-item active">
        <i class="fa fa-bar-chart"></i> مدیریت {{ $school->label }}
      </span>
      <a href="/schooladmin/export" class="list-group-item">
        <i class="fa fa-download"></i> گزارش ها <span class="badge">{{ $applications_count }}
      </a>
    </div>
  </div>

  <div class="col-sm-8 col-md-9">
    <div class="row graph-row">
      <div class="col-md-12">
        {!! $bar_chart->render() !!}
      </div>
    </div>
  </div>

</div>


@endsection
