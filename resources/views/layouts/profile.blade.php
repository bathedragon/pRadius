

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$username}} 的个人中心</title>
    <link rel="icon" sizes="192x192" href="/glazzed/img/touch-icon.png" />
    <link rel="apple-touch-icon" href="/glazzed/img/touch-icon-iphone.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/glazzed/img/touch-icon-ipad.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/glazzed/img/touch-icon-iphone-retina.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/glazzed/img/touch-icon-ipad-retina.png" />
    <link rel="shortcut icon" type="image/x-icon" href="/glazzed/img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/glazzed/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/glazzed/css/main.min.css">
    <link rel="stylesheet" type="text/css" href="/glazzed/css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="/glazzed/css/pe-icon-7-stroke.css">
</head>
<body>
<div id="loading">
    <div class="loader loader-light loader-large"></div>
</div>
<header class="top-bar">

    <ul class="profile">
        <li>
            <a href="/session/destroy" class="btn-circle no-circle">
                <i class="pe-7f-back"></i>
            </a>
        </li>
    </ul>

    <div class="main-brand">
        <div class="main-brand__container">
            <div class="main-logo"><img src="/glazzed/img/logo.png"></div>
        </div>
    </div>

</header>


<div class="wrapper">

    <aside class="sidebar">

        <div class="user-info">
            <figure class="rounded-image profile__img">
                <img class="media-object" src="" alt="user" id="user-avatar">
            </figure>
            <h2 class="user-info__name">{{$username}}</h2>
            <h3 class="user-info__role">Member - {{$user_group}}</h3>
            <ul class="user-info__numbers">
                <li></li>
            </ul>
        </div>

    </aside> <!-- /sidebar -->

    <section class="content">
        <header class="main-header">
            <div class="main-header__nav">
                <h1 class="main-header__title">
                    <i class="pe-7f-home"></i>
                    <span>Dashboard</span>
                </h1>
                <ul class="main-header__breadcrumb">

                </ul>
            </div>
        </header>

        @yield('container')

    </section>

</div>



<script type="text/javascript" src="/glazzed/js/main.js"></script>
<script type="text/javascript" src="/glazzed/js/amcharts/amcharts.js"></script>
<script type="text/javascript" src="/glazzed/js/amcharts/serial.js"></script>
<script type="text/javascript" src="/glazzed/js/amcharts/pie.js"></script>
@yield('scripts')
</body>
</html>