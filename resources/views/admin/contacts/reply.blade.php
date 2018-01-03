@extends('layouts.dashboard')

@section('title', 'پاسخ')

@section('content')
<div class="container">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">پیغام ها به قائم<sup>(عج)</sup></h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/admin">مدیریت سایت</a></li>
      <li><a href="/contacts">پیغام ها</a></li>
      <li>پاسخ</li>
    </ol>
    <div class="clearfix"></div>
  </div>

  @if (count($errors) > 0)
  <div class="alert alert-danger">
    خطا! ثبت نام قطعی شده قابل ذخیره نیست. لطفا مشکلات اشاره شده در فرم را رفع و سپس اقدام به ذخیره آن نمایید.
  </div>
  @endif
  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
  @if(Session::has('alert-' . $msg))
  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
  @endif
  @endforeach
  <form action="{{ URL::to('contacts/send') }}" method="POST" class="form-horizontal top-buffer" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $contact->id }}">
    <div class="panel panel-default">
      <!-- message -->
      <div class="panel-heading">
        <small>
          <div class="row">
            <div class="col-sm-2 col-sm-offset-1"><label class="control-label pull-left">آدرس ایمیل:</label></div>
            <div class="col-sm-8">{{ $contact->email }}</div>
          </div>
          <div class="row">
            <div class="col-sm-2 col-sm-offset-1"><label class="control-label pull-left">نام و نام خانوادگی:</label></div>
            <div class="col-sm-8">{{ $contact->name }}</div>
          </div>
          <div class="row">
            <div class="col-sm-2 col-sm-offset-1"><label class="control-label pull-left">عنوان:</label></div>
            <div class="col-sm-8">{{ $contact->subject }}</div>
          </div>
          <div class="row">
            <div class="col-sm-2 col-sm-offset-1"><label class="control-label pull-left">متن خود را وارد کنید:</label></div>
            <div class="col-sm-8">{{ $contact->message }}</div>
          </div>
        </small>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-sm-4 col-sm-offset-2 control-label">آدرس ایمیل</label>
              <div class="col-sm-6">
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-sm-4 control-label">نام و نام خانوادگی</label>
              <div class="col-sm-6">
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
            <label for="subject" class="col-sm-2 col-sm-offset-1 control-label">عنوان</label>
            <div class="col-sm-8">
              <input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject') }}">
              @if ($errors->has('subject'))
              <span class="help-block">
                <strong>{{ $errors->first('subject') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
            <label for="message" class="col-sm-2 col-sm-offset-1 control-label">متن خود را وارد کنید</label>
            <div class="col-sm-8">
              <textarea name="message" rows="4" class="col-sm-12">{{ old('message') }}</textarea>
              @if ($errors->has('message'))
              <span class="help-block">
                <strong>{{ $errors->first('message') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer application-form">
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-btn fa-reply "></i> ارسال
        </button>
      </div>
    </div>
  </form>
</div>
@endsection
