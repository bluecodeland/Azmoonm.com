@extends('layouts.dashboard')

@section('title', 'پیغام ها')

@section('content')
<div class="container comments">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">پیغام ها به قائم<sup>(عج)</sup></h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/admin">مدیریت سایت</a></li>
      <li>پیغام ها</li>
    </ol>
    <div class="clearfix"></div>
  </div>

  @foreach ($contacts as $contact)
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-2">{{ $contact->email }}</div>
        <div class="col-md-2">{{ $contact->name }}</div>
        <div class="col-md-2">{{ $contact->subject }}</div>
        <div class="col-md-4">{{ $contact->message }}</div>
        <div class="col-md-2">{{ $contact->created_at }}</div>
        <!--
        <div class="col-md-1">
          <form method="POST" action="{{ url('/contacts/reply') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{ $contact->id }}">
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-btn fa-reply"></i>
            </button>
          </form>
        </div>
        -->
      </div>
    </div>
  </div>
  @endforeach

</div>

@endsection
