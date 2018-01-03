@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Course {{ $course->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('academic/courses/' . $course->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Course"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        @if(Auth::user()->hasRole('superuser'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['academic/courses', $course->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Course',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                            {!! Form::close() !!}
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $course->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $course->name }} </td></tr><tr><th> Code </th><td> {{ $course->code }} </td></tr><tr><th> Start </th><td> {{ $course->start }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection