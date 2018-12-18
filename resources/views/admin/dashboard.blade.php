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
                <div class="col-md-4 card">
                    <div class="profit-loss clearfix">
                        <div class="clearfix">
                            <div class="pull-left clearfix">
                                <h4 class="bold">Profit & Loss</h4>
                            </div>
                            <div class="input-group pull-right clearfix">
                                <div>
                                    <p class="dropdown-toggle netincome-dropdown" data-toggle="dropdown"><span class="netincome-menu-type">Last month</span> <span class="caret"></span></p>
                                    <ul class="dropdown-menu dropdown-menu-left">
                                        <li class="lastmonth netincome-menu-item">Last Month</li>
                                        <li class="thirtydays netincome-menu-item">Last 30 Days</li>
                                        <li class="ytd netincome-menu-item">Year To Date</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="mt-20">
                            <h3 class="netincome"></h3>
                            <p class="net-income-msg"></p>
                        </div>

                        <div class="row mt-30">
                            <div class="col-md-3 col-sm-3">
                                <div class="income-line">
                                    <p class="bold no-margin-top no-margin-bottom income-value"></p>
                                    <p>Income</p>
                                </div>
                                <div class="expense-line">
                                    <p class="bold no-margin-top no-margin-bottom expense-value"></p>
                                    <p>Expenses</p>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-9">
                                <div class="progress income-progress">

                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                             aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                            <span class="income"></span>
                                        </div>



                                </div>
                                <div class="progress expense-progress">

                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40"
                                         aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                        <span class="expenses"></span>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>

                {{--<div class="col-md-9 content-top-2 card">--}}
                    {{--<div class="agileinfo-cdr">--}}
                        {{--<div class="card-header">--}}
                            {{--<h3>Daily Sales</h3>--}}
                        {{--</div>--}}

                        {{--<div id="Linegraph" style="width: 98%; height: 350px">--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}

            </div>


        </div>
    </div>

    <script>
        $(document).ready(function(){
            $.ajax({
                url: "/admin/reports/netincome",
                type: "post",
                data: {filter: "lastmonth"}
            }).done(function(cb){

                var net,
                    incomePct,
                    expensePct;
                var valueMax = ( parseFloat(cb.income)+parseFloat(cb.expense) );
                if ( parseFloat(cb.income) === 0.00){
                    incomePct = 0;
                } else {
                    incomePct = ( (parseFloat(cb.income) / valueMax) * 100 );
                }

                if ( parseFloat(cb.expense) === 0.00){
                    expensePct = 0;
                } else {
                    expensePct = ( (parseFloat(cb.expense) / valueMax) * 100);
                }


                if (parseFloat(cb.net) < 0.00){
                    net = "<span style='color:red;'>"+cb.net+"</span>";
                } else {
                    net = "<span style='color:black;'>"+cb.net+"</span>";
                }
                $(".net-income-msg").text(cb.message);
                $(".netincome").html(net);
                $(".progress-bar").attr("aria-valuemax", valueMax);
                $(".income").parent().attr("aria-valuenow", cb.income).css("width", incomePct+"%");
                $(".expenses").parent().attr("aria-valuenow", cb.expense).css("width", expensePct+"%");
                $(".income").text("$"+cb.income+"");
                $(".income-value").text("$"+Math.ceil(parseFloat(cb.income)));
                $(".expense-value").text("$"+Math.ceil(parseFloat(cb.expense)));
                $(".expenses").text("$"+cb.expense+"");
            });
        });

    </script>

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
                {Y: "{{$date['Y']}}", X: "{{$date['X']}}" },
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