@extends('layouts.backend')

@section('header')
    <header class="main-header">
        <div class="main-header__nav">
            <h1 class="main-header__title">
                <i class="pe-7f-home"></i>
                <span>流量方案</span>
            </h1>
            <ul class="main-header__breadcrumb">

            </ul>
        </div>
    </header>
@stop

@section('container')
    <div class="row">
        <div class="col-md-12">
            <article class="widget">
                <header class="widget__header">
                    <div class="widget__title">
                        <i class="pe-7s-display2"></i><h3>方案</h3>
                    </div>
                    <div class="widget__config">
                        <a href="/admin/plan/create"><i class="pe-7f-plus"></i></a>
                        <a href="#"><i class="pe-7s-close"></i></a>
                    </div>
                </header>

                <div class="widget__content table-responsive">

                    <table class="table table-striped media-table">
                        <thead>
                        <tr>
                            <th width="40">名称</th>
                            <th width="40">每日流量(M)</th>
                            <th width="50">每月流量(M)</th>
                            <th width="50">同时登录</th>
                            <th width="300">操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($plans as $plan)
                            <tr class="spacer"></tr>
                            <tr>
                                <td>{{$plan['groupname']}}</td>
                                <td>{{array_get($plan,'detail.daily')}}</td>
                                <td>{{array_get($plan,'detail.monthly')}}</td>
                                <td>{{array_get($plan,'detail.simultaneous')}}</td>
                                <td>
                                    <button class="btn green fixed" onclick="update('{{$plan['groupname']}}')">编辑</button>
                                    <button class="btn red fixed" onclick="destroy('{{$plan['groupname']}}')">删除</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </article>
        </div>
    </div>
@stop


@section('scripts')
    <script>
        function destroy(name){
            $.post("/admin/plan/delete",{
                _token : "{{csrf_token()}}",
                name : name
            },function(res){
                if(res.ret) location.reload(); else alert(res.error);
            },'json')
        }
        function update(name) {
            location.href = "/admin/plan/"+name+'/edit';
        }
    </script>
@stop