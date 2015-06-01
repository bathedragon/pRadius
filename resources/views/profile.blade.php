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
                        <i class="pe-7f-graph3"></i><h3>本月使用流量</h3>
                    </div>
                    <div class="widget__config">
                        <a href="#"><i class="pe-7f-refresh"></i></a>
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

    var chartData = JSON.parse('{!!json_encode($graph)!!}');
    var lineChartData = [];
    for(var i in chartData) {
        lineChartData.push({
            date : i,
            uploads : chartData[i][0],
            downloads : chartData[i][1]
        });
    }

    AmCharts.ready(function () {
        var chart = new AmCharts.AmSerialChart();
        chart.dataProvider = lineChartData;
        chart.categoryField = "date";
        chart.dataDateFormat = "YYYY-MM-DD";
        chart.fontFamily = "Arial";

        chart.autoMargins = false;
        chart.marginRight = 0;
        chart.marginLeft = 40;
        chart.marginBottom = 30;
        chart.marginTop = 40;
        chart.colors = ['#f00'];

        // AXES
        // category
        var categoryAxis = chart.categoryAxis;
        categoryAxis.parseDates = true;
        categoryAxis.minPeriod = "DD";
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

        // downloads
        var graph = new AmCharts.AmGraph();
        graph.type = "smoothedLine";
        graph.valueField = "downloads";
        graph.lineColor = "#53d769";
        graph.lineThickness = 3;
        graph.bullet = "round";
        //graph.bulletColor = "rgba(0,0,0,0.3)";
        graph.bulletBorderColor = "#53d769";
        graph.bulletBorderAlpha = 1;
        graph.bulletBorderThickness = 3;
        graph.bulletSize = 6;
        graph.fillAlphas = 0.2;
        graph.fillColorsField = "#53d769";
        chart.addGraph(graph);

        // uploads
        var graph1 = new AmCharts.AmGraph();
        graph1.type = "smoothedLine";
        graph1.valueField = "uploads";
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
</script>
@stop