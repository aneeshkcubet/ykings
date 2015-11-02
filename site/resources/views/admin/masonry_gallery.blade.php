@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Masonry Gallery
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link href="{{ asset('assets/vendors/gallery/animated-masonry-gallery.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/gallery/basic/source/jquery.fancybox.css?v=2.1.5') }}" media="screen" />
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Masonry Gallery</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                Home
            </a>
        </li>
        <li>
            <a href="#">Gallery</a>
        </li>
        <li class="active">Masonry Gallery</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="content gallery">
        <div class="row" id="slim">
            <div id="gallery">
                <div class="col-md-5 col-xs-12" id="gallery-header-center-left-title">All Galleries</div>
                <div class="pull-right">
                    <div class="col-xs-12">
                        <button type="button" id="filter-all" class="btn btn-responsive btn-info btn-xs">All</button>
                        <button type="button" id="filter-studio" class="btn btn-responsive btn-primary btn-xs">Studio</button>
                        <button type="button" id="filter-landscape" class="btn btn-responsive btn-success btn-xs">Landscape</button>
                    </div>
                </div>
                <div id="gallery-content">
                    <div class="row" id="gallery-content-center">
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x192/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x385/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x162/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x192/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>

                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x216/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x190/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x206/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>

                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x288/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x192/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x133/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>

                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x162/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x481/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x481/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x481/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>

                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x269/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x180/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x173/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x173/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>

                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x173/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x173/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x173/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x202/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x192/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x192/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x193/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x192/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>

                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x192/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x192/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x192/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x216/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x216/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x216/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699-green.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x217/#6CC66C:#fff" class="img-responsive all landscape" alt="gallery"></a>
                        <a class="fancybox img-responsive" href="{{ asset('assets/img/img_holder/400-x-699.jpg') }}" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
                            <img data-src="holder.js/288x192/#418bca:#fff" class="img-responsive all studio" alt="gallery"></a>
                    </div>
                </div>
                <!-- .images-box --> </div>
        </div>
    </div>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page level js -->
<script type="text/javascript" src="{{ asset('assets/vendors/gallery/jquery.isotope.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/gallery/animated-masonry-gallery.js') }}"></script>
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="{{ asset('assets/vendors/gallery/basic/source/jquery.fancybox.js?v=2.1.5') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.fancybox').fancybox();
    });
    </script>
@stop