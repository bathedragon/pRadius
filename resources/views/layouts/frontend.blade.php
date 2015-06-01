<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VPN</title>
    <link rel="icon" sizes="192x192" href="glazzed/img/touch-icon.png" />
    <link rel="apple-touch-icon" href="glazzed/img/touch-icon-iphone.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="glazzed/img/touch-icon-ipad.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="glazzed/img/touch-icon-iphone-retina.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="glazzed/img/touch-icon-ipad-retina.png" />
    <link rel="shortcut icon" type="image/x-icon" href="glazzed/img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="glazzed/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="glazzed/css/main.min.css">
    <link rel="stylesheet" type="text/css" href="glazzed/css/pe-icon-7-filled.css">
    <link rel="stylesheet" type="text/css" href="glazzed/css/pe-icon-7-stroke.css">
    @yield('links')
</head>
<body>
<div id="loading">
    <div class="loader loader-light loader-large"></div>
</div>
<header class="top-bar">
    <ul class="profile">
        <li>
            <a href="/session/new" class="btn-circle btn-sm">
                <i class="pe-7g-user"></i>
            </a>
        </li>
    </ul>

    <div class="main-brand">
        <div class="main-brand__container">
            <div class="main-logo"><img src="glazzed/img/logo.png"></div>
        </div>
    </div>

</header>

<div class="wrapper">
    <section class="content">
        @yield('header')
        @yield('container')
        <footer class="footer-brand">
            <img src="glazzed/img/logo_trim.png">
            <p>© 2014 Glazzed. All rights reserved</p>
        </footer>
    </section>
</div>

<script type="text/javascript" src="glazzed/js/main.js"></script>
@yield('scripts')
</body>
</html>