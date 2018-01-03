<!DOCTYPE html>
<html lang="fa" moznomarginboxes mozdisallowselectionprint>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="{{ $options->get('site_description')->value }}">
  <meta name="keywords" content="{{ $options->get('site_description')->keywords }}">
  <meta name="author" content="{{ $options->get('designer')->value }}">
  <meta name="theme-color" content="#028fcc">
  <link rel="icon" href="/uploads/images/{{ $options->get('favicon')->value }}">

  <title>{{ $options->get('site_title')->value }} @yield('title')</title>

  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/bootstrap-rtl.min.css" rel="stylesheet">
  <link href="/css/animate.min.css" rel="stylesheet"> 
  <link href="/css/font-awesome.min.css" rel="stylesheet">
  <link href="/css/lightbox.css" rel="stylesheet">
  <link href="/css/main.css" rel="stylesheet">
  <link href="/css/preset.css" rel="stylesheet">
  <link href="/css/responsive.css" rel="stylesheet">
  <link href="/css/font-awesome.min.css" rel="stylesheet" >
  <link href="/css/dataTables.bootstrap.min.css" rel="stylesheet" >


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="/js/html5shiv.min.js"></script>
    <script src="/js/respond.min.js"></script>
  <![endif]-->

</head>

<body>

  <div class="container">
    @yield('content')
  </div>

  <script type="text/javascript" src="/js/main.js"></script>
  <script type="text/javascript" src="/js/jquery.min.js"></script>
  <script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="/js/wow.min.js"></script>
  <script type="text/javascript" src="/js/mousescroll.js"></script>
  <script type="text/javascript" src="/js/smoothscroll.js"></script>
  <script type="text/javascript" src="/js/jquery.countTo.js"></script>
  <script type="text/javascript" src="/js/lightbox.min.js"></script>
  <script type="text/javascript" src="/js/bootstrap-filestyle.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script type="text/javascript" src="/js/ie10-viewport-bug-workaround.js"></script>
  <script type="text/javascript" src="/js/main-last.js"></script>
  
</body>
</html>