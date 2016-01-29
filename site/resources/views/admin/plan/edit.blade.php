@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit Plan - {{  $plan->name }}
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
    <h1>Edit Plan - {{{  $plan->name }}}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.plans') }}">Plans</a></li>
        <li class="active">Edit: {{{  $plan->name }}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        {{{  $plan->name }}} 
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
                            <form class="form-wizard form-horizontal" action="{{ route('admin.plan.postedit', $plan->id) }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <!-- first tab -->
                                <!-- first tab -->
                                <h1>Plan</h1>

                                <section>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name*</label>
                                        <div class="col-sm-10">
                                            <input id="name" name="name" type="text" placeholder="Name" class="form-control required" value="{{{ Input::old('name', $plan->name) }}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount" class="col-sm-2 control-label">Amount *</label>
                                        <div class="col-sm-3">
                                            <input id="amount" name="amount" type="text" placeholder="Amount" class="form-control required number" value="{{{ Input::old('amount', $plan->amount) }}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="currency" class="col-sm-2 control-label">Currency *</label>
                                        <div class="col-sm-4">                                            
                                            <select id="currency" name="currency" class="form-control required">
                                                @foreach ($currencyCodes as $currencyCode => $name)
                                                <option value="{{ $currencyCode }}" @if(Input::old('currency', $plan->currency) === $currencyCode) selected="selected" @endif>{{$currencyCode}}({{ $name }})</option>
                                                @endforeach             
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="duration" class="col-sm-2 control-label">Duration *</label>
                                        <div class="col-sm-4">                                            
                                            <select id="duration" name="duration" class="form-control required">
                                                @for ($i=1; $i<=12; $i++)
                                                <option value="{{ $i }}" @if(Input::old('duration', $plan->duration) === $i) selected="selected" @endif>{{ $i }} Months</option>
                                                @endfor             
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inapp_id" class="col-sm-2 control-label">App Purchase Id *</label>
                                        <div class="col-sm-10">
                                            <input id="inapp_id" name="inapp_id" type="text" placeholder="App Purchase Id" class="form-control required" value="{{{ Input::old('inapp_id', $plan->inapp_id) }}}" />
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
@stop