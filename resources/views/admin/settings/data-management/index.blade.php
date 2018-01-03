@extends('layouts.dashboard')

@section('title', 'مدیریت داده')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">مدیریت داده</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/admin/settings/data-management/', 'class' => 'form-horizontal']) !!}        

                        <div class="form-group {{ $errors->has('delete_incomplete_applications') ? 'has-error' : ''}}">
                            {!! Form::label('delete_incomplete_applications', 'حذف برنامه های کاربردی ناقص?', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::checkbox('delete_incomplete_applications', 1, null, ['class' => 'form-control-checkbox']) !!}
                                {!! $errors->first('delete_incomplete_applications', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('send_deletion_sms') ? 'has-error' : ''}}">
                            {!! Form::label('send_deletion_sms', 'ارسال اس ام اس حذف؟', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::checkbox('send_deletion_sms', 1, null, ['class' => 'form-control-checkbox']) !!}
                                {!! $errors->first('send_deletion_sms', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('send_deletion_email') ? 'has-error' : ''}}">
                            {!! Form::label('send_deletion_email', 'ارسال ایمیل حذف؟', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::checkbox('send_deletion_email', 1, null, ['class' => 'form-control-checkbox']) !!}
                                {!! $errors->first('send_deletion_email', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('delete_all_seats') ? 'has-error' : ''}}">
                            {!! Form::label('delete_all_seats', 'حذف همه صندلی؟', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::checkbox('delete_all_seats', 1, null, ['class' => 'form-control-checkbox']) !!}
                                {!! $errors->first('delete_all_seats', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('add_new_seats') ? 'has-error' : ''}}">
                            {!! Form::label('add_new_seats', 'اضافه صندلی های جدید؟', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::checkbox('add_new_seats', 1, null, ['class' => 'form-control-checkbox']) !!}
                                {!! $errors->first('add_new_seats', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'اجرا کن', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection