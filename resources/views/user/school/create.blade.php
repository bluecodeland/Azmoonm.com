@extends('layouts.dashboard')

@section('title', 'انتخاب مرکز/مدرسه')

@section('content')
<div class="container">
    <div class="page-header page-heading">
        <h1 class="pull-right dashboard">انتخاب جدید</h1>
        <ol class="breadcrumb pull-left where-am-i">
            <li><a href="/dashboard">صفحه اصلی</a></li>
            <li><a href="/user/school">انتخاب مرکز/مدرسه</a></li>
            <li>انتخاب جدید</li>
        </ol>
        <div class="clearfix"></div>
    </div>

    <div class="page-advice">
        <strong>طلبه گرامی:</strong> شما میتوانید حداقل 3 و حداکثر تمام مدارس را انتخاب نمایید بر اساس اولویت. برای این کار منوی مدارس را باز کنید و اولویت اول خود را انتخاب و بر روی دکمه ذخیره کلیک کنید. برای انتخاب اولویت های دیگر خود نیز همین روند را انجام دهید.
    </div>

    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => '/user/school/store', 'class' => 'form-horizontal', 'files' => true]) !!}
            <div class="panel panel-default">
                <div class="panel-body single-section-form">
                    <div class="form-group {{ $errors->has('picture') ? 'has-error' : ''}}">
                        {!! Form::label('school', 'مرکز/مدرسه فقهی', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!! Form::select('school_id', $schools, null, ['class' => 'form-control']) !!}
                            {!! $errors->first('school', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <a href="{{ url('/user/school') }}" title="صفحه قبلی" class="btn btn-warning"><i class="fa fa-arrow-right" aria-hidden="true"></i> صفحه قبلی</a>
                    {{ Form::button('<i class="fa fa-save"></i> ذخیره', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}
              </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
