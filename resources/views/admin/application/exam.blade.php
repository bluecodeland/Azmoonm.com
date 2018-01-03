@extends('layouts.exam')

@section('title', 'پاسخنامه')

@section('content')

  <?php $i=0 ?>
  @foreach ($applications as $application)
    <?php $i++ ?>
    <div class="exam-paper">
      <div class="panel panel-default">

        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-2"><!-- logo -->
              <img src="/images/logo_bw.png" class="logo" alt="logo"> 
            </div><!-- //logo -->
            <div class="col-xs-8"><!-- title -->
              <p>بسمه تعالی</p>
              <p><strong>پاسخنامه {{ $application->user->seat->exam->name }}</strong></p>
              <p>مرکز فقهی قائم<sup>(عج)</sup></p>
            </div><!-- //title -->
            <div class="col-xs-2"><!-- picture -->
              <img src="/uploads/photo/{{ $application->user->picture }}" class="photo" alt="photo" />
            </div><!-- //picture -->
          </div>
          <div class="row">
            <div class="col-xs-3"><!-- name -->
              <p>نام: {{ $application->user->firstname }}</p>
            </div><!-- //name -->
            <div class="col-xs-3"><!-- lastname -->
              <p>نام خانوادگی: {{ $application->user->lastname }}</p>
            </div><!-- //lastname -->
            <div class="col-xs-3"><!-- seat -->
              <p>شماره صندلی: {{ $application->user->hasSeat( $application->user->id ) }}</p>
            </div><!-- //seat -->
            <div class="col-xs-3"><!-- result -->
              <p>پایه تحصیلی: </p>
            </div><!-- //result -->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-4"><!-- right -->
          <div class="row answers">
            <div class="col-xs-2 center col-xs-offset-1">ردیف</div>
            <div class="col-xs-2 center">الف</div>
            <div class="col-xs-2 center">ب</div>
            <div class="col-xs-2 center">ج</div>
            <div class="col-xs-2 center">د</div>
          </div>
          @for ($j = 1; $j <= 25; $j++)
            <div class="row answers">
              <div class="col-xs-2 center col-xs-offset-1">{{ $j }}</div>
              <div class="col-xs-2 center"><i class="fa fa-square-o fa-2x"></i></div>
              <div class="col-xs-2 center"><i class="fa fa-square-o fa-2x"></i></div>
              <div class="col-xs-2 center"><i class="fa fa-square-o fa-2x"></i></div>
              <div class="col-xs-2 center"><i class="fa fa-square-o fa-2x"></i></div>
            </div>
          @endfor
        </div><!-- //right -->
        <div class="col-xs-4"><!-- center -->
          <div class="row answers">
            <div class="col-xs-2 center col-xs-offset-1">ردیف</div>
            <div class="col-xs-2 center">الف</div>
            <div class="col-xs-2 center">ب</div>
            <div class="col-xs-2 center">ج</div>
            <div class="col-xs-2 center">د</div>
          </div>
          @for ($j = 26; $j <= 50; $j++)
            <div class="row answers">
              <div class="col-xs-2 center col-xs-offset-1">{{ $j }}</div>
              <div class="col-xs-2 center"><i class="fa fa-square-o fa-2x"></i></div>
              <div class="col-xs-2 center"><i class="fa fa-square-o fa-2x"></i></div>
              <div class="col-xs-2 center"><i class="fa fa-square-o fa-2x"></i></div>
              <div class="col-xs-2 center"><i class="fa fa-square-o fa-2x"></i></div>
            </div>
          @endfor
        </div><!-- //center -->
        <div class="col-xs-4"><!-- left -->
          <div class="row answers">
            <div class="col-xs-2 center col-xs-offset-1">ردیف</div>
            <div class="col-xs-2 center">الف</div>
            <div class="col-xs-2 center">ب</div>
            <div class="col-xs-2 center">ج</div>
            <div class="col-xs-2 center">د</div>
          </div>
          @for ($j = 51; $j <= 70; $j++)
            <div class="row answers">
              <div class="col-xs-2 center col-xs-offset-1">{{ $j }}</div>
              <div class="col-xs-2 center"><i class="fa fa-square-o fa-2x"></i></div>
              <div class="col-xs-2 center"><i class="fa fa-square-o fa-2x"></i></div>
              <div class="col-xs-2 center"><i class="fa fa-square-o fa-2x"></i></div>
              <div class="col-xs-2 center"><i class="fa fa-square-o fa-2x"></i></div>
            </div>
          @endfor
          <row class="col-xs-12">
            <div class="panel panel-default result-panel">
              <div class="panel-heading">نتیجه</div>
              <table class="table table-bordered table-condensed" width="100%">
                <thead>
                  <tr>
                    <th width="20%">صحیح</th>
                    <th width="20%">غلط</th>
                    <th width="20%">کل</th>
                    <th width="20%"></th>
                    <th width="20%"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td width="20%"></td>
                    <td width="20%"></td>
                    <td width="20%"></td>
                    <td width="20%"></td>
                    <td width="20%"></td>
                  </tr>
                </tbody>
              </table>
            </div><!-- //result-panel -->
          </row>
        </div><!-- //left -->
      </div>
      <div class="row notes">
        <p>تذکر: مدت پاسخگویی به سوالات 90 دقیقه در نظر گرفته شده است.</p>
      </div>   
      <div class="row page-number">
        <p>صفحه {{ $i }} از {{ $applications->count() }}</p>
      </div>   
    </div>
  @endforeach
@endsection
