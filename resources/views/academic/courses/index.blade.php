@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Courses</div>
                    <div class="panel-body">

                        <a href="{{ url('/academic/courses/create') }}" class="btn btn-primary btn-xs" title="Add New Course"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Name </th><th> Code </th><th> Start </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($courses as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td><td>{{ $item->code }}</td><td>{{ $item->start }}</td>
                                        <td>
                                            <a href="{{ url('/academic/courses/' . $item->id) }}" class="btn btn-success btn-xs" title="View Course"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/academic/courses/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Course"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            @if(Auth::user()->hasRole('superuser'))
                                                {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => ['/academic/courses', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Course" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Course',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $courses->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection