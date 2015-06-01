<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
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
<div>
    <div class="col-md-4  col-md-offset-4">
        <article class="widget widget__login">
            <header class="widget__header one-btn">
                <div class="widget__title">
                    <div class="main-logo"><img src="/glazzed/img/logo.png"></div> Sign in
                </div>
                <div class="widget__config">
                    <a href="/" onclick="location.href='/'"><i class="pe-7s-home"></i></a>
                </div>
            </header>
            <div class="widget__content">
                <input type="text" id="username" placeholder="用户名或邮箱">
                <input type="password" id="password" placeholder="密码">
                <button type="button" onclick="signin(this)">登录</button>
            </div>
        </article>
    </div>
</div>

<script type="text/javascript" src="/glazzed/js/main.js"></script>
<script>
    var submited = false;
    function signin(btn) {
        if(submited == true) return;
        submited = true;
        var u = $("#username").val(),p = $("#password").val();
        if(u == ""  || p == "") return;
        $.post("/session/new",{
            username : u,
            password : p,
            _token : "{{csrf_token()}}"
        },function(res){
            submited = false;
            if(res.ret) {
                location.href = res.redirect;
            } else {
                alert('账号或密码错误');
            }
        },'json');
    }
</script>
</body>
</html>