@extends('layouts.dashboard')

@section('title', 'کاربران')

@section('content')
<div class="container comments">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">کاربران 
      <a href="{{ url('/admin/users/create') }}">
        <button type="button" class="btn btn-primary">
          <i class="fa fa-btn fa-plus "></i> ایجاد جدید
        </button>
      </a>
    </h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/admin">مدیریت سایت</a></li>
      <li>کاربران</li>
    </ol>
    <div class="clearfix"></div>
  </div>

  <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>نام</th>
        <th>نام خانوادگی</th>
        <th>تلفن همراه</th>
        <th>پست الکترونیکی</th>
        <th>وظیفه</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->firstname }}</td>
        <td>{{ $user->lastname }}</td>
        <td>{{ $user->mobile }}</td>
        <td style="text-align:left; direction: ltr;">{{ getArabicNumerals($user->email) }}</td>
        <td>
          @foreach($user->roles as $role)
          {{ $role->label }}
          @endforeach
        </td>
        <td>
          <a href="{{ url('/admin/users/' . $user->id) }}" class="btn btn-success btn-xs" title="View User"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
          @if(!$user->hasRole('schooladmin'))
            <a href="{{ url('/admin/users/' . $user->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
            @if(Auth::user()->hasRole('superuser'))
              {!! Form::open([
              'method'=>'DELETE',
              'url' => ['/admin/users', $user->id],
              'style' => 'display:inline'
              ]) !!}
              {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete User" />', array(
              'type' => 'submit',
              'class' => 'btn btn-danger btn-xs',
              'title' => 'حذف کاربر',
              'onclick'=>'return confirm("تایید حذف؟")'
              )) !!}
              {!! Form::close() !!}
            @endif
          @endif
          </td>
      </tr>
      @endforeach
    </tbody>
  </table>

</div>
@endsection