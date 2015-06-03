@extends('layouts.frontend')

@section('header')
    <header class="main-header">
        <div class="main-header__nav">
            <h1 class="main-header__title">
                <i class="pe-7f-note2"></i>
                <span>VPN Plan</span>
            </h1>
            <ul class="main-header__breadcrumb">

            </ul>
        </div>

    </header>
@stop

@section('container')
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12 col-md-offset-1">
            <article class="widget">
                <header class="widget__header">
                    <div class="widget__title full-width">
                        <i class="pe-7s-menu"></i><h3>Plans</h3>
                    </div>
                </header>

                <div class="widget__content table-responsive">

                    <table class="table table-striped media-table">
                        <thead>
                        <tr>
                            <th width="100">Plan</th>
                            <th width="240">介绍</th>
                            <th width="100">允许设备</th>
                            <th width="50">状态</th>
                            <th width="50">价格</th>
                            <th>选择</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($plans as $plan)
                            <tr class="spacer"></tr>
                            <tr>
                                <td>{{$plan['groupname']}}</td>
                                <td>每日流量{{number_format(array_get($plan,'detail.daily')/1024,2)}}G，每月流量{{number_format(array_get($plan,'detail.monthly')/1024,2)}}G</td>
                                <td>{{array_get($plan,'detail.simultaneous')}}</td>
                                <td>可申请</td>
                                <td>免费</td>
                                <td>
                                    <input type="radio" class="custom-radio" name="plan" value="{{$plan['groupname']}}" id="{{$plan['groupname']}}">
                                    <label for="{{$plan['groupname']}}" class="green"></label>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </article>
        </div>


        <div class="col-md-4 col-lg-4 col-md-12">

            <article class="widget widget__form">
                <header class="widget__header">
                    <div class="widget__title full-width">
                        <i class="pe-7s-menu"></i><h3>账号信息</h3>
                    </div>
                </header>

                <div class="widget__content">
                    <input type="text" name="username" value="" placeholder="用户名,限字母(6-15位)" id="username">
                    <input type="password" name="password" value="" placeholder="密码,数字和字母组合(6-20位)" id="password">
                    <button type="button" id="apply-btn">申请</button>
                </div>
               </article>
            <div class="alert alert-fixed alert-success alert-dismissible" role="alert" id="message-div" style="display: none;">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true"><i class="pe-7s-close"></i></span><span class="sr-only">Close</span></button>
                <div class="alert__icon pull-left">
                    <i class="pe-7s-check" id="message-icon"></i>
                </div>
                <p class="alert__text" id="message"> Success! The page has been...</p>
            </div>
        </div>


    </div>
@stop
@section('scripts')
<script>
    $(document).ready(function(){
        var _s = false,btn = $("#apply-btn");
        btn.on("click",function(){
            var u = $("#username").val(),p = $("#password").val(),plan = $("input[name='plan']:checked").val();
            if(u == "" || p == "" || plan == "") {
                message(true,"请填写完整");
                return false;
            }
            if(_s == true) return false;
            _s = true;
            btn.html("正在进行...");

            $.ajax({
                method : 'post',
                url : '/plan/apply',
                data : {password:p,username:u,_token:"{{csrf_token()}}",plan:plan},
                dataType : 'json',
                success : function(res){
                    message(false,res.message)
                },
                error : function(req){
                    var errors = JSON.parse(req.responseText);
                    var msg = [];
                    for(var i in errors) {
                        msg.push(errors[i].join(","));
                    }
                    message(true,msg.join('<br>'))
                },
                complete : function(){
                    _s = false;
                    btn.html("申请");
                }
            });
        });
        function message(error,msg) {
            var $div = $("#message-div"),$icon = $("#message-icon");
            var cls = error ? 'alert-danger' : 'alert-success';
            var icon = error ? 'pe-7s-close-circle' : 'pe-7s-check';
            $div.show();
            $icon.attr("class",icon);
            $div.attr("class","alert alert-fixed alert-dismissible "+cls);
            $("#message").html(msg);
        }
    })
</script>
@stop