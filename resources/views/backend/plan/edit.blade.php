@extends('layouts.backend')

@section('header')
    <header class="main-header">
        <div class="main-header__nav">
            <h1 class="main-header__title">
                <i class="pe-7f-home"></i>
                <span>更新方案</span>
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
                    <input type="text" class="stacked-input" id="traffic-plan-name" placeholder="方案名称,限字母" value="{{$plan['groupname']}}" disabled>

                    <label for="input-1" class="stacked-label"><i class="pe-7f-network"></i></label>
                    <input type="text" class="stacked-input" id="traffic-daily" placeholder="每日流量" disabled value="每日 {{$plan['daily']}}(M)">
                    <div class="slider range-min orange daily spec active">

                    </div>

                    <label for="input-1" class="stacked-label"><i class="pe-7f-network"></i></label>
                    <input type="text" class="stacked-input" id="traffic-monthly" placeholder="每月流量" disabled value="每月 {{$plan['monthly']/1024}}(G)">

                    <div class="slider range-min orange monthly spec">

                    </div>



                    <label for="input-1" class="stacked-label"><i class="pe-7f-next"></i></label>
                    <input type="text" class="stacked-input" id="simultaneous-use" placeholder="同时在线数" disabled value="同时在线数 {{$plan['simultaneous']}}">

                    <div class="slider range-min orange simultaneous spec">

                    </div>


                    <label for="input-1" class="stacked-label"><i class="pe-7f-next"></i></label>
                    <input type="text" class="stacked-input" id="idle-timeout" value="空闲超时 {{$plan['idle_timeout']/3600}} 小时" disabled>

                    <div class="slider range-min orange idletimeout spec">

                    </div>


                    <label for="input-1" class="stacked-label"><i class="pe-7f-next"></i></label>
                    <input type="text" class="stacked-input" id="session-timeout" value="会话超时 {{$plan['session_timeout']/3600}} 小时" disabled>

                    <div class="slider range-min orange sessiontimeout spec">

                    </div>

                    <label for="input-1" class="stacked-label"><i class="pe-7f-next"></i></label>
                    <input type="text" class="stacked-input" id="acct-interval" value="统计间隔 {{$plan['acct_interval']/60}} 分钟" disabled>

                    <div class="slider range-min orange acctinterval spec">

                    </div>


                    <label for="input-1" class="stacked-label"><i class="pe-7f-network"></i></label>
                    <input type="text" class="stacked-input" id="traffic-price" placeholder="价格" value="免费">

                    <button type="button" id="updatePlan">更新</button>
                </div>
                <article>
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

            sliderMaker('.daily','#traffic-daily',512,10240,512,"{{$plan['daily']}}",'每日','M');

            sliderMaker('.monthly','#traffic-monthly',1,100,1,"{{$plan['monthly'] / 1024}}",'每月','G');

            sliderMaker('.simultaneous','#simultaneous-use',1,10,1,"{{$plan['simultaneous']}}",'','台设备同时登录');

            sliderMaker('.idletimeout','#idle-timeout',1,24,1,"{{$plan['idle_timeout']/3600}}",'空闲超时','小时');

            sliderMaker('.sessiontimeout','#session-timeout',1,24,1,"{{$plan['session_timeout']/3600}}",'会话超时','小时');

            sliderMaker('.acctinterval','#acct-interval',1,60,1,"{{$plan['acct_interval']/60}}",'统计间隔','分钟');

        });
        $("#updatePlan").on("click",function(){
            var param = {
                name : "{{$plan['groupname']}}",
                daily : $("#traffic-daily").val(),
                monthly : $("#traffic-monthly").val(),
                price : $("#traffic-price").val(),
                simultaneous : $("#simultaneous-use").val(),
                idletimeout : $("#idle-timeout").val(),
                sessiontimeout : $("#session-timeout").val(),
                acctinterval : $("#acct-interval").val(),
                _token : "{{csrf_token()}}"
            };

            $.post("/admin/plan/edit",param,function(res){
                if(res.ret) location.reload(); else alert(res.error);
            },'json');
        })
    </script>
@stop