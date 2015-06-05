@extends('layouts.backend')

@section('header')
    <header class="main-header">
        <div class="main-header__nav">
            <h1 class="main-header__title">
                <i class="pe-7f-home"></i>
                <span>使用排行</span>
            </h1>
            <ul class="main-header__breadcrumb">

            </ul>
        </div>
    </header>
@stop

@section('container')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <article class="widget">
                <div class="widget__content filled widget-ui">
                    <div class="row">
                        <div class="col-md-6 text-center btn-vars__showcase">
                            <div class="btn-group block">
                                <a type="button" class="filter btn orange" data-type="period" data-value="lastWeek">近7天</a>
                                <a type="button" class="filter btn red" data-type="period" data-value="thisMonth">本月</a>
                                <a type="button" class="filter btn yellow" data-type="period" data-value="lastThreeMonth">近3月</a>
                                <a type="button" class="filter btn green" data-type="period" data-value="thisYear">今年</a>
                            </div>
                        </div>
                        <div class="col-md-6 text-center btn-vars__showcase">
                            <div class="btn-group block">
                                <a type="button" class="filter btn green" data-type="order" data-value="time">时间排序</a>
                                <a type="button" class="filter btn green" data-type="order" data-value="traffic">流量排序</a>
                            </div>
                            <div class="btn-group block">
                                <a type="button" class="filter btn orange" data-type="take" data-value="5">5条记录</a>
                                <a type="button" class="filter btn red" data-type="take" data-value="20">20条记录</a>
                                <a type="button" class="filter btn yellow" data-type="take" data-value="50">50条记录</a>
                                <a type="button" class="filter btn green" data-type="take" data-value="10000">全部</a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <article class="widget">
                <div class="widget__content table-responsive">
                    <table class="table table-striped media-table">
                        <thead>
                        <tr>
                            <th width="50">用户名</th>
                            <th width="80">开始时间</th>
                            <th width="50">结束时间</th>
                            <th width="80">总用时</th>
                            <th width="200">流量</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            <tr class="spacer m-{{$row->radacctid}}"></tr>
                            <tr class="m-{{$row->radacctid}}">
                                <td>{{$row->username}}</td>
                                <td>{{$row->acctstarttime}}</td>
                                <td>{{$row->acctstoptime}}</td>
                                <td>{{time2str($row->time)}}</td>
                                <td>
                                    上传:{{toxbyte($row->upload)}}<br>
                                    下载:{{toxbyte($row->download)}}<br>
                                    总计:{{toxbyte($row->upload + $row->download)}}<br>
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
        var period = "{{$period}}", order = "{{$order}}", take = "{{$take}}";
        $("a.filter[data-value='{{$period}}'],a.filter[data-value='{{$order}}'],a.filter[data-value='{{$take}}']").addClass('inverse');
        $(".filter").on("click",function(){
            var type = $(this).data("type"),val = $(this).data("value");
            switch (type) {
                case 'period':
                        period = val;
                    break;
                case 'order':
                        order = val;
                    break;
                case 'take':
                        take = val;
                    break;
            }
            location.href = "/admin/report/top?period="+period+"&order="+order+"&take="+take;
        })
    })
</script>
@stop