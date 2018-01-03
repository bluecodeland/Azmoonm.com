@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Subjects</div>
                    <div class="panel-body">

                        <a href="{{ url('/academic/subjects/create') }}" class="btn btn-primary btn-xs" title="Add New Subject"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Course Id </th><th> Name </th><th> Code </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($subjects as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->course_id }}</td><td>{{ $item->name }}</td><td>{{ $item->code }}</td>
                                        <td>
                                            <a href="{{ url('/academic/subjects/' . $item->id) }}" class="btn btn-success btn-xs" title="View Subject"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/academic/subjects/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Subject"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            @if(Auth::user()->hasRole('superuser'))
                                                {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => ['/academic/subjects', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Subject" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Subject',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $subjects->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection