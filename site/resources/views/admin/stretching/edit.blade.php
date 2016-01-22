@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit Stretching - {{  $stretching->exercise_id }}
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
    <h1>Edit Stretching - {{{  $stretching->exercise_id }}}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.stretchings') }}">Stretchings</a></li>
        <li class="active">Edit: {{{  $stretching->exercise_id }}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        {{{  $stretching->exercise_id }}} 
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
                            <form class="form-wizard form-horizontal" action="{{ route('admin.stretching.postedit', $stretching->id) }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <!-- first tab -->
                                <!-- first tab -->
                                <h1>Stretching</h1>

                                <section>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name*</label>
                                        <div class="col-sm-10">
                                            <input id="name" name="name" type="text" placeholder="Name" class="form-control required" value="{{{ Input::old('name',$stretching->exercise_id) }}}" />
                                        </div>
                                    </div>                                  

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Repitition / Duration *</label>

                                        <?php $durationArray = json_decode($stretching->duration, true); ?>
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="minimum" name="duration[min]" value="{{Input::old('duration[min]', $durationArray['min'])}}" class="form-control required number" />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="maximum" name="duration[max]" value="{{Input::old('duration[max]', $durationArray['max'])}}" class="form-control number" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="unit" class="col-sm-2 control-label">Unit *</label>
                                        <div class="col-sm-3">
                                            <select id="unit" name="unit" class="form-control required">
                                                <option value="">Select unit</option>
                                                <option value="times" @if(Input::old('unit', $stretching->unit) == "times") selected="selected" @endif>Repetitions</option>
                                                <option value="seconds" @if(Input::old('unit', $stretching->unit) == "seconds") selected="selected" @endif>Seconds</option>                                                
                                            </select>                                            
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