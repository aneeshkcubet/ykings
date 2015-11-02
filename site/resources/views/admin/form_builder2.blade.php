@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Form Builder
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('assets/css/pages/formbuilder1.css') }}" />
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <!--section starts-->
    <h1>Form Builder2</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                Home
            </a>
        </li>
        <li>
            <a href="#">Builders</a>
        </li>
        <li class="active">Form Builder2</li>
    </ol>
</section>
<!--section ends-->
<section class="content">
    <!--main content-->
    <div class="row">
        <div class="alert alert-success alert-dismissable visible-xs visible-md">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            May not work properly in touch enabled devices as it as requires drag and drop.
        </div>
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Form Builder
                    </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <!--form builder-->
                    <nav class="navbar navbar-default navbar-fixed navbar-defaults" role="navigation">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">Form Builder</a>
                        </div>
                        <form class="navbar-form navbar-left">
                            <div class="form-group">
                                <select class="form-control" id="n-columns">
                                    <option value="1">1 Column</option>
                                    <option value="2">2 Columns</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger" data-clipboard-text="testing" id="copy-to-clipboard">Copy HTML</button>
                        </form>
                    </nav>
                    <div style="margin-top: -20px;">
                        <div class="row">
                            <div class="col-md-4" style="padding: 0px 30px 30px 30px; background-color: #fff;">
                                <h3>Elements</h3>
                                <form role="form">
                                    <div class="form-group draggable">
                                        <label for="input-text-1">Text Input</label>
                                        <input type="email" class="form-control" id="input-text-1" placeholder="Enter email">
                                        <p class="help-block">Example block-level help text here.</p>
                                    </div>
                                    <div class="form-group draggable">
                                        <label for="input-password-1">Password</label>
                                        <input type="password" class="form-control" id="input-password-1" placeholder="Password">
                                        <p class="help-block">Example block-level help text here.</p>
                                    </div>
                                    <div class="form-group draggable">
                                        <label for="select-1">Select</label>
                                        <select class="form-control" id="select-1">
                                            <option value="Option 1">Option 1</option>
                                            <option value="Option 2">Option 2</option>
                                            <option value="Option 3">Option 3</option>
                                        </select>
                                        <p class="help-block">Example block-level help text here.</p>
                                    </div>
                                    <div class="form-group draggable">
                                        <label for="input-file-1">File input</label>
                                        <input type="file" id="input-file-1">
                                        <p class="help-block">Example block-level help text here.</p>
                                    </div>
                                    <div class="checkbox draggable">
                                        <label>
                                            <input type="checkbox">
                                            <span>Check me out</span>
                                        </label>
                                    </div>
                                    <div class="form-group draggable" style="padding-right: 20px;">
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8" style="padding: 30px;">
                                <div style="background-color: #fff; border-radius: 5px; padding: 20px; 
                                                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175); ">
                                    <div class="text-muted empty-form text-center" style="font-size: 24px;">Drag & Drop elements to build form.</div>
                                    <div class="row form-body">
                                        <div class="col-md-12 droppable sortable"></div>
                                        <div class="col-md-6 droppable sortable" style="display: none;"></div>
                                        <div class="col-md-6 droppable sortable" style="display: none;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--form builder ends--> </div>
            </div>
        </div>
    </div>
    <!--main content ends-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('assets/vendors/form_builder1/js/beautifyhtml.js') }}"></script>
<script src="{{ asset('assets/js/pages/form_builder2.js') }}"></script>
@stop