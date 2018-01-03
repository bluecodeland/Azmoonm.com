@extends('layouts.dashboard')

@section('title', 'مرکز/مدرسه')

@section('content')
<div class="container">
    <div class="page-header page-heading">
        <h1 class="pull-right dashboard">مرکز/مدرسه</h1>
        <ol class="breadcrumb pull-left where-am-i">
            <li><a href="/admin">مدیریت سایت</a></li>
            <li><a href="/admin/settings">تنظیمات</a></li>
            <li>مرکز/مدرسه</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>اسم مرکز</th>
                            <th>اسم کوتاه مرکز</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>تلفن همراه</th>
                            <th>پست الکترونیکی</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schools as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->label }}</td>
                            <td>{{ $item->admin->firstname }}</td>
                            <td>{{ $item->admin->lastname }}</td>
                            <td>{{ $item->admin->mobile }}</td>
                            <td>{{ $item->admin->email }}</td>
                            <td class="left-align">
                                <!-- <a href="{{ url('/admin/settings/schools/' . $item->id) }}" title="View School"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a> -->
                                <a href="{{ url('/admin/settings/schools/' . $item->id . '/edit') }}" title="ویرایشحذف"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ویرایش</button></a>
                                @if(Auth::user()->hasRole('superuser'))
                                    {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/admin/settings/schools', $item->id],
                                    'style' => 'display:inline'
                                    ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> حذف', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'حذف',
                                    'onclick'=>'return confirm("تایید حذف?")'
                                    )) !!}
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="panel-footer">
                    <a href="{{ url('/admin/settings/schools/create') }}" class="btn btn-success btn-sm" title="ایجاد مرکز/مدرسه جدید">
                        <i class="fa fa-plus" aria-hidden="true"></i> ایجاد جدید
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
