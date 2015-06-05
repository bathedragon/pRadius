@extends('layouts.backend')

@section('container')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <article class="widget">
                <div class="widget__content filled widget-ui">
                    <div class="row">
                        <div class="col-md-6 text-center btn-vars__showcase">
                            @foreach($users as $user)
                                <a type="button" class="filter btn white" data-type="username" data-value="{{$user->username}}">{{$user->username}}</a>
                            @endforeach
                            {!!$users->render()!!}
                        </div>
                        <div class="col-md-6 text-center btn-vars__showcase">
                            <div class="btn-group block">
                                <a type="button" class="filter btn green" data-type="type" data-value="login">登录次数</a>
                                <a type="button" class="filter btn green" data-type="type" data-value="upload">上传流量</a>
                                <a type="button" class="filter btn green" data-type="type" data-value="download">下载流量</a>
                            </div>
                            <div class="btn-group block">
                                <a type="button" class="filter btn orange" data-type="period" data-value="daily">每日</a>
                                <a type="button" class="filter btn red" data-type="period" data-value="monthly">每月</a>
                                <a type="button" class="filter btn yellow" data-type="period" data-value="yearly">每年</a>
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
                <header class="widget__header">
                    <div class="widget__title">
                        <i class="pe-7f-graph3"></i><h3>{{$username}} 的 {{$period_label}} {{$type_label}}</h3>
                    </div>
                    <div class="widget__config">
                        <a href="javascript:location.reload();"><i class="pe-7f-refresh"></i></a>
                        <a href="#"><i class="pe-7s-close"></i></a>
                    </div>
                </header>

                <div class="widget__content filled">
                    <div id="chartdiv" style="width: 100%; height: 362px;"></div>

                </div>
            </article>
        </div>


    </div>
@stop

@section('scripts')
    <script>
        var chartData = JSON.parse('{!!json_encode($data)!!}');
        var lineChartData = [];
        for(var i in chartData) {
            lineChartData.push({
                x : chartData[i]['{{$period}}'],
                v : chartData[i]['{{$type}}']
            });
        }
        console.log(lineChartData);

        AmCharts.ready(function () {
            var chart = new AmCharts.AmSerialChart();
            chart.dataProvider = lineChartData;
            chart.categoryField = "x";
            chart.fontFamily = "Arial";

            chart.autoMargins = false;
            chart.marginRight = 0;
            chart.marginLeft = 40;
            chart.marginBottom = 30;
            chart.marginTop = 30;
            chart.colors = ['#f00'];

            // AXES
            // category
            var categoryAxis = chart.categoryAxis;
            categoryAxis.inside = false;
            categoryAxis.gridAlpha = 0;
            categoryAxis.tickLength = 0;
            categoryAxis.axisAlpha = 0.5;
            categoryAxis.fontSize = 9;
            categoryAxis.axisColor = "rgba(255,255,255,0.8)";
            categoryAxis.color = "rgba(255,255,255,0.8)";

            // value
            var valueAxis = new AmCharts.ValueAxis();
            valueAxis.dashLength = 2;
            valueAxis.gridColor = "rgba(255,255,255,0.8)";
            valueAxis.gridAlpha = 0.2;
            valueAxis.axisColor = "rgba(255,255,255,0.8)";
            valueAxis.color = "rgba(255,255,255,0.8)";
            valueAxis.axisAlpha = 0.5;
            valueAxis.fontSize = 9;
            chart.addValueAxis(valueAxis);

            // uploads
            var graph1 = new AmCharts.AmGraph();
            graph1.type = "smoothedLine";
            graph1.valueField = "v";
            graph1.lineColor = "#1c7dfa";
            graph1.lineThickness = 3;
            graph1.bullet = "round";
            //graph1.bulletColor = "rgba(0,0,0,0.3)";
            graph1.bulletBorderColor = "#1c7dfa";
            graph1.bulletBorderAlpha = 1;
            graph1.bulletBorderThickness = 3;
            graph1.bulletSize = 6;
            graph1.fillAlphas = 0.2;
            graph1.fillColorsField = "#1c7dfa";
            chart.addGraph(graph1);


            // CURSOR
            var chartCursor = new AmCharts.ChartCursor();
            chart.addChartCursor(chartCursor);
            chartCursor.categoryBalloonAlpha = 0.2;
            chartCursor.cursorAlpha = 0.2;
            chartCursor.cursorColor = 'rgba(255,255,255,.8)';
            chartCursor.categoryBalloonEnabled = false;

            // WRITE
            chart.write("chartdiv");

        });
        $(document).ready(function(){
            var period = "{{$period}}", type = "{{$type}}",username = "{{$username}}";
            $("a.filter[data-value='{{$period}}'],a.filter[data-value='{{$type}}'],a.filter[data-value='{{$username}}']").addClass('inverse');
            $(".filter").on("click",function(){
                var _type = $(this).data("type"),val = $(this).data("value");

                switch (_type) {
                    case 'period':
                        period = val;
                        break;
                    case 'type':
                        type = val;
                        break;
                    case 'username':
                        username = val;
                        break;
                }
                location.href = "/admin/graph?period="+period+"&type="+type+"&username="+username;
            })
        })
    </script>
@stop