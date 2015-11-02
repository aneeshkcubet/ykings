@extends('layouts/default')

{{-- Page title --}}
@section('title')
Blog
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/blog.css') }}">
    <!--end of page level css-->
@stop

{{-- breadcrumb --}}
@section('top')
    <div class="breadcum">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Dashboard
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                    <a href="#">Blog</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="edit" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> Blog
            </div>
        </div>
    </div>
    @stop


{{-- Page content --}}
@section('content')
    <!-- Container Section Strat -->
    <div class="container">
        <h2>Blog</h2>
        <div class="row">
            <div class="content">
                <div class="col-md-8">
                    <!-- BEGIN FEATURED POST -->
                    <div class="featured-post-wide thumbnail">
                        <img src="{{ asset('assets/images/bblog4.jpg') }}" class="img-responsive" alt="Image">
                        <div class="featured-text relative-left">
                            <h3 class="primary"><a href="{{ URL::to('blogitem') }}">Business Deal</a></h3>
                            <p>
                                Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science. The early warnings about technological dangers also come from science.
                            </p>
                            <p class="additional-post-wrap">
                                <span class="additional-post">
                                    <i class="livicon" data-name="user" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i> by&nbsp;<a href="#">Admin</a>
                                </span>
                                <span class="additional-post">
                                    <i class="livicon" data-name="clock" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i><a href="#"> 2hours ago</a>
                                </span>
                                <span class="additional-post">
                                    <i class="livicon" data-name="comment" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i><a href="#"> 3 comments</a>
                                </span>
                            </p>
                            <hr>
                            <p class="text-right">
                                <a href="{{ URL::to('blogitem') }}" class="btn btn-primary text-white">Read more</a>
                            </p>
                        </div>
                        <!-- /.featured-text -->
                    </div>
                    <!-- /.featured-post-wide -->
                    <!-- END FEATURED POST -->
                    <!-- BEGIN FEATURED POST -->
                    <div class="featured-post-wide thumbnail">
                        <img src="{{ asset('assets/images/bblog2.jpg') }}" class="img-responsive" alt="Image">
                        <div class="featured-text relative-left">
                            <h3 class="primary"><a href="{{ URL::to('blogitem') }}">Project Discussion</a></h3>
                            <p>
                                Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science. The early warnings about technological dangers also come from science.
                            </p>
                            <p class="additional-post-wrap">
                                <span class="additional-post">
                                    <i class="livicon" data-name="user" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i> by&nbsp;<a href="#">Admin</a>
                                </span>
                                <span class="additional-post">
                                    <i class="livicon" data-name="clock" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i><a href="#"> 5hours ago</a>
                                </span>
                                <span class="additional-post">
                                    <i class="livicon" data-name="comment" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i><a href="#"> 3 comments</a>
                                </span>
                            </p>
                            <hr>
                            <p class="text-right">
                                <a href="{{ URL::to('blogitem') }}" class="btn btn-primary text-white">Read more</a>
                            </p>
                        </div>
                        <!-- /.featured-text -->
                    </div>
                    <!-- /.featured-post-wide -->
                    <!-- END FEATURED POST -->
                    <!-- BEGIN FEATURED POST -->
                    <div class="featured-post-wide thumbnail">
                        <img src="{{ asset('assets/images/bblog3.jpg') }}" class="img-responsive" alt="Image">
                        <div class="featured-text relative-left">
                            <h3 class="primary"><a href="{{ URL::to('blogitem') }}">Client Meeting</a></h3>
                            <p>
                                Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science. The early warnings about technological dangers also come from science.
                            </p>
                            <p class="additional-post-wrap">
                                <span class="additional-post">
                                    <i class="livicon" data-name="user" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i> by&nbsp;<a href="#">Admin</a>
                                </span>
                                <span class="additional-post">
                                    <i class="livicon" data-name="clock" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i><a href="#"> 10hours ago </a>
                                </span>
                                <span class="additional-post">
                                    <i class="livicon" data-name="comment" data-size="13" data-loop="true" data-c="#5bc0de" data-hc="#5bc0de"></i><a href="#"> 3 comments</a>
                                </span>
                            </p>
                            <hr>
                            <p class="text-right">
                                <a href="{{ URL::to('blogitem') }}" class="btn btn-primary text-white">Read more</a>
                            </p>
                        </div>
                        <!-- /.featured-text -->
                    </div>
                    <!-- /.featured-post-wide -->
                    <!-- END FEATURED POST -->
                    <ul class="pager">
                        <li class="previous">
                            <a href="#"><i class="glyphicon glyphicon-arrow-left"></i> Older</a>
                        </li>
                        <li class="next disabled">
                            <a href="#">Newer <i class="glyphicon glyphicon-arrow-right"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- /.col-md-8 -->
                <div class="col-md-4">
                    <!-- END POPULAR POST -->
                    <!-- Tabbable-Panel Start -->
                    <h3 class="martop">TAB WIDGET</h3>
                    <div class="tabbable-panel">
                        <!-- Tabbablw-line Start -->
                        <div class="tabbable-line">
                            <!-- Nav Nav-tabs Start -->
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#tab_default_1" data-toggle="tab">
                                        Popular Posts </a>
                                </li>
                                <li>
                                    <a href="#tab_default_2" data-toggle="tab">
                                        Recent Posts </a>
                                </li>
                            </ul>
                            <!-- //Nav Nav-tabs End -->
                            <!-- Tab-content Start -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1">
                                    <div class="media">
                                        <div class="media-left tab col-sm-6 col-md-12 col-xs-12">
                                            <a href="#">
                                                <img class="media-object img-responsive" src="{{ asset('assets/images/img_3.jpg') }}" alt="image">
                                            </a>
                                        </div>
                                    </div>
                                    <h4 class="text-primary">Jelly-o sesame snaps</h4>
                                    <p>
                                        Extraordinary claims require extraordinary evidence globular star cluster great turbulent clouds dispassionate extraterrestrial observer hearts of the stars. Jean-François Champollion Euclid the sky. 
                                    </p>
                                    <div class="text-right primary marbtm"><a href="#">Read more</a>
                                    </div>
                                    <div class="media">
                                        <div class="media-left tab col-sm-6 col-md-12 col-xs-12">
                                            <a href="#">
                                                <img class="media-object img-responsive" src="{{ asset('assets/images/img_5.jpg') }}" alt="image">
                                            </a>
                                        </div>
                                    </div>
                                    <h4 class="text-primary">Fishing cayenne bisque cayenne</h4>
                                    <p>
                                        The Love Boat soon will be making another run. The Love Boat promises something for everyone. On the most sensational inspirational celebrational Muppetational. This is what we call the Muppet Show.
                                    </p>
                                    <div class="text-right primary"><a href="#">Read more</a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_2">
                                    <div class="media">
                                        <div class="media-left media-middle tab col-sm-12 col-xs-12">
                                            <a href="#">
                                                <img class="media-object img-responsive" src="{{ asset('assets/images/img_5.jpg') }}" alt="image">
                                            </a>
                                        </div>
                                    </div>
                                    <h4 class="text-primary">Come along, Pond. Allons-y</h4>
                                    <p>
                                        Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis. Summus brains sit​​, morbo vel maleficia? De apocalypsi gorger omero undead survivor dictum mauris.
                                    </p>
                                    <div class="text-right primary marbtm"><a href="#">Read more</a>
                                    </div>
                                    <div class="media">
                                        <div class="media-left tab col-sm-6 col-md-12 col-xs-12">
                                            <a href="#">
                                                <img class="media-object img-responsive" src="{{ asset('assets/images/img_3.jpg') }}" alt="image">
                                            </a>
                                        </div>
                                    </div>
                                    <h4 class="text-primary">Jelly-o sesame snaps</h4>
                                    <p>
                                        Hi mindless mortuis soulless creaturas, imo evil stalking monstra adventus resi dentevil vultus comedat cerebella viventium. Qui animated corpse, cricket bat max brucks terribilem incessu zomby.
                                    </p>
                                    <div class="text-right primary"><a href="#">Read more</a>
                                    </div>
                                </div>
                            </div>
                            <!-- //Tab-content End -->
                        </div>
                        <!-- //Tabbablw-line End -->
                    </div>
                    <!-- Tabbable_panel End -->
                    <div class="the-box recent">
                        <h3 class="small-heading text-center">RECENT COMMENTS</h3>
                        <ul class="media-list media-xs media-dotted">
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img src="{{ asset('assets/images/authors/avatar.jpg') }}" class="img-circle img-responsive pull-left" alt="riot">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading primary">
                                                        <a href="#">Elizabeth Owens at Duis autem vel eum iriure dolor in hendrerit in</a>
                                                    </h4>
                                    <p class="date">
                                        <small class="text-danger">2hours ago</small>
                                    </p>
                                    <p class="small">
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo
                                    </p>
                                </div>
                            </li>
                            <hr>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img src="{{ asset('assets/images/authors/avatar1.jpg') }}" class="img-circle img-responsive pull-left" alt="riot">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading primary">
                                                        <a href="#">Harold Chavez at Duis autem vel eum iriure dolor in hendrerit in</a>
                                                    </h4>
                                    <p class="date">
                                        <small class="text-danger">5hours ago</small>
                                    </p>
                                    <p class="small">
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo
                                    </p>
                                </div>
                            </li>
                            <hr>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img src="{{ asset('assets/images/authors/avatar5.jpg') }}" class="img-circle img-responsive pull-left" alt="riot">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading primary">
                                                        <a href="#">Mihaela Cihac at Duis autem vel eum iriure dolor in hendrerit in</a>
                                                    </h4>
                                    <p class="date">
                                        <small class="text-danger">10hours ago</small>
                                    </p>
                                    <p class="small">
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="thumbnail">
                    <h3>TAGS</h3>
                    <div class="primary text-center">
                    <a href="#" class="text-primary">CSS</a>,
                    <a href="#" >HTML</a>,
                    <a href="#" class="primary">BOOTSTRAP</a>,
                    <a href="#" class="primary">PHOTOSHOP</a>,
                    <a href="#" class="primary">JQUERY</a>,
                    </div>
                    </div>
                </div>
                <!-- /.col-md-4 -->
            </div>
        </div>
    </div>
    
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
