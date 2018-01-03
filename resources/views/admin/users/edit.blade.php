@extends('layouts.dashboard')

@section('title', 'ویرایش کاربران')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">ویرایش کاربر {{ $user->firstname }} {{ $user->lastname }}</div>
                    <div class="panel-body">

                        {!! Form::model($user, [
                            'method' => 'PATCH',
                            'url' => ['/admin/users', $user->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        <div class="form-group {{ $errors->has('firstname') ? 'has-error' : ''}}">
                            {!! Form::label('firstname', 'نام', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('firstname', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('lastname') ? 'has-error' : ''}}">
                            {!! Form::label('lastname', 'نام خانوادگی', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('lastname', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('mobile') ? 'has-error' : ''}}">
                            {!! Form::label('mobile', 'تلفن همراه', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('mobile', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                            {!! Form::label('email', 'پست الکترونیکی', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('send_password') ? 'has-error' : ''}}">
                            {!! Form::label('send_password', 'ارسال کلمه عبور جدید؟', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::checkbox('send_password', 1, null, ['class' => 'form-control-checkbox']) !!}
                                {!! $errors->first('send_password', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'ذخیره', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection