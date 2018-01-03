@extends('layouts.app')

@section('title', 'پست الکترونیک')

<!-- Main Content -->
@section('content')

<div class="container login">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">بازیابی رمز عبور</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/reminder') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('emailmobile') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">پست الکترونیکی یا موبایل</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="emailmobile">

                                @if ($errors->has('emailmobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('emailmobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> ارسال رمز عبور
                                </button>
                            </div>
                        </div>
                    </form>
                <p>
                <i class="fa fa-check-square-o"></i>
                <script>
                    $(function () {
                      $('[data-toggle="tooltip"]').tooltip()
                    });
                    </script>
                                لطفا توجه نمایید که ایمیل حاوی لینک بازیابی رمز عبور ممکن است در پوشه <a href="#" data-toggle="tooltip" data-placement="top" title="Spam - Junk"><b>هرزنامه</b></a> های ایمیل شما دریافت شده باشد. 
                    
                            </p>
          
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
          <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
          
          <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
          </script>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
