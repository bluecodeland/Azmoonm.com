<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="{{ $options->get('site_description')->value }}">
  <meta name="keywords" content="{{ $options->get('site_keywords')->value }}">
  <meta name="author" content="{{ $options->get('designer')->value }}">
  <meta name="theme-color" content="#028fcc">
  <link rel="icon" href="/uploads/images/{{ $options->get('favicon')->value }}">

  <title>{{ $options->get('site_title')->value }} - @yield('title')</title>

  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/bootstrap-rtl.min.css" rel="stylesheet">
  <link href="/css/animate.min.css" rel="stylesheet"> 
  <link href="/css/font-awesome.min.css" rel="stylesheet">
  <link href="/css/lightbox.css" rel="stylesheet">
  <link href="/css/main.css" rel="stylesheet">
  <link href="/css/preset.css" rel="stylesheet">
  <link href="/css/responsive.css" rel="stylesheet">
  <link href="/css/font-awesome.min.css" rel="stylesheet" >

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="/js/html5shiv.min.js"></script>
    <script src="/js/respond.min.js"></script>
  <![endif]-->

</head>
 
<body>
  <nav class="navbar navbar-main">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">
          <h1 class="navbar-title"><img src="/uploads/images/{{ $options->get('logo')->value }}" alt="logo" class="hidden-xs"> {!! $options->get('site_name_fa')->value !!}</h1>
        </a>                    
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right flip">
          @if (Auth::guest())
            <li><a href="{{ url('/register') }}" class="color1">ثبت نام</a></li>
            <li><a href="{{ url('/login') }}" class="color2">ورود</a></li>
          @else
            @if (Auth::user()->hasRole('admin') OR Auth::user()->hasRole('superuser'))
              <li class="dropdown">
                <a href="#" class="dropdown-toggle name" data-toggle="dropdown" role="button" aria-expanded="false">
                  مدیریت سایت <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ url('/admin') }}"><i class="fa fa-bar-chart"></i> مدیریت سایت</a></li>
                  <li><a href="{{ url('/admin/applications/all') }}"><i class="fa fa-file-text"></i> تمام ثبت نام ها</a></li>
                  <li><a href="{{ url('/admin/applications/unprinted_cards') }}"><i class="fa fa-id-card"></i> کارت</a></li>
                  <li><a href="{{ url('/admin/reports') }}"><i class="fa fa-download"></i> گزارش ها</a></li>
                  @if(Auth::user()->hasRole('superuser'))
                    <li><a href="{{ url('/admin/users') }}"><i class="fa fa-users"></i> کاربران</a></li>
                    <li><a href="{{ url('/admin/settings') }}"><i class="fa fa-cog"></i> تنظیمات</a></li>
                  @endif
                </ul>
              </li>
            @endif
            <li class="dropdown">
              <a href="#" class="dropdown-toggle name" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                @if (Auth::user()->hasRole('admin') OR Auth::user()->hasRole('superuser'))
                  <li><a href="{{ url('/admin') }}"><i class="fa fa-home"></i> صفحه اصلی</a></li>
                  <li><a href="{{ url('/user/picture') }}"><i class="fa fa-camera"></i> آپلود عکس</a></li>
                  <li><a href="{{ url('/user') }}"><i class="fa fa-key"></i> تغیر رمز عبور</a></li>
                  @endif
                @if (Auth::user()->hasRole('schooladmin'))
                  <li><a href="{{ url('/schooladmin') }}"><i class="fa fa-home"></i> صفحه اصلی</a></li>
                  <li><a href="{{ url('/user/picture') }}"><i class="fa fa-camera"></i> آپلود عکس</a></li>
                  <li><a href="{{ url('/user') }}"><i class="fa fa-key"></i> تغیر رمز عبور</a></li>
                @endif
                @if (Auth::user()->hasRole('prospect'))
                  <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> صفحه اصلی</a></li>
                  <li><a href="{{ url('/user/picture') }}"><i class="fa fa-camera"></i> آپلود عکس</a></li>
                  <li><a href="{{ url('/user') }}"><i class="fa fa-key"></i> تغیر رمز عبور</a></li>
                @endif
                <li>
                  <form action="{{ url('/logout') }}" method="POST">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-link">
                      <i class="fa fa-sign-out"></i> خروج</a>
                    </button>
                  </form>
                </li>
              </ul>
            </li>
            <li>
              <a href="{{ url('/user/picture') }}"><img src="/uploads/photo/{{ Auth::user()->picture }}" class="img-responsive photo" /></a>
            </li>
          @endif
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  @if(Session::has('alert-danger')||Session::has('alert-warning')||Session::has('alert-success')||Session::has('alert-info'))
  <div class="container">
    <div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}" style="margin-top: 15px;">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
      @endforeach
    </div> <!-- end .flash-message -->
  </div>
  @endif
  @if ($errors->any())
  <div class="container">
    <div class="flash-message">
      <p class="alert alert-danger" style="margin-top: 15px;">
        @foreach ($errors->all() as $error)
          {{ $error }}&nbsp;
        @endforeach
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      </p>    
    </div> <!-- end .flash-message -->
  </div>
  @endif  
  
  @yield('content')

  <div class="clearfix"></div>
  <footer id="footer" class="footer">
    <div class="footer-top">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="/"><img class="img-responsive" src="/uploads/images/{{ $options->get('logo')->value }}" alt=""></a>
        </div>
        <div class="social-icons">
          <ul>
            <li><a class="envelope" href="mailto:{{ $options->get('default_email')->value }}"><i class="fa fa-envelope"></i></a></li>
            <li><a class="instagram" href="{{ $options->get('instagram')->value }}"><i class="fa fa-instagram"></i></a></li> 
            <li><a class="telegram" href="{{ $options->get('telegram')->value }}"><i class="fa fa-tumblr-square"></i></a></li>
            <li><a class="skype" href="{{ $options->get('skype')->value }}" rel="nofollow"><i class="fa fa-skype"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="col-sm-10">
          <p class="text-muted">
            {!! $options->get('copyright')->value !!}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <i class="fa fa-home"></i>&nbsp;{{ $options->get('address')->value }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <i class="fa fa-phone"></i>&nbsp;{{ $options->get('phone')->value }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <i class="fa fa-envelope"></i>&nbsp;<a href="mailto:{{ $options->get('default_email')->value }}">{{ $options->get('default_email')->value }}</a>
          </p>
        </div>
        <div class="col-sm-2">
          <p class="pull-left text-muted">طراحی:&nbsp;<a href="http://{{ $options->get('designer')->value }}">{{ $options->get('designer')->value }}</a></p>
        </div>
      </div>
    </div>
  </footer>

  <script type="text/javascript" src="/js/jquery-1.12.0.min.js"></script>
  <script type="text/javascript" src="/js/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/js/google.maps.api.js"></script>
  <script type="text/javascript" src="/js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="/js/wow.min.js"></script>
  <script type="text/javascript" src="/js/mousescroll.js"></script>
  <script type="text/javascript" src="/js/smoothscroll.js"></script>
  <script type="text/javascript" src="/js/jquery.countTo.js"></script>
  <script type="text/javascript" src="/js/lightbox.min.js"></script>
  <script type="text/javascript" src="/js/main.js"></script>
  <script type="text/javascript" src="/js/main-last.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script type="text/javascript" src="/js/ie10-viewport-bug-workaround.js"></script>

  <!--Google Analytics Code -->
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
              (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-25404090-4', 'auto');
    ga('send', 'pageview');
  </script>

</body>
</html>