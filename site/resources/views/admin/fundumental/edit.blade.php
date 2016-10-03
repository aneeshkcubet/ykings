@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit Fundumental - {{  $fundumental['exercise']->name }}
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
    <h1>Edit Fundumental - {{{  $fundumental['exercise']->name }}}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li><a href="{{ route('admin.fundumentals') }}">Fundumentals</a></li>
        <li class="active">Edit: {{{  $fundumental['exercise']->name }}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <i class="livicon" data-name="users" data-size="16" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                        {{{  $fundumental['exercise']->name }}} 
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
                            <form class="form-wizard form-horizontal" action="{{ route('admin.fundumental.postedit', $fundumental->id) }}" method="POST" id="wizard" enctype="multipart/form-data">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <!-- first tab -->
                                <!-- first tab -->
                                <h1>Fundumental</h1>

                                <section>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="exercise_id">Select Exercise *</label>
                                        <div class="col-sm-4">
                                            <select id="exercise_id" name="exercise_id" class="form-control required">
                                                @foreach ($exercises as $mKey => $exercise)
                                                <option @if(Input::old('exercise_id', $fundumental->exercise_id) == $exercise->id) selected="selected" @endif value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                                                @endforeach                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="exercise_id">Select Group *</label>
                                        <div class="col-sm-4">
                                            <select id="exercise_id" name="row" class="form-control required">
                                                @for ($i=1; $i<=5; $i++)
                                                <option value="{{$i}}" @if(Input::old('row', $fundumental->row)== $i) selected="" @endif>{{$i}}</option>
                                                @endfor                                              
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Repitition / Duration *</label>
                                        <div class="col-sm-5" style="text-align: center">
                                            <strong>Beginner</strong>
                                        </div>
                                        <div class="col-sm-5" style="text-align: center">
                                            <strong>Advanced</strong>                                                
                                        </div>
                                        <?php $durationArray = json_decode($fundumental->duration, true); ?>
                                        <div class="col-sm-5">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="minimum" name="duration[1][min]" value="{{Input::old('duration[beginner][min]', $durationArray[1]['min'])}}" class="form-control required number" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="maximum" name="duration[1][max]" value="{{Input::old('duration[beginner][max]', $durationArray[1]['max'])}}" class="form-control number" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="minimum" name="duration[2][min]" value="{{Input::old('duration[advanced][min]', $durationArray[2]['min'])}}" class="form-control required number" />
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="maximum" name="duration[2][max]" value="{{Input::old('duration[advanced][max]', $durationArray[2]['max'])}}" class="form-control number" />
                                                </div>
                                            </div>
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