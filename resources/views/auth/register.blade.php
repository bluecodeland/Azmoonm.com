@extends('layouts.app')

@section('title', 'ثبت نام')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-12">
        <div class="panel panel-danger">
          <div class="panel-heading">
              <i class="fa fa-exclamation-circle fa-6"></i> <strong>یادآوری مهم...</strong>
          </div>
          <div class="panel-body">
              <ul>
              <li>لطفا دقت داشته باشید که پس از ثبت نام اولیه ، نام کاربری و کلمه عبور برای شما به تلفن همراه و پست الکترونیکی شما ارسال خواهد شد. در مرحله بعد شما باید از قسمت ورود به سایت ، با استفاده از نام کاربری و رمز عبورتان اقدام به تکمیل ثبت نام نمایید. </li>
              <li>
                  همچنین شما پس از ثبت نام اولیه، 72 ساعت زمان برای تکمیل فرآیند ثبت نام خود دارید، اگر در این زمان ثبت نام شما تکمیل نشود، اطلاعات اولیه شما به طور کامل از سیستم حذف خواهد شد. و شما باید مراحل ثبت نام را مجدد انجام دهید.
                  
              </li>
              <li>
                  <strong>مهلت زمان 72 ساعت ، تا 3 روز به اتمام ثبت نام اعتبار دارد و پس از آن شما تا روز پایان مهلت ثبت نام قادر به تکمیل اطلاعات خود هستید ، در غیر این صورت اطلاعات شما حذف خواهد شد.</strong>
                  
              </li>
              </ul>
          </div>
         </div>
      </div>
  </div>
    
</div>
  <div class="container login">
   <div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12 bottom-buffer-2">
      @if (!$registration_open)
      <div class="panel panel-danger">
        <div class="panel-heading"><i class="fa fa-lock"></i> <strong>ثبت نام بسته است</strong></div>
      </div>
      @endif
      <div class="panel panel-default">
        <div class="panel-heading"><small>زمانبندی پذیرش</small></div>
        <table class="table">
          @foreach ($schedules as $schedule)
          <tr>
            <td><small>{{ $schedule->type->label }}</small></td>
            <td><small>{{ $schedule->getDeadline() }}</small></td>
          </tr>
          @endforeach
        </table>
      </div>
      <div class="panel panel-info">
        <div class="panel-heading"><i class="fa fa-file-pdf-o"></i> دانلود <a href="/uploads/files/{{ $options->get('instructions')->value }}"><strong>دفترچه راهنما</strong></a></div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading registration-notes"><small>
          <strong>لطفا توجه داشته باشید:</strong>
          <ul>
            <li>لطفا در وارد کردن شماره همراه و پست الکترونیک دقت کنید و از درستی آن ها اطمینان حاصل نمایید. </li>
            <li>پس از ذخیره اطلاعات در ثبت نام اولیه، رمز عبور به شماره همراه و پست الکترونیک شما ارسال خواهد شد.</li>
          </ul>
        </small></div>
      </div>
    </div>
    @if ($registration_open)
    <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="panel panel-danger">
        <div class="panel-heading"><strong>ثبت نام</strong></div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {!! csrf_field() !!}

            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">نام</label>

              <div class="col-md-7">
                <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}">

                @if ($errors->has('firstname'))
                <span class="help-block">
                  <strong>{{ $errors->first('firstname') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">نام خانوادگی</label>

              <div class="col-md-7">
                <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">

                @if ($errors->has('lastname'))
                <span class="help-block">
                  <strong>{{ $errors->first('lastname') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">تلفن همراه</label>

              <div class="col-md-7">
                <input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}">

                @if ($errors->has('mobile'))
                <span class="help-block">
                  <strong>{{ $errors->first('mobile') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">پست الکترونیکی</label>

              <div class="col-md-7">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('read_booklet') ? ' has-error' : '' }}">
              <label class="col-md-4 control-label">دفترچه راهنما</label>
              <div class="col-md-7">
                <div class="checkbox">
                  <label>
                    <input class="checkbox" type="checkbox" name="read_booklet" value="1" {{ (old('read_booklet')) ? 'checked=checked' : '' }}> آیا <a href="/uploads/files/{{ $options->get('instructions')->value }}">دفترچه راهنما</a> را مطالعه نموده اید؟ 
                  </label>
                </div>
                @if ($errors->has('read_booklet'))
                <span class="help-block">
                  <strong>{{ $errors->first('read_booklet') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-7 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-lg">
                  <i class="fa fa-btn fa-user"></i> ذخیره
                </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 bottom-buffer-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a href="/uploads/files/{{ $options->get('poster')->value }}"><img src="/uploads/files/{{ $options->get('poster')->value }}" class="img-responsive " /></a>
        </div>
      </div>
    </div>
    @else
    <div class="col-md-7 col-sm-12 col-xs-12 bottom-buffer-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a href="/uploads/files/{{ $options->get('poster')->value }}"><img src="/uploads/files/{{ $options->get('poster')->value }}" class="img-responsive " /></a>
        </div>
      </div>
    </div>    
    @endif
  </div>
</div>
@endsection
