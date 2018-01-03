@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Subject {{ $subject->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('academic/subjects/' . $subject->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Subject"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        @if(Auth::user()->hasRole('superuser'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['academic/subjects', $subject->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Subject',
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
                                        <th>ID</th><td>{{ $subject->id }}</td>
                                    </tr>
                                    <tr><th> Course Id </th><td> {{ $subject->course_id }} </td></tr><tr><th> Name </th><td> {{ $subject->name }} </td></tr><tr><th> Code </th><td> {{ $subject->code }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection