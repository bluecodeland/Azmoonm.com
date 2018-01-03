@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Course</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/academic/courses', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('academic.courses.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection