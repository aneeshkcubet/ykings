@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Skills
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
<style>
    .skill-card .panel-body{
        height: 120px;
        overflow-x: hidden;
        text-overflow: ellipsis;
    }
</style>
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Skills</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>       
        <li class="active">Skills</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav  nav-tabs ">
                <li class="active">
                    <a href="#tab1" data-toggle="tab"> 
                        Pull Progression
                    </a>
                </li>
                <li>
                    <a href="#tab2" data-toggle="tab"> 
                        Dip Progression
                    </a>
                </li>
                <li>
                    <a href="#tab3" data-toggle="tab"> 
                        Full Body Progression
                    </a>
                </li>
                <li>
                    <a href="#tab4" data-toggle="tab"> 
                        Push Progression
                    </a>
                </li>
                <li>
                    <a href="#tab5" data-toggle="tab"> 
                        Core Progression
                    </a>
                </li>
            </ul>
            <div  class="tab-content mar-top">
                <div id="tab1" class="tab-pane fade active in">
                    <div class="row">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <i class="livicon" data-name="credit-card" data-size="20" data-loop="true" data-c="#fff" data-hc="#fff"></i>
                                    Skills on Pull Progression
                                </h3>
                            </div>
                            <div class="panel-body">
                                @foreach($skills['pull'] as $sKey => $skill)
                                <div class="row">
                                    @foreach($skill as $rKey => $row)
                                    <div class="col-xs-12  col-sm-3 col-md-3 col-lg-3 pull-left skill-card">
                                        <div class="panel panel-primary height">
                                            <div class="panel-heading">{{{$row['exercise']['name']}}}
                                                <div style="position: absolute;right: 24px;top: 13px;">
                                                    <a href="{{ route('admin.skill.show', $row['id']) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#FFF" data-hc="#FFF" title="View Skill Details"></i></a>
                                                    <a href="{{ route('admin.skill.edit', $row['id']) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#FFF" data-hc="#FFF" title="Edit Skill Details"></i></a>

                                                    <a href="{{ route('admin.confirm-delete.skill', $row['id']) }}" data-toggle="modal" data-target="#delete_confirm">
                                                        <i class="livicon" data-name="skill-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete skill">
                                                        </i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">                                            
                                                @if($row['exercise']['category'] == 1)
                                                Difficulty: <b>Beginner</b>
                                                @elseif($row['exercise']['category'] == 2)
                                                Difficulty: <b>Advanced</b>
                                                @else
                                                Difficulty: <b>Professional</b>
                                                @endif
                                                <br />
                                                <br />
                                                {{{$row['description']}}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab2" class="tab-pane fade">
                    <div class="row">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <i class="livicon" data-name="credit-card" data-size="20" data-loop="true" data-c="#fff" data-hc="#fff"></i>
                                    Skills on Dip Progression
                                </h3>
                            </div>
                            <div class="panel-body">
                                @foreach($skills['dip'] as $sKey => $skill)
                                <div class="row">
                                    @foreach($skill as $rKey => $row)
                                    <div class="col-xs-12  col-sm-3 col-md-3 col-lg-3 pull-left skill-card">
                                        <div class="panel panel-primary height">
                                            <div class="panel-heading">{{{$row['exercise']['name']}}}
                                                <div style="position: absolute;right: 24px;top: 13px;">
                                                    <a href="{{ route('admin.skill.show', $row['id']) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#FFF" data-hc="#FFF" title="View Skill Details"></i></a>
                                                    <a href="{{ route('admin.skill.edit', $row['id']) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#FFF" data-hc="#FFF" title="Edit Skill Details"></i></a>

                                                    <a href="{{ route('admin.confirm-delete.skill', $row['id']) }}" data-toggle="modal" data-target="#delete_confirm">
                                                        <i class="livicon" data-name="skill-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete skill">
                                                        </i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">                                            
                                                @if($row['exercise']['category'] == 1)
                                                Difficulty: <b>Beginner</b>
                                                @elseif($row['exercise']['category'] == 2)
                                                Difficulty: <b>Advanced</b>
                                                @else
                                                Difficulty: <b>Professional</b>
                                                @endif
                                                <br />
                                                <br />
                                                {{{$row['description']}}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab3" class="tab-pane fade">
                    <div class="row">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <i class="livicon" data-name="credit-card" data-size="20" data-loop="true" data-c="#fff" data-hc="#fff"></i>
                                    Skills on Full Body Progression
                                </h3>
                            </div>
                            <div class="panel-body">
                                @foreach($skills['full_body'] as $sKey => $skill)
                                <div class="row">
                                    @foreach($skill as $rKey => $row)
                                    <div class="col-xs-12  col-sm-3 col-md-3 col-lg-3 pull-left skill-card">
                                        <div class="panel panel-primary height">
                                            <div class="panel-heading">{{{$row['exercise']['name']}}}
                                                <div style="position: absolute;right: 24px;top: 13px;">
                                                    <a href="{{ route('admin.skill.show', $row['id']) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#FFF" data-hc="#FFF" title="View Skill Details"></i></a>
                                                    <a href="{{ route('admin.skill.edit', $row['id']) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#FFF" data-hc="#FFF" title="Edit Skill Details"></i></a>

                                                    <a href="{{ route('admin.confirm-delete.skill', $row['id']) }}" data-toggle="modal" data-target="#delete_confirm">
                                                        <i class="livicon" data-name="skill-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete skill">
                                                        </i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">                                            
                                                @if($row['exercise']['category'] == 1)
                                                Difficulty: <b>Beginner</b>
                                                @elseif($row['exercise']['category'] == 2)
                                                Difficulty: <b>Advanced</b>
                                                @else
                                                Difficulty: <b>Professional</b>
                                                @endif
                                                <br />
                                                <br />
                                                {{{$row['description']}}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab4" class="tab-pane fade">
                    <div class="row">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <i class="livicon" data-name="credit-card" data-size="20" data-loop="true" data-c="#fff" data-hc="#fff"></i>
                                    Skills on Push Progression
                                </h3>
                            </div>
                            <div class="panel-body">
                                @foreach($skills['push'] as $sKey => $skill)
                                <div class="row">
                                    @foreach($skill as $rKey => $row)
                                    <div class="col-xs-12  col-sm-3 col-md-3 col-lg-3 pull-left skill-card">
                                        <div class="panel panel-primary height">
                                            <div class="panel-heading">{{{$row['exercise']['name']}}}
                                                <div style="position: absolute;right: 24px;top: 13px;">
                                                    <a href="{{ route('admin.skill.show', $row['id']) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#FFF" data-hc="#FFF" title="View Skill Details"></i></a>
                                                    <a href="{{ route('admin.skill.edit', $row['id']) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#FFF" data-hc="#FFF" title="Edit Skill Details"></i></a>

                                                    <a href="{{ route('admin.confirm-delete.skill', $row['id']) }}" data-toggle="modal" data-target="#delete_confirm">
                                                        <i class="livicon" data-name="skill-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete skill">
                                                        </i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">                                            
                                                @if($row['exercise']['category'] == 1)
                                                Difficulty: <b>Beginner</b>
                                                @elseif($row['exercise']['category'] == 2)
                                                Difficulty: <b>Advanced</b>
                                                @else
                                                Difficulty: <b>Professional</b>
                                                @endif
                                                <br />
                                                <br />
                                                {{{$row['description']}}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab5" class="tab-pane fade">
                    <div class="row">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <i class="livicon" data-name="credit-card" data-size="20" data-loop="true" data-c="#fff" data-hc="#fff"></i>
                                    Skills on Core Progression
                                </h3>
                            </div>
                            <div class="panel-body">
                                @foreach($skills['core'] as $sKey => $skill)
                                <div class="row">
                                    @foreach($skill as $rKey => $row)
                                    <div class="col-xs-12  col-sm-3 col-md-3 col-lg-3 pull-left skill-card">
                                        <div class="panel panel-primary height">
                                            <div class="panel-heading">{{{$row['exercise']['name']}}}
                                                <div style="position: absolute;right: 24px;top: 13px;">
                                                    <a href="{{ route('admin.skill.show', $row['id']) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#FFF" data-hc="#FFF" title="View Skill Details"></i></a>
                                                    <a href="{{ route('admin.skill.edit', $row['id']) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#FFF" data-hc="#FFF" title="Edit Skill Details"></i></a>

                                                    <a href="{{ route('admin.confirm-delete.skill', $row['id']) }}" data-toggle="modal" data-target="#delete_confirm">
                                                        <i class="livicon" data-name="skill-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete skill">
                                                        </i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body">                                            
                                                @if($row['exercise']['category'] == 1)
                                                Difficulty: <b>Beginner</b>
                                                @elseif($row['exercise']['category'] == 2)
                                                Difficulty: <b>Advanced</b>
                                                @else
                                                Difficulty: <b>Professional</b>
                                                @endif
                                                <br />
                                                <br />
                                                {{{$row['description']}}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- row-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>
<script>
    $(function () {
        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
        });
    });
</script>
@stop