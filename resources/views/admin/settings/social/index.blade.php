@extends('layouts.dashboard')

@section('title', 'رسانه های اجتماعی')

@section('content')
<div class="container">
    <div class="page-header page-heading">
        <h1 class="pull-right dashboard">رسانه های اجتماعی</h1>
        <ol class="breadcrumb pull-left where-am-i">
            <li><a href="/admin">مدیریت سایت</a></li>
            <li><a href="/admin/settings">تنظیمات</a></li>
            <li>رسانه های اجتماعی</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>متغیر</th><th>مقدار</th><th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($social_options as $item)
                            <tr>
                                <td>{{ $item->label }}</td>
                                <td>{{ $item->value }}</td>
                                <td>
                                    <a href="{{ url('/admin/settings/social/' . $item->id . '/edit') }}" title="ویرایش"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ویرایش</button></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
