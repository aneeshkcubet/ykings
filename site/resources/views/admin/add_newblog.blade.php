@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Add New Blog
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link rel="stylesheet" href="{{ asset('assets/css/pages/blog.css') }}" />
<link href="{{ asset('assets/vendors/bootstrap-wysihtml5-rails-b3/src/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />
<!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <!--section starts-->
    <h1>Add new blog</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                Home
            </a>
        </li>
        <li>
            <a href="#">Blog</a>
        </li>
        <li class="active">Add new blog</li>
    </ol>
</section>
<!--section ends-->
<section class="content paddingleft_right15">
    <!--main content-->
    <div class="row">
        <div class="the-box no-border">
            <form role="form">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" placeholder="Post title here..."></div>
                        <div class='box-body pad'>
                            <form>
                                <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </form>
                        </div>
                    </div>
                    <!-- /.col-sm-8 -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Post category</label>
                            <input type="text" class="form-control" placeholder="Post category"></div>
                        <div class="form-group">
                            <label>Post date</label>
                            <input type="text" class="form-control datepicker" data-date-format="mm-dd-yy" placeholder="mm-dd-yy"></div>
                        <div class="form-group">
                            <label>Post author</label>
                            <input type="text" class="form-control" placeholder="Post author"></div>
                        <div class="form-group">
                            <label>Featured image</label>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-primary btn-file">
                                    <span class="fileupload-new">Select file</span>
                                    <span class="fileupload-exists">Change</span>
                                    <input type="file" />
                                </span>
                                <span class="fileupload-preview"></span>
                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Save and post</button>
                            <button class="btn btn-danger">Discard</button>
                        </div>
                    </div>
                    <!-- /.col-sm-4 --> </div>
                <!-- /.row --> </form>
        </div>
    </div>
    <!--main content ends-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page level js -->
<!--new blog-->
<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/wysihtml5.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/core-b3.js') }}"></script>
<script type="text/javascript">
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.

        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
    </script>
@stop