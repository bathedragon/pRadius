@extends('layouts.backend')

@section('header')
    <header class="main-header">
        <div class="main-header__nav">
            <h1 class="main-header__title">
                <i class="pe-7f-home"></i>
                <span>添加方案</span>
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
                        <i class="pe-7s-pin"></i><h3>方案信息</h3>
                    </div>
                    <div class="widget__config">
                        <a href="/admin/plan"><i class="pe-7f-menu"></i></a>
                        <a href="#"><i class="pe-7s-close"></i></a>
                    </div>
                </header>

                <div class="widget__content">
                    <label for="input-3" class="stacked-label"><i class="pe-7f-key"></i></label>
                    <input type="text" class="stacked-input" id="traffic-plan-name" placeholder="方案名称,限字母">

                    <label for="input-1" class="stacked-label"><i class="pe-7f-network"></i></label>
                    <input type="text" class="stacked-input" id="traffic-daily" placeholder="每日流量" disabled>
                    <div class="slider range-min orange daily spec active">

                    </div>

                    <label for="input-1" class="stacked-label"><i class="pe-7f-network"></i></label>
                    <input type="text" class="stacked-input" id="traffic-monthly" placeholder="每月流量" disabled>

                    <div class="slider range-min orange monthly spec">

                    </div>



                    <label for="input-1" class="stacked-label"><i class="pe-7f-next"></i></label>
                    <input type="text" class="stacked-input" id="simultaneous-use" placeholder="同时在线数" disabled>

                    <div class="slider range-min orange simultaneous spec">

                    </div>


                    <label for="input-1" class="stacked-label"><i class="pe-7f-next"></i></label>
                    <input type="text" class="stacked-input" id="idle-timeout" placeholder="空闲超时" disabled>

                    <div class="slider range-min orange idletimeout spec">

                    </div>


                    <label for="input-1" class="stacked-label"><i class="pe-7f-next"></i></label>
                    <input type="text" class="stacked-input" id="session-timeout" placeholder="会话超时" disabled>

                    <div class="slider range-min orange sessiontimeout spec">

                    </div>

                    <label for="input-1" class="stacked-label"><i class="pe-7f-next"></i></label>
                    <input type="text" class="stacked-input" id="acct-interval" placeholder="统计间隔" disabled>

                    <div class="slider range-min orange acctinterval spec">

                    </div>



                    <label for="input-1" class="stacked-label"><i class="pe-7f-network"></i></label>
                    <input type="text" class="stacked-input" id="traffic-price" placeholder="价格" value="免费">

                    <button type="button" id="newPlan">添加</button>
                </div>
                </article>
        </div>
    </div>
@stop


@section('scripts')
    <script>
        $(document).ready(function(){
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
            $(".daily").slider({
                range : "min",
                min : 512,
                max : 10240,
                slide : function(event,ui) {
                    $("#traffic-daily").val("每日 "+$(this).slider("value") + "M");
                },
                stop : function(event,ui) {
                    $("#traffic-daily").val("每日 "+$(this).slider("value") + "M");
                },
                step : 512,
                value : 512
            });
            $(".monthly").slider({
                range : "min",
                min : 1,
                max : 101,
                slide : function(event,ui) {
                    $("#traffic-monthly").val("每月 "+$(this).slider("value") + "G");
                },
                stop : function(event,ui) {
                    $("#traffic-monthly").val("每月 "+$(this).slider("value") + "G");
                },
                step : 1,
                value : 1
            });
            $(".simultaneous").slider({
                range : "min",
                min : 1,
                max : 10,
                slide : function(event,ui) {
                    $("#simultaneous-use").val(" "+$(this).slider("value") + "台设备同时登录");
                },
                stop : function(event,ui) {
                    $("#simultaneous-use").val(" "+$(this).slider("value") + "台设备同时登录");
                },
                step : 1
            });

            $(".idletimeout").slider({
                range : "min",
                min : 1,
                max : 24,
                slide : function(event,ui) {
                    $("#idle-timeout").val("空闲超时 "+$(this).slider("value") + "小时");
                },
                stop : function(event,ui) {
                    $("#idle-timeout").val("空闲超时 "+$(this).slider("value") + "小时");
                },
                step : 1
            });
            $(".sessiontimeout").slider({
                range : "min",
                min : 1,
                max : 24,
                slide : function(event,ui) {
                    $("#session-timeout").val("会话超时 "+$(this).slider("value") + "小时");
                },
                stop : function(event,ui) {
                    $("#session-timeout").val("会话超时 "+$(this).slider("value") + "小时");
                },
                step : 1
            });
            $(".acctinterval").slider({
                range : "min",
                min : 1,
                max : 60,
                slide : function(event,ui) {
                    $("#acct-interval").val("统计间隔 "+$(this).slider("value") + "分钟");
                },
                stop : function(event,ui) {
                    $("#acct-interval").val("统计间隔 "+$(this).slider("value") + "分钟");
                },
                step : 1
            });
        });
        $("#newPlan").on("click",function(){
            var param = {
                name : $("#traffic-plan-name").val(),
                daily : $("#traffic-daily").val(),
                monthly : $("#traffic-monthly").val(),
                price : $("#traffic-price").val(),
                simultaneous : $("#simultaneous-use").val(),
                idletimeout : $("#idle-timeout").val(),
                sessiontimeout : $("#session-timeout").val(),
                acctinterval : $("#acct-interval").val(),
                _token : "{{csrf_token()}}"
            };

            $.post("/admin/plan",param,function(res){
                if(res.ret) location.reload(); else alert(res.error);
            },'json');
        })
    </script>
@stop