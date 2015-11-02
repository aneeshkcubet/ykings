@extends('layouts/default')

{{-- Page title --}}
@section('title')
Blog_Item
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
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
                    <a href="#">Blog Item</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="doc-landscape" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> Blog Item
            </div>
        </div>
    </div>
    @stop


{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
    <div class="container">
        <h2 class="primary marl12">Business Deal</h2>
        <div class="row content">
            <!-- Business Deal Section Start -->
            <div class="col-sm-8 col-md-8">
                <div class=" thumbnail featured-post-wide img">
                    <img src="{{ asset('assets/images/bblog4.jpg') }}" class="img-responsive" alt="Image">
                    <!-- /.blog-detail-image -->
                    <div class="the-box no-border blog-detail-content">
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
                        <p class="text-justify">
                            Today I have a business empire the like of which the world has never seen the like of which. I hope it doesn't sound arrogant when I say that I am the greatest man in the world! Shut up, do what I tell you, I'm not interested; these are just some of the things you'll be hearing if you answer this ad. I'm an idiot and I dont care about anyone but myself. P.S. No dogs! When I started Reynholm Industries, I had just two things in my possession: a dream and 6 million pounds. I'm a 32 year old IT-man who works in a basement. Yes, I do the whole Lonely Hearts thing! He's had quite an evening. Someone stole his wheelchair. Did you see who it was? Red bearded man. 0115... no... 0118... no... 0118 999 ... 3. Hello? Is this the emergency services? Then which country am I speaking to? Hello? Hello? You know, it's high tide. But we're not on the coast. I'm closed for maintenance! Closed for maintenance? I've fallen to the communists! Well, they do have some strong arguments.
                        </p>
                        <blockquote>
                            <p>
                                Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science.
                            </p>
                            <small>
                                Someone famous in
                                <cite title="Source Title">Source Title</cite>
                            </small>
                        </blockquote>
                        <h3>Sub heading here</h3>
                        <p class="text-justify">
                            Maecenas blandit odio eget massa feugiat vel pulvinar ante fried. Vivamus sollicitudin, mi quis salty dignissim, elit tortor cursus nunc, nec pulvinar neque ante vitae sapien. In a odio eu est aliquet vulputate. Mauris rhoncus lacus ac sem faucibus sed tempor diam feugiat. Suspendisse potenti. Suspendisse at nisl ante. In dui lectus, posuere ac bibendum in, scelerisque ut nisi. Proin volutpat leo id risus malesuada fried tempus ut dui. Aliquam molestie sem in enim rutrum at auctor neque pretium. Vivamus et risus sed purus varius fried. Nam eget elit in lacus posuere fringilla. Vivamus ac leo id metus luctus varius ac ac nulla.
                        </p>
                        <h3>Sub heading here</h3>
                        <p class="text-justify">
                            Wings foam irish, acerbic redeye coffee, sit organic milk cup saucer. Beans, to go, ristretto id milk et chicory flavour. Affogato, organic strong carajillo qui kopi-luwak to go strong est mazagran. Kopi-luwak americano percolator spoon, aftertaste viennese id affogato brewed lungo. Con panna cinnamon body robust steamed instant eu cortado. Americano, at, wings cup brewed cup single origin froth. That french press mocha half and half, crema carajillo half and half fair trade crema brewed id barista. Java whipped so mazagran aftertaste barista cortado. Trifecta, ristretto cinnamon milk cortado dripper sweet. Strong acerbic medium, est macchiato a, percolator con panna frappuccino grounds variety mazagran. Java percolator qui doppio et cream blue mountain. Affogato, milk caramelization extraction strong, chicory galão coffee as black breve. Viennese, beans rich, decaffeinated lungo shop mug cortado fair trade. A beans blue mountain, americano, arabica, seasonal sweet bar irish café au lait aftertaste espresso. Plunger pot robusta, roast mazagran, latte beans wings mocha cinnamon sweet. Milk whipped, caffeine cinnamon wings aroma cappuccino.
                        </p>
                        <hr>
                    </div>
                </div>
                <!-- /the.box .no-border -->
                <!-- Media left section start -->
                <h3 class="comments">21 Comments</h3><br />
                <ul class="media-list">
                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object " src="{{ asset('assets/images/c1.jpg') }}" width="70" height="70" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">Phil Gibson<span class="pull-right"><a href="#">Reply</a></span></h4>
                            <p>Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science.</p>
                            <ul class="media-list">
                                <li class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object " src="{{ asset('assets/images/image_13.jpg') }}" width="50" height="50" alt="...">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">Ian Anderson<span class="pull-right"><a href="#">Reply</a></span></h4>
                                        <p>Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science.</p>
                                        <ul class="media-list">
                                            <li class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object " src="{{ asset('assets/images/image_14.jpg') }}" width="50" height="50" alt="...">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">Justin Paterson<span class="pull-right"><a href="#">Reply</a></span></h4>
                                                    <p>Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science.</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object " src="{{ asset('assets/images/image_15.jpg') }}" width="50" height="50" alt="...">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                    <h4 class="media-heading">Tracey Paterson<span class="pull-right"><a href="#">Reply</a></span></h4>
                                        <p>Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <nav>
                  <ul class="pagination">
                    <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">2 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">3 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">4 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">5 <span class="sr-only">(current)</span></a></li>
                    <li class="enabled"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                  </ul>
                </nav>
                <!-- //Media left section End -->
                <!-- Comment Section Start -->
                <h3>Leave a Comment</h3>
                <form role="form">
                    <div class="form-group">
                        <input type="text" class="form-control input-lg" placeholder="Your name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control input-lg" placeholder="Your email address">
                    </div>
                    <div class="form-group">
                        <input type="url" class="form-control input-lg" placeholder="Your website">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control input-lg no-resize" rows="8" placeholder="Your comment"></textarea>
                    </div>
                    <div class="form-group">
                        <a href="#" class="btn btn-primary text-white">Submit</a>
                    </div>
                </form>
                <!-- //Comment Section End -->
            </div>
            <!-- //Business Deal Section End -->
            <!-- /.col-sm-9 -->
            <!-- Recent Posts Section Start -->
            <div class="col-sm-4 col-md-4 col-full-width-left">
                <div class="the-box">
                        <h3 class="small-heading text-center">RECENT POSTS</h3>
                        <ul class="media-list media-xs media-dotted">
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img src="{{ asset('assets/images/authors/avatar1.jpg') }}" class="img-circle img-responsive pull-left" alt="riot">
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
                                    <img src="{{ asset('assets/images/authors/avatar4.jpg') }}" class="img-circle img-responsive pull-left" alt="riot">
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
                <!-- /.the-box .bg-primary .no-border .text-center .no-margin -->
            </div>
            <!-- //Recent Posts Section End -->
            <!-- /.col-sm-3 -->
        </div>
    </div>
    <!-- //Conatainer Section End -->
@stop
