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
        <li class="active">View Exercise</li>
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
                                            @if($user['profile'][0]['image'])
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
                                                            <td>@lang('Name')</td>
                                                            <td>
                                                                {{ $exercise->name }}
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Description')</td>
                                                            <td>
                                                                {{ $exercise->description }}
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Category')</td>
                                                            <td>
                                                                @if($exercise->category == 1)
                                                                Lean
                                                                @elseif($exercise->category == 2)
                                                                Athletic
                                                                @else
                                                                Strength
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                @lang('Type')
                                                            </td>
                                                            <td>
                                                                @if($exercise->type == 1)
                                                                Free
                                                                @elseif($exercise->type == 2)
                                                                paid
                                                                @else
                                                                @endif

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Rewards')</td>
                                                            <td>
                                                                {{ $exercise->rewards }}

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Repetitions')</td>
                                                            <td>
                                                                {{ $exercise->repititions }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Duration')</td>
                                                            <td>
                                                                {{ $exercise->duration }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Unit')</td>
                                                            <td>
                                                                {{ $exercise->unit }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Equipment')</td>
                                                            <td>
                                                                {{ $exercise->equipment }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('')</td>
                                                            <td>
                                                                <a href="#tab1"> 
                                                                    List Users
                                                                </a>
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
                    <div id="exercisUsers">
                        <div class="panel-body">
                            <table class="table table-bordered " id="table">
                                <thead>
                                    <tr class="filters">
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>User E-mail</th>
                                        <th>Status</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usersList as $list)
                                    <tr>
                                        <td></td>
                                        <td></td> <td></td> <td></td> <td></td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
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