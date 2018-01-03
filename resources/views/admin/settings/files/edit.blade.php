@extends('layouts.dashboard')

@section('title', 'ویرایش فایل ها')

@section('content')
<div class="container">
    <div class="page-header page-heading">
        <h1 class="pull-right dashboard">فایل ها</h1>
        <ol class="breadcrumb pull-left where-am-i">
            <li><a href="/admin">مدیریت سایت</a></li>
            <li><a href="/admin/settings">تنظیمات</a></li>
            <li><a href="/admin/settings/files">فایل ها</a></li>
            <li>ویرایش</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">ویرایش {{ $option->label }}</div>
                <div class="panel-body">
                    <a href="{{ url()->previous() }}" title="صفحه قبلی"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-right" aria-hidden="true"></i> صفحه قبلی</button></a>

                    {!! Form::model($option, [
                        'method' => 'PATCH',
                        'url' => ['/admin/settings/files', $option->id],
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include ('admin.settings.files.form', ['submitButtonText' => 'ذخیره'])

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
