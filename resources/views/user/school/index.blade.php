@extends('layouts.dashboard')

@section('title', 'مرکز/مدرسه')

@section('content')
<div class="container">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">مرکز/مدرسه</h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/dashboard">صفحه اصلی</a></li>
      <li>مرکز/مدرسه</li>
    </ol>
    <div class="clearfix"></div>
  </div>

  <div class="page-advice">
    <strong>طلبه گرامی:</strong> شما میتوانید حداقل 3 و حداکثر تمام مدارس را انتخاب نمایید بر اساس اولویت. برای این کار منوی مدارس را باز کنید و اولویت اول خود را انتخاب و بر روی دکمه ذخیره کلیک کنید. برای انتخاب اولویت های دیگر خود نیز همین روند را انجام دهید.
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">انتخاب مدرسه یا مرکز بر اساس اولویت </div>
        @if ($user->getSchoolsCount($user->id) != 0)
        <table class="table table-borderless">
          <tbody>
            @foreach($schools as $item)
            <tr>
              <td>{{ $item->pivot->sort_order }}</td>
              <td>{{ $item->name }}</td>
              <td class="left-align">
                {!! Form::open([
                'method'=>'DELETE',
                'url' => ['/user/school', $item->id],
                'style' => 'display:inline'
                ]) !!}
                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> حذف', array(
                'type' => 'submit',
                'class' => 'btn btn-danger btn-xs',
                'title' => 'حذف',
                'onclick'=>'return confirm("تایید حذف?")'
                )) !!}
                {!! Form::close() !!}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else 
        <table class="table table-borderless">
          <tbody>
            <tr>
              <td><br />* شما هنوز انتخابی نکرده اید. حد اقل 3 مدرسه یا مرکز را انتخاب کنید. *<br />&nbsp;</td>
          </tbody>
        </table>
        @endif

        <div class="panel-footer">
          <a href="{{ url('/application/update') }}">
            <button type="button" class="btn btn-warning"><i class="fa fa-arrow-right" aria-hidden="true"></i> صفحه قبلی</button>
          </a>
          <a href="{{ url('/user/school/create') }}" class="btn btn-success btn-sm" title="ایجاد مرکز/مدرسه جدید">
            <i class="fa fa-plus" aria-hidden="true"></i> انتخاب مدرسه / مرکز
          </a>
          @if ($user->getSchoolsCount($user->id) >= 3)
          <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-sm" title="ایجاد مرکز/مدرسه جدید">
            <i class="fa fa-check" aria-hidden="true"></i> تکمیل ثبت نام
          </a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
