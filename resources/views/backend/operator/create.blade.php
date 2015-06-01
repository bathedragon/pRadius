@extends('layouts.backend')

@section('header')
    <header class="main-header">
        <div class="main-header__nav">
            <h1 class="main-header__title">
                <i class="pe-7f-home"></i>
                <span>添加管理员</span>
            </h1>
            <ul class="main-header__breadcrumb">

            </ul>
        </div>
    </header>
@stop

@section('container')
<div class="row">
    <div class="col-md-12">
        <article class="widget widget__form">
            <header class="widget__header">
                <div class="widget__title">
                    <i class="pe-7s-user"></i><h3>管理员信息</h3>
                </div>
                <div class="widget__config">
                    <a href="/admin/operator"><i class="pe-7f-menu"></i></a>
                    <a href="#"><i class="pe-7s-close"></i></a>
                </div>
            </header>

            <div class="widget__content">
                <label for="input-3" class="stacked-label"><i class="pe-7f-mail"></i></label>
                <input type="text" class="stacked-input" id="input-email" placeholder="邮箱">

                <label for="input-1" class="stacked-label"><i class="pe-7f-user"></i></label>
                <input type="password" class="stacked-input" id="input-password" placeholder="密码">

                <button type="button" id="newOperator">添加</button>
            </div>
        <article>
    </div>
</div>
@stop


@section('scripts')
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

            $("#newOperator").on("click",function(){
                var email = $("#input-email").val(),password = $("#input-password").val();
                $.post("/admin/operator",{
                    email : email,
                    password : password,
                    _token : "{{csrf_token()}}"
                },function(res){
                    if(!res.ret) alert(res.error);
                    if(res.ret) location.reload();
                },'json');
            });
        });
    </script>
@stop