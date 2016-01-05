@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
View User Details
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<!--page level css -->
<link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/pages/user_profile.css') }}" rel="stylesheet" type="text/css"/>
<!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>View User</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Users</li>
        <li class="active">View User</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav  nav-tabs ">
                <li class="active">
                    <a href="#tab1" data-toggle="tab"> <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000" data-loop="true"></i>
                        User Profile
                    </a>
                </li>

            </ul>
            <div  class="tab-content mar-top">
                <div id="tab1" class="tab-pane fade active in">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="col-md-4">
                                        <h4 class="text-primary"> Profile Pic</h4>
                                        <div class="img-file"> 
                                            @if($tUser['profile'][0]['image'])
                                            <img src="{{{ url('/').'/uploads/images/profile/original/'.$tUser['profile'][0]['image'] }}}" alt="profile pic" class="img-max">
                                            @else
                                            <img src="http://placehold.it/200x200" alt="profile pic">
                                            @endif   
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <form method="post" action="#">

                                                    <table class="table table-bordered table-striped" id="users">

                                                        <tr>
                                                            <td>@lang('First name')</td>
                                                            <td>
                                                                {{  $tUser['profile'][0]['first_name']  }}
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Last name')</td>
                                                            <td>
                                                                {{  $tUser['profile'][0]['last_name']  }}
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Email')</td>
                                                            <td>
                                                                {{ $tUser->email }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                @lang('Gender')
                                                            </td>
                                                            <td>
                                                                @if($tUser['profile'][0]['gender'] == 1)
                                                                Male
                                                                @elseif($tUser['profile'][0]['gender'] == 2)
                                                                Female
                                                                @else
                                                                @endif

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Fitness status')</td>
                                                            <td>
                                                                @if($tUser['profile'][0]['fitness_status'] == 1)
                                                                Definitely Fit
                                                                @elseif($tUser['profile'][0]['fitness_status'] == 2)
                                                                Quite Fit
                                                                @elseif($tUser['profile'][0]['fitness_status'] == 3)
                                                                Not so Fit
                                                                @else
                                                                @endif

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Country')</td>
                                                            <td>
                                                                {{  $tUser['profile'][0]['country'] }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('State')</td>
                                                            <td>
                                                                {{ $tUser['profile'][0]['state'] }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('City')</td>
                                                            <td>
                                                                {{ $tUser['profile'][0]['city'] }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Spot')</td>
                                                            <td>
                                                                {{ $tUser['profile'][0]['spot'] }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Quote')</td>
                                                            <td>
                                                                {{ $tUser['profile'][0]['spot'] }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Instagram')</td>
                                                            <td>
                                                                @if($tUser['profile'][0]['instagram'] == 1)
                                                                On
                                                                @elseif($tUser['profile'][0]['instagram'] == 0)
                                                                Off
                                                                @else
                                                                @endif

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Twitter')</td>
                                                            <td>
                                                                @if($tUser['profile'][0]['twitter'] == 1)
                                                                On
                                                                @elseif($tUser['profile'][0]['twitter'] == 0)
                                                                Off
                                                                @else
                                                                @endif

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Facebook')</td>
                                                            <td>
                                                                @if($tUser['profile'][0]['facebook'] == 1)
                                                                On
                                                                @elseif($tUser['profile'][0]['facebook'] == 0)
                                                                Off
                                                                @else
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Status')</td>
                                                            <td>
                                                                @if($tUser->status == 0)
                                                                Not Verified
                                                                @elseif($tUser->status == 1)
                                                                Active
                                                                @elseif($tUser->status == 2)
                                                                Deleted
                                                                @else
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Member since')</td>
                                                            <td>
                                                                {{{ $tUser->created_at->diffForHumans() }}}
                                                            </td>
                                                        </tr> 
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab2" class="tab-pane fade">
                    <div class="row">
                        <div class="col-md-12 pd-top">
                            <form action="#" class="form-horizontal">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="form-body">
                                    <div class="form-group">
                                        <label for="inputpassword" class="col-md-3 control-label">
                                            Password
                                            <span class='require'>*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                                </span>
                                                <input type="password" placeholder="Password" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputnumber" class="col-md-3 control-label">
                                            Confirm Password
                                            <span class='require'>*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                                </span>
                                                <input type="password" placeholder="Password" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        &nbsp;
                                        <button type="button" class="btn btn-danger">Cancel</button>
                                        &nbsp;
                                        <input type="reset" class="btn btn-default hidden-xs" value="Reset"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- Bootstrap WYSIHTML5 -->
<script  src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
@stop