@extends('layouts.dashboard')

@section('title', 'نمرات آزمون')

@section('content')
<div class="container">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">نمرات آزمون - {{ $user->firstname }} {{ $user->lastname }}</h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/dashboard">صفحه اصلی</a></li>
      <li>نمرات آزمون</li>
    </ol>
    <div class="clearfix"></div>
  </div>

  <div class="page-advice">
    <strong>طلبه گرامی:</strong> ...
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <table class="table table-borderless">
          <thead>
            <tr>
              <th>نمره هوش</th>
              <th>نمره فقه</th>
              <th>نمره اصول</th>
              <th>نمره تشریحی</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $aptitude_results }}</td>
              <td>{{ $fiqh_results }}</td>
              <td>{{ $usul_results }}</td>
              <td>{{ $essay_results }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
