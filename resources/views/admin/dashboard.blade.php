@extends('layouts.admin2')

@section('content')

    <div id="page-wrapper">
        <div class="main-page">
            <div class="col_3">
                <div class="col-md-3 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-dollar icon-rounded"></i>
                        <div class="stats">
                            <h5><strong>${{$order_stats['total_revenue']}}</strong></h5>
                            <span>Total Revenue</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                        <div class="stats">
                            <h5><strong>{{$order_stats['pending']}}</strong></h5>
                            <span>Orders Not Shipped</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 widget widget1">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-laptop user1 icon-rounded"></i>
                        <div class="stats">
                            <h5><strong>{{$order_stats['complete']}}</strong></h5>
                            <span>Orders Completed</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 widget">
                    <div class="r3_counter_box">
                        <i class="pull-left fa fa-users dollar2 icon-rounded"></i>
                        <div class="stats">
                            <h5><strong>{{$user_count}}</strong></h5>
                            <span>Total Users</span>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>

            <div class="row-one widgettable">
                <div class="col-md-9 content-top-2 card">
                    <div class="agileinfo-cdr">
                        <div class="card-header">
                            <h3>Daily Sales</h3>
                        </div>

                        <div id="Linegraph" style="width: 98%; height: 350px">
                        </div>

                    </div>
                </div>

            </div>


        </div>
    </div>

    <!-- for amcharts js -->
    <script src="{{URL::to('admin_files/js/amcharts.js')}}"></script>
    <script src="{{URL::to('admin_files/js/serial.js')}}"></script>
    <script src="{{URL::to('admin_files/js/export.min.js')}}"></script>
    <link rel="stylesheet" href="{{URL::to('admin_files/css/export.css')}}" media="all">
    <script src="{{URL::to('admin_files/js/light.js')}}"></script>
    <!-- for amcharts js -->

    <script  src="{{URL::to('admin_files/js/index1.js')}}"></script>


    <!-- //pie-chart --><!-- index page sales reviews visitors pie chart -->

    <script src="{{URL::to('admin_files/js/Chart.bundle.js')}}"></script>
    <script src="{{URL::to('admin_files/js/utils.js')}}"></script>

    <!-- new added graphs chart js-->


    <!-- for index page weekly sales java script -->
    <script src="{{URL::to('admin_files/js/SimpleChart.js')}}"></script>
    <script>
        var graphdata1 = {
            linecolor: "#CCA300",
            title: "Monday",
            values: [
                @foreach($sales_chart as $date)
                {Y: {{$date['Y']}}, X: "{{$date['X']}}" },
                @endforeach

            ]
        };

        $(function () {

            $("#Linegraph").SimpleChart({
                ChartType: "Line",
                toolwidth: "50",
                toolheight: "25",
                axiscolor: "#E6E6E6",
                textcolor: "#6E6E6E",
                showlegends: false,
                data: [graphdata1],
                legendsize: "140",
                legendposition: 'bottom',
                xaxislabel: 'Days',
                title: 'Daily Revenue',
                yaxislabel: 'Revenue in $'
            });

        });

    </script>
    <!-- //for index page weekly sales java script -->

@endsection