@extends('layouts.backend')

@section('header')
    <header class="main-header">
        <div class="main-header__nav">
            <h1 class="main-header__title">
                <i class="pe-7f-home"></i>
                <span>管理员</span>
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
                        <i class="pe-7s-display2"></i><h3>管理员</h3>
                    </div>
                    <div class="widget__config">
                        <a href="/admin/operator/create"><i class="pe-7f-plus"></i></a>
                        <a href="#"><i class="pe-7s-close"></i></a>
                    </div>
                </header>

                <div class="widget__content table-responsive">

                    <table class="table table-striped media-table">
                        <thead>
                        <tr>
                            <th width="40">编号</th>
                            <th width="40">邮箱</th>
                            <th width="50">最后登录</th>
                            <th width="300">操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($operators as $operator)
                        <tr class="spacer"></tr>
                        <tr>
                            <td>{{$operator->id}}</td>
                            <td>{{$operator->email}}</td>
                            <td>{{$operator->last_login}}</td>
                            <td>
                                <button class="btn red fixed">删除</button>
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
@stop