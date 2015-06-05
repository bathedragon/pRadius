

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pRADIUS 后台管理</title>
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

        <ul class="main-nav">
            <li class="main-nav--active">
                <a class="main-nav__link" href="#">
                    <span class="main-nav__icon"><i class="pe-7f-home"></i></span>
                    Dashboard
                </a>
            </li>
            <li>
                <a class="main-nav__link" href="/admin/operator">
                    <span class="main-nav__icon"><i class="pe-7f-user"></i></span>
                    管理员
                </a>
            </li>
            <li class="main-nav--collapsible">
                <a class="main-nav__link" href="#" onclick="return false;">
                    <span class="main-nav__icon"><i class="pe-7f-monitor"></i></span>
                    用户管理 <span class="badge badge--line badge--blue">2</span>
                </a>
                <ul class="main-nav__submenu">
                    <li><a href="/admin/member/apply"><span>申请列表</span></a></li>
                    <li><a href="/admin/member"><span>用户列表</span></a></li>
                </ul>
            </li>
            <li>
                <a class="main-nav__link" href="/admin/plan">
                    <span class="main-nav__icon"><i class="pe-7f-browser"></i></span>
                    流量方案
                </a>
            </li>
            <li class="main-nav--collapsible">
                <a class="main-nav__link" href="#" onclick="return false;">
                    <span class="main-nav__icon"><i class="pe-7f-monitor"></i></span>
                    统计 <span class="badge badge--line badge--blue">2</span>
                </a>
                <ul class="main-nav__submenu">
                    <li><a href="/admin/report/online"><span>在线用户</span></a></li>
                    <li><a href="/admin/report/top"><span>使用排行</span></a></li>
                </ul>
            </li>
            <li>
                <a class="main-nav__link" href="/admin/graph">
                    <span class="main-nav__icon"><i class="pe-7f-graph3"></i></span>
                    分析
                </a>
            </li>
            <li>
                <a class="main-nav__link" href="/admin/accounting">
                    <span class="main-nav__icon"><i class="pe-7f-graph3"></i></span>
                    历史记录
                </a>
            </li>
        </ul>

    </aside> <!-- /sidebar -->

    <section class="content">
        @yield('header')

        @yield('container')

    </section>

</div>



<script type="text/javascript" src="/glazzed/js/main.js"></script>
<script type="text/javascript" src="/glazzed/js/amcharts/amcharts.js"></script>
<script type="text/javascript" src="/glazzed/js/amcharts/serial.js"></script>
<script type="text/javascript" src="/glazzed/js/amcharts/pie.js"></script>
@yield('scripts')
<script>
    $(document).ready(function(){
        $.ajax({
            url: 'http://api.randomuser.me/',
            dataType: 'json',
            success: function(data){
                $("#user-avatar").attr("src",data.results[0].user.picture.medium);
                console.log(data);
            }
        });
    });
</script>
</body>
</html>