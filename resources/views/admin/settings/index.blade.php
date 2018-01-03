@extends('layouts.dashboard')

@section('title', 'تنظیمات')

@section('content')
<div class="container comments">
  <div class="page-header page-heading">
    <h1 class="pull-right dashboard">تنظیمات</h1>
    <ol class="breadcrumb pull-left where-am-i">
      <li><a href="/admin">مدیریت سایت</a></li>
      <li>تنظیمات</li>
    </ol>
    <div class="clearfix"></div>
  </div>

  <div class="panel panel-default">
    <table class="table table-striped">
      <tr>
        <td>
          <a href="/admin/settings/site/">سایت</a>
        </td>
        <td>ویرایش تنظیمات سایت (نام سایت, عنوان سایت, توضیحات سایت, کلمات کلیدی سایت, پست الکترونیک پیشفرض)</td>
      </tr>
      <tr>
        <td>
          <a href="/admin/settings/social/">رسانه های اجتماعی</a>
        </td>
        <td>تغییر تنظیمات رسانه های اجتماعی</td>
      </tr>
      <tr>
        <td>
          <a href="/admin/settings/images/">تصاویر</a>
        </td>
        <td>آپلود تصاویر سایت (فاویکون, آرم, آرم سیاه و سفید)</td>
      </tr>
      <tr>
        <td>
          <a href="/admin/settings/files/">آپلود فایل های</a>
        </td>
        <td>آپلود فایل های (دفترچه راهنما و پوستر)</td>
      </tr>
      <tr>
        <td>
          <a href="/admin/settings/schools/">مرکز/مدرسه</a>
        </td>
        <td>ایجاد, ویرایش و حذف مرکز/مدرسه</td>
      </tr>
      <tr>
        <td>
          <a href="/admin/settings/admissions/">زمانبندی پذیرش</a>
        </td>
        <td>زمانبندی پذیرش</td>
      </tr>
      <tr>
        <td>
          <a href="/admin/settings/card/">کارت آزمون</a>
        </td>
        <td>کارت ورود به جلسه آزمون</td>
      </tr>
      <tr>
        <td>
          <a href="/admin/settings/data-management/">مدیریت داده</a>
        </td>
        <td>حذف همه فرم ها ناقص, حذف همه صندلی های موجود و اختصاص همه صندلی</td>
      </tr>
    </table>
  </div>

</div>
@endsection
