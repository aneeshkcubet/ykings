@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit Newsletter - {{  $newsletter->subject }}
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/wizard/jquery-steps/css/jquery.steps.css') }}">
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
<!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Edit Newsletter - {{{  $newsletter->subject }}}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.newsletters') }}">Newsletters</a></li>
        <li class="active">Edit: {{{  $newsletter->subject }}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        {{{  $newsletter->subject }}} 
                    </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="panel-body">

                    <!-- errors -->
                    <div class="has-error">
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>

                    <!--main content-->
                    <div class="row">

                        <div class="col-md-12">

                            <!-- BEGIN FORM WIZARD WITH VALIDATION -->
                            <form class="form-horizontal" action="{{ route('admin.newsletter.postcreate') }}" method="POST" id="newsletter-form" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <!-- first tab -->
                                <h1>Send Newsletter</h1>

                                <section>
                                    <div class="form-group">
                                        <div class="col-sm-12">Subject *</div>
                                        <div class="col-sm-12">
                                            <input id="subject" name="subject" type="text" placeholder="Subject" class="form-control" value="{{{ Input::old('subject', $newsletter->subject) }}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">Content *</div>
                                        <div class="col-sm-12">
                                            <textarea name="content" id="content" class="form-control editor">{{{ Input::old('content', $newsletter->content) }}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="button" class="btn btn-primary newsletter-submit" id="newsletter-save">Draft</button>
                                            <button type="button" class="btn btn-primary newsletter-submit" id="newsletter-send">Send</button>
                                        </div>                                        
                                    </div>                                    
                                    <p>(*) Mandatory</p>
                                </section>
                            </form>
                            <!-- END FORM WIZARD WITH VALIDATION --> 
                        </div>
                    </div>
                    <!--main content end--> 
                </div>
            </div>
        </div>
    </div>
    <!--row end-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/vendors/wizard/jquery-steps/js/jquery.steps.js') }}"></script>
<script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/pages/add_user.js') }}"></script>
<script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>

<script type="text/javascript">
tinymce.init({selector: 'textarea.editor',
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons",
    image_advtab: true,
});
</script>
<script type="text/javascript">
    $('.newsletter-submit').bind('click', function (event) {
        if ($(event.target).attr('id') == 'newsletter-save') {
            $('#newsletter-form').attr('action', "{{{route('admin.newsletter.postedit', $newsletter->id)}}}");
        } else {
            $('#newsletter-form').attr('action', "{{{route('admin.newsletter.posteditsend', $newsletter->id)}}}");
        }

        $('#newsletter-form').submit();
    });

</script>
@stop