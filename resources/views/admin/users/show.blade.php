@extends('layouts.dashboard')

@section('title', 'کاربران')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">کاربر {{ $user->firstname }} {{ $user->lastname }}</div>
                    <div class="panel-body">

                        <a href="{{ url('admin/users/' . $user->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        @if(Auth::user()->hasRole('superuser'))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['admin/users', $user->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'title' => 'حذف کاربر',
                                'onclick'=>'return confirm("تایید حذف؟")'
                            ))!!}
                            {!! Form::close() !!}
                        @endif
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th> نام </th><td> {{ $user->firstname }} </td>
                                    </tr>
                                    <tr>
                                        <th> نام خانوادگی </th><td> {{ $user->lastname }} </td>
                                    </tr>
                                    <tr>
                                        <th> تلفن همراه </th><td> {{ getHindiNumerals($user->mobile) }} </td>
                                    </tr>
                                    <tr>
                                        <th> پست الکترونیکی </th><td> {{ $user->email }} </td>
                                    </tr>
                                    <tr>
                                        <th> عکس </th><td> {{ $user->picture }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection