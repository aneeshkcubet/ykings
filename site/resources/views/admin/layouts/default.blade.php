<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>
            @section('title')
            | Ykings
            @show
        </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- global css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="{{ asset('assets/vendors/font-awesome-4.2.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/styles/black.css') }}" rel="stylesheet" type="text/css" id="colorscheme" />
        <link rel="stylesheet" href="{{ asset('assets/css/panel.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/metisMenu.css') }}" />

        <!-- end of global css -->
        <!--page level css-->
        @yield('header_styles')
        <!--end of page level css-->
    </head>

    <body class="skin-josh">
        <header class="header">
            <a href="{{ route('admin.index') }}" class="logo">
                <img width="75" src="{{ asset('assets/img/logo.png') }}" alt="logo">
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <div>
                    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                        <div class="responsive_nav"></div>
                    </a>
                </div>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{{ url('/').'/uploads/images/profile/small/'.$user['profile'][0]['image'] }}}" width="35" class="img-circle img-responsive pull-left" height="35" alt="riot">
                                <div class="riot">
                                    <div>
                                        {{ $user['profile'][0]['first_name'] }}
                                        <span>
                                            <i class="caret"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="{{{ url('/').'/uploads/images/profile/small/'.$user['profile'][0]['image'] }}}" class="img-responsive img-circle" alt="User Image">
                                    <p class="topprofiletext">{{ $user['profile'][0]['first_name'] }}</p>
                                </li>
                                <!-- Menu Body -->
                                <li>
                                    <a href="{{ route('admin.user.show', Auth::user()->id) }}">
                                        <i class="livicon" data-name="user" data-s="18"></i>
                                        My Profile
                                    </a>
                                </li>
                                <li role="presentation"></li>
                                <li>
                                    <a href="{{ route('admin.user.update', Auth::user()->id) }}">
                                        <i class="livicon" data-name="gears" data-s="18"></i>
                                        Account Settings
                                    </a>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="{{ route('admin.logout') }}">
                                            <i class="livicon" data-name="sign-out" data-s="18"></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar purplebg">
                    <div class="page-sidebar  sidebar-nav">
                        <div class="nav_icons">
                            <ul class="sidebar_threeicons">
                                <li>
                                    <a href="{{ route('admin.settings.edit') }}">
                                        <i class="livicon" data-name="hammer" title="App settings" data-loop="true" data-color="#42aaca" data-hc="#42aaca" data-s="25"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <!-- BEGIN SIDEBAR MENU -->
                        <ul id="menu" class="page-sidebar-menu">
                            <li {!! (Request::is('admin') ? 'class="active"' : '') !!}>
                                <a href="{{ route('admin.index') }}">
                                    <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                                    <span class="title">Dashboard</span>
                                </a>
                            </li>  
                            <!-- BEGIN USER MENU -->
                            <li>
                                <a href="{{ route('admin.users') }}">
                                    <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                    <span class="title">Users</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li {!! (Request::is('admin.users') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.users') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Users
                                        </a>
                                    </li>
                                    <li {!! (Request::is('admin.user.create') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.user.create') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Add New User
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER MENU -->

                            <!-- BEGIN EXERCISE MENU -->
                            <li>
                                <a href="{{ route('admin.exercises') }}">  <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                    <span class="title">Exercises</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li {!! (Request::is('admin.exercises') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.exercises') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Exercises
                                        </a>
                                    </li>
                                    <li {!! (Request::is('admin.exercise.create') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.exercise.create') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Add New Exercise
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END EXERCISE MENU -->
                            <!-- BEGIN HIIT MENU -->
                            <li>
                                <a href="{{ route('admin.hiits') }}">  <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                    <span class="title">HIIT</span>                                    
                                </a>
                            </li>
                            <!-- END HIIT MENU -->

                            <!-- BEGIN WORKOUT MENU -->
                            <li>
                                <a href="{{ route('admin.workouts') }}"> <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                    <span class="title">Workouts</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li {!! (Request::is('admin.workouts') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.workouts') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Workouts
                                        </a>
                                    </li>
                                    <li {!! (Request::is('admin.workout.create') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.workout.create') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Add New Workout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END WORKOUT MENU -->

                            <!-- BEGIN SKILL MENU -->
                            <li>
                                <a href="{{ route('admin.skills') }}">  <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                    <span class="title">Skills</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li {!! (Request::is('admin.skills') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.skills') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Skills
                                        </a>
                                    </li>
                                    <li {!! (Request::is('admin.skill.create') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.skill.create') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Add New Skill
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END SKILL MENU -->
                            <!-- BEGIN FEED MENU -->
                            <li>
                                <a href="{{ route('admin.feeds') }}">  <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                    <span class="title">Feeds</span>
                                </a>
                            </li>
                            <!-- END FEED MENU -->
                            <!-- BEGIN COACH MENU -->
                            <li>
                                <a href="{{ route('admin.coaches') }}">  <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                    <span class="title">Coaches</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li {!! (Request::is('admin.coaches') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.coaches') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Coaches
                                        </a>
                                    </li>
                                    <li {!! (Request::is('admin.warmups') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.warmups') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Manage Warmup
                                        </a>
                                    </li>
                                    <li {!! (Request::is('admin.warmup.create') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.warmup.create') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Add New Warmup
                                        </a>
                                    </li>
                                    <li {!! (Request::is('admin.fundumentals') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.fundumentals') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Manage Fundamentals
                                        </a>
                                    </li>
                                    <li {!! (Request::is('admin.fundumental.create') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.fundumental.create') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Add New Fundamental
                                        </a>
                                    </li>
                                    <li {!! (Request::is('admin.stretchings') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.stretchings') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Manage Stretching
                                        </a>
                                    </li>
                                    <li {!! (Request::is('admin.stretching.create') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.stretching.create') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Add New Stretching
                                        </a>
                                    </li>                                    
                                </ul>
                            </li>
                            <!-- END COACH MENU -->                           

                            <!-- BEGIN NEWSLETTER MENU -->
                            <li>
                                <a href="{{ route('admin.newsletters') }}">  <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                    <span class="title">Newsletters</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li {!! (Request::is('admin.newsletters') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.newsletters') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Newsletters
                                        </a>
                                    </li>
                                    <li {!! (Request::is('admin.newsletter.create') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.newsletter.create') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Add New Newsletter
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- END NEWSLETTER MENU -->
                            <!-- BEGIN PlAN MENU -->
                            <li>
                                <a href="{{ route('admin.plans') }}">  <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                    <span class="title">Plans</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li {!! (Request::is('admin.plans') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.plans') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Plans
                                        </a>
                                    </li>
                                    <li {!! (Request::is('admin.plan.create') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.plan.create') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Add New Plan
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- BEGIN PlAN MENU -->
                            <li>
                                <a href="{{ route('admin.medias') }}">  <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                    <span class="title">Media</span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li {!! (Request::is('admin.medias') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.medias') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Media
                                        </a>
                                    </li>
                                    <li {!! (Request::is('admin.media.create') ? 'class="active" id="active"' : '') !!}>
                                        <a href="{{ route('admin.media.create') }}">
                                            <i class="fa fa-angle-double-right"></i>
                                            Add New Media
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END MEDIA MENU -->
                            <!-- BEGIN Knowledge MENU -->
                            <li>
                                <a href="{{ route('admin.knowledge.create') }}">  <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                    <span class="title">Add Knowledge Feed</span>                                    
                                </a>
                            </li>
                            <!-- END Knowledge MENU -->
                        </ul>
                        <!-- END SIDEBAR MENU -->
                    </div>
                </section>
            </aside>
            <aside class="right-side">
                <!-- Notifications -->
                @include('notifications')

                <!-- Content -->
                @yield('content')
            </aside>
            <!-- right-side -->
        </div>
        <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top" data-toggle="tooltip" data-placement="left">
            <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
        </a>
        <!-- global js -->
        <script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!--livicons-->
        <script src="{{ asset('assets/vendors/livicons/minified/raphael-min.js') }}"></script>
        <script src="{{ asset('assets/vendors/livicons/minified/livicons-1.4.min.js') }}"></script>
        <script src="{{ asset('assets/js/josh.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/metisMenu.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/vendors/holder-master/holder.js') }}"></script>
        <!-- end of global js -->
        <!-- begin page level js -->
        @yield('footer_scripts')
        <!-- end page level js -->
    </body>
</html>