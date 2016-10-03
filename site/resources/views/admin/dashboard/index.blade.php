@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Dashboard
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link href="{{ asset('assets/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="all" href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/only_dashboard.css') }}" />
<!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Welcome to Ykings Dashboard</h1>
    <ol class="breadcrumb">
        <li class="active">
            <a href="#"> <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                Home
            </a>
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="lightbluebg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 text-right">
                                <span>Activities Today</span>
                                <div class="number" id="myTargetElement1"></div>
                            </div> <i class="livicon  pull-right" data-name="eye-open" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <small class="stat-label">Last Week</small>
                                <h4 id="myTargetElement1.1"></h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <small class="stat-label">Last Month</small>
                                <h4 id="myTargetElement1.2"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
            <!-- Trans label pie charts strats here-->
            <div class="redbg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 pull-left">
                                <span>Active Users Today</span>
                                <div class="number" id="myTargetElement2"></div>
                            </div>                            
                            <i class="livicon pull-right" data-name="user" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <small class="stat-label">Last Week</small>
                                <h4 id="myTargetElement2.1"></h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <small class="stat-label">Last Month</small>
                                <h4 id="myTargetElement2.2"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 margin_10 animated fadeInDownBig">
            <!-- Trans label pie charts strats here-->
            <div class="goldbg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 pull-left">
                                <span>Subscribers</span>
                                <div class="number" id="myTargetElement3"></div>
                            </div>
                            <i class="livicon pull-right" data-name="archive-add" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <small class="stat-label">Last Week</small>
                                <h4 id="myTargetElement3.1"></h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <small class="stat-label">Last Month</small>
                                <h4 id="myTargetElement3.2"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
            <!-- Trans label pie charts strats here-->
            <div class="palebluecolorbg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 pull-left">
                                <span>Registered Users</span>
                                <div class="number" id="myTargetElement4"></div>
                            </div>
                            <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <small class="stat-label">Last Week</small>
                                <h4 id="myTargetElement4.1"></h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <small class="stat-label">Last Month</small>
                                <h4 id="myTargetElement4.2"></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/row-->
    <div class="row ">
        <div class="col-md-8 col-sm-6">
            <div class="panel panel-border">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="dashboard" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14"></i>
                        Realtime Server Load
                        <small>- Load on the Server</small>
                    </h3>
                </div>
                <div class="panel-body">
                    <div id="realtimechart" style="height:330px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="panel blue_gradiant_bg">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="linechart" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Server Stats
                        <small class="white-text">- Monthly Report</small>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="sparkline-chart">
                                <div class="number" id="sparkline_bar"></div>
                                <h3 class="title">Network</h3>
                            </div>
                        </div>
                        <div class="margin-bottom-10 visible-sm"></div>
                        <div class="margin-bottom-10 visible-sm"></div>
                        <div class="col-sm-6">
                            <div class="sparkline-chart">
                                <div class="number" id="sparkline_line"></div>
                                <h3 class="title">Load Rate</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!--  todolist-->
<script src="{{ asset('assets/js/todolist.js') }}"></script>
<!-- EASY PIE CHART JS -->
<script src="{{ asset('assets/vendors/charts/easypiechart.min.js') }}"></script>
<script src="{{ asset('assets/vendors/charts/jquery.easypiechart.min.js') }}"></script>
<!--for calendar-->
<script src="{{ asset('assets/vendors/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/fullcalendar/calendarcustom.min.js') }}" type="text/javascript"></script>
<!--   Realtime Server Load  -->
<script src="{{ asset('assets/vendors/charts/jquery.flot.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/charts/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
<!--Sparkline Chart-->
<script src="{{ asset('assets/vendors/charts/jquery.sparkline.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/countUp/countUp.js') }}"></script>
<!--   maps -->
<script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.js') }}" type="text/javascript"></script>
<!-- end of page level js -->
<script type="text/javascript">
$(document).ready(function() {
    var composeHeight = $('#calendar').height() + 21 - $('.adds').height();
    $('.list_of_items').slimScroll({
        color: '#A9B6BC',
        height: composeHeight + 'px',
        size: '5px'
    });
});

var options = {
    useEasing: false,
    useGrouping: false,
    separator: ',',
    decimal: '.'
};

var demo = new countUp("myTargetElement1", 0, {{$activities['last_day']}}, 0, 6, options);
demo.start();
var demo = new countUp("myTargetElement1.1", 0, {{$activities['last_week']}}, 0, 6, options);
demo.start();
var demo = new countUp("myTargetElement1.2", 0, {{$activities['last_month']}}, 0, 6, options);
demo.start();

var demo = new countUp("myTargetElement2", 0, {{$activeUsers['last_day']}}, 0, 6, options);
demo.start();
var demo = new countUp("myTargetElement2.1", 0, {{$activeUsers['last_week']}}, 0, 6, options);
demo.start();
var demo = new countUp("myTargetElement2.2", 0, {{$activeUsers['last_month']}}, 0, 6, options);
demo.start();

var demo = new countUp("myTargetElement3", 0, {{$subscriptions['last_day']}}, 0, 6, options);
demo.start();
var demo = new countUp("myTargetElement3.1", 0, {{$subscriptions['last_week']}}, 0, 6, options);
demo.start();
var demo = new countUp("myTargetElement3.2", 0, {{$subscriptions['last_month']}}, 0, 6, options);
demo.start();

var demo = new countUp("myTargetElement4", 0, {{$registeredUsers['last_day']}}, 0, 6, options);
demo.start();
var demo = new countUp("myTargetElement4.1", 0, {{$registeredUsers['last_week']}}, 0, 6, options);
demo.start();
var demo = new countUp("myTargetElement4.2", 0, {{$registeredUsers['last_month']}}, 0, 6, options);
demo.start();
</script>
@stop