@extends('layouts.dashboard')

@section('title', 'ویرایش مرکز/مدرسه')

@section('content')
<div class="container">
    <div class="page-header page-heading">
        <h1 class="pull-right dashboard">ویرایش مرکز/مدرسه</h1>
        <ol class="breadcrumb pull-left where-am-i">
            <li><a href="/admin">مدیریت سایت</a></li>
            <li><a href="/admin/settings">تنظیمات</a></li>
            <li><a href="/admin/settings/schools">مرکز/مدرسه</a></li>
            <li>ویرایش</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! Form::model($school, [
            'method' => 'PATCH',
            'url' => ['/admin/settings/schools', $school->id],
            'class' => 'form-horizontal',
            'files' => true
            ]) !!}

            <div class="panel panel-default">
                <div class="panel-body panel-extra">
                    <h2>مرکز/مدرسه</h2>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('name', 'اسم', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('name', $school->name, ['class' => 'form-control']) !!}
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('label') ? 'has-error' : ''}}">
                        {!! Form::label('label', 'اسم کوتاه', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('label', $school->label, ['class' => 'form-control']) !!}
                            {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <h2>مدیر سایت</h2>
                    <div class="form-group {{ $errors->has('firstname') ? 'has-error' : ''}}">
                        {!! Form::label('firstname', 'نام', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('firstname', $school->admin->firstname, ['class' => 'form-control']) !!}
                            {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('lastname') ? 'has-error' : ''}}">
                        {!! Form::label('lastname', 'نام خانوادگی', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('lastname', $school->admin->lastname, ['class' => 'form-control']) !!}
                            {!! $errors->first('lastname', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('mobile') ? 'has-error' : ''}}">
                        {!! Form::label('mobile', 'تلفن همراه', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('mobile', $school->admin->mobile, ['class' => 'form-control']) !!}
                            {!! $errors->first('mobile', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        {!! Form::label('email', 'پست الکترونیکی', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::text('email', $school->admin->email, ['class' => 'form-control']) !!}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="{{ url()->previous() }}" title="صفحه قبلی"><button class="btn btn-warning"><i class="fa fa-arrow-right" aria-hidden="true"></i> صفحه قبلی</button></a>
                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'ذخیره', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection
