@extends('layouts.dashboard')

@section('title', 'آپلود عکس')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default picture-upload">
        <div class="panel-heading">آپلود عکس</div>
        <div class="panel-body">

          <form id="form-photo" action="{{ URL::to('admin/users/picture/upload') }}" method="POST" class="" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="col-sm-12">
              <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                <div class="col-sm-12 photo">
                  <input type="file" name="picture" id="picture" class="form-control filestyle" data-classButton="btn btn-primary" data-input="true"  data-iconName="fa fa-btn fa-folder" data-buttonText="انتخاب فایل" data-buttonName="btn-primary">
                  {{ Form::hidden('manage_user_id', $user->id) }}
                  @if ($errors->has('picture'))
                  <span class="help-block">
                    <strong>{{ $errors->first('picture') }}</strong>
                  </span>
                  @endif
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-save "></i> آپلود عکس
                  </button>
                </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
