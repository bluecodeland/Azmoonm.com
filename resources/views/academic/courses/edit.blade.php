@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Course {{ $course->id }}</div>
                    <div class="panel-body">
                    
                        {!! Form::model($course, [
                            'method' => 'PATCH',
                            'url' => ['/academic/courses', $course->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('academic.courses.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection