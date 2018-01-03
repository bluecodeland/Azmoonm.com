@extends('layouts.dashboard')

@section('title', 'ثبت نام قطعی')

@section('content')
<div class="container comments">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">ثبت نام قطعی</h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/admin">مدیریت سایت</a></li>
      <li>ثبت نام قطعی</li>
    </ol>
    <div class="clearfix"></div>
  </div>

  <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>عکس</th>
        <th>نام</th>
        <th>نام خانوادگی</th>
        <th>کد ملی</th>
        <th>تاریخ تولد</th>
        <th>تلفن ثابت</th>
        <th>تلفن همراه</th>
        <th>پست الکترونیکی</th>
        <th>صندلی</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($applications as $application)
      <tr>
        <td><img src="/uploads/photo/{{ $application->user->picture }}" class="admin" style="width: 75px; height: 113px" /></td>
        <td>{{ $application->user->firstname }}</td>
        <td>{{ $application->user->lastname }}</td>
        <td>{{ $application->national_code }}</td>
        <td>{{ $application->birth_date }}</td>
        <td>{{ $application->landline }}</td>
        <td>{{ $application->user->mobile }}</td>
        <td style="text-align:left; direction: ltr;">{{ $application->user->email }}</td>
        <td>{{ $application->user->hasSeat( $application->user->id ) }}</td>
        <td>
          <form method="POST" action="{{ url('/admin/applications/view') }}" class="table-form">
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{ $application->user->id }}">
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-btn fa-search"></i>
            </button>
          </form>
          @if(Auth::user()->hasRole('superuser'))
          <form method="POST" action="{{ url('/user/delete') }}" class="table-form"> 
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{ $application->user->id }}">
            <button type="submit" class="btn btn-danger" onclick="return ConfirmDelete( '{{ $application->user->firstname}} {{ $application->user->lastname}}' );">
              <i class="fa fa-btn fa-trash"></i>
            </button>
          </form>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

</div>
@endsection
