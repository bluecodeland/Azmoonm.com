@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Subject {{ $subject->id }}</div>
                    <div class="panel-body">

                        {!! Form::model($subject, [
                            'method' => 'PATCH',
                            'url' => ['/academic/subjects', $subject->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('academic.subjects.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection