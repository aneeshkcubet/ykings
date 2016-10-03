@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit Settings
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
    <h1>Edit Settings</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li class="active">Edit Settings</li>
        
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                         
                    </h3>
                    <span class="pull-right clickable">
                        <i class="glyphicon glyphicon-chevron-up"></i>
                    </span>
                </div>
                <div class="panel-body">

                    <!--main content-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN FORM WIZARD WITH VALIDATION -->
                            <form class="form-wizard form-horizontal" action="{{ route('admin.settings.postedit') }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <!-- first tab -->
                                <h1>Settings</h1>

                                <section>
                                    @if(isset($settings))
                                    @foreach($settings as $setting)
                                    <div class="form-group">
                                        <label for="name" class="col-sm-4 control-label">{{$setting->name}} *</label>
                                        <div class="col-sm-8">
                                            <input id="{{$setting->key}}" name="{{$setting->key}}" type="text" placeholder="{{$setting->name}}" class="form-control required @if($setting->type == 'number') number @endif" value="{{{ Input::old($setting->key,$setting->value) }}}" />
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="col-sm-12"><p style="text-align: center">No Setting found!!</p></div>
                                    @endif
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
@stop