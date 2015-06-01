@extends('layouts.profile')

@section('container')
    <div class="row">
        <div class="col-md-7">
            <article class="widget">
                <header class="widget__header">
                    <div class="widget__title full-width">
                        <i class="pe-7s-menu"></i><h3>使用情况</h3>
                    </div>
                </header>

                <div class="widget__content table-responsive">

                    <table class="table table-striped media-table">
                        <thead>
                        <tr>
                            <th width="50">周期</th>
                            <th width="50">总共</th>
                            <th width="50">使用</th>
                            <th width="50">剩余</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr class="spacer"></tr>
                        <tr>
                            <td>今日</td>
                            <td>{{$total['daily']}} M</td>
                            <td>{{$used['today']}} M</td>
                            <td>{{$total['daily'] - $used['today']}} M</td>
                        </tr>
                        <tr class="spacer"></tr>
                        <tr>
                            <td>本月</td>
                            <td>{{$total['monthly']}} M</td>
                            <td>{{$used['month']}} M</td>
                            <td>{{$total['monthly'] - $used['month']}} M</td>
                        </tr>
                        </tbody>
                    </table>



                </div>

            </article>
        </div>
    </div>




    <div class="row">

        <div class="col-md-12">
            <article class="widget">
                <header class="widget__header">
                    <div class="widget__title">
                        <i class="pe-7f-graph3"></i><h3>Statistics</h3>
                    </div>
                    <div class="widget__config">
                        <a href="#"><i class="pe-7f-refresh"></i></a>
                        <a href="#"><i class="pe-7s-close"></i></a>
                    </div>
                </header>

                <div class="widget__content filled">
                    <p class="graph-number"><span>6,184</span> Visits</p>
                    <div id="chartdiv" style="width: 100%; height: 362px;"></div>

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