@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Fundumentals
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Fundumentals</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>       
        <li class="active">Fundumentals</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <ul class="nav  nav-tabs ">
            <li class="active">
                <a href="#tab1" data-toggle="tab"> 
                    Group1
                </a>
            </li>
            <li>
                <a href="#tab2" data-toggle="tab"> 
                    Group2
                </a>
            </li>
            <li>
                <a href="#tab3" data-toggle="tab"> 
                    Group3
                </a>
            </li>
            <li>
                <a href="#tab4" data-toggle="tab"> 
                    Group4
                </a>
            </li>
            <li>
                <a href="#tab5" data-toggle="tab"> 
                    Group5
                </a>
            </li>
        </ul>
        <div  class="tab-content mar-top">
            <div id="tab1" class="tab-pane fade active in">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="credit-card" data-size="20" data-loop="true" data-c="#fff" data-hc="#fff"></i>
                            Exercises on Fundumental Group1
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered " id="table">
                            <thead>
                                <tr class="filters">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Repititions / Duration</th>                            
                                    <th>Unit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fundumentals[1] as $list)
                                <tr>
                                    <td>{{ $list->id }}</td>
                                    <td>{{ $list['exercise']->name }}</td>                            
                                    <td>
                                        <?php $durationArray = json_decode($list->duration, true); ?>

                                        Beginner(Min-{{$durationArray[1]['min']}}, Max - {{$durationArray[1]['max']}}) <br />
                                        Advanced(Min-{{$durationArray[2]['min']}}, Max - {{$durationArray[2]['max']}})

                                    </td>
                                    <td>
                                        @if($list->unit == 'times')
                                        Repititions
                                        @else
                                        Seconds
                                        @endif                               

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.fundumental.show', $list->id) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="View Fundumental Details"></i></a>
                                        <a href="{{ route('admin.fundumental.edit', $list->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Edit Fundumental Details"></i></a>

                                        <a href="{{ route('admin.confirm-delete.fundumental', $list->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                            <i class="livicon" data-name="fundumental-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete fundumental">
                                            </i>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>       
            
            
            <div id="tab2" class="tab-pane fade">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="credit-card" data-size="20" data-loop="true" data-c="#fff" data-hc="#fff"></i>
                            Exercises on Fundumental Group2
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered " id="table">
                            <thead>
                                <tr class="filters">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Repititions / Duration</th>                            
                                    <th>Unit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fundumentals[2] as $list)
                                <tr>
                                    <td>{{ $list->id }}</td>
                                    <td>{{ $list['exercise']->name }}</td>                            
                                    <td>
                                        <?php $durationArray = json_decode($list->duration, true); ?>

                                        Beginner(Min-{{$durationArray[1]['min']}}, Max - {{$durationArray[1]['max']}}) <br />
                                        Advanced(Min-{{$durationArray[2]['min']}}, Max - {{$durationArray[2]['max']}})

                                    </td>
                                    <td>
                                        @if($list->unit == 'times')
                                        Repititions
                                        @else
                                        Seconds
                                        @endif                               

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.fundumental.show', $list->id) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="View Fundumental Details"></i></a>
                                        <a href="{{ route('admin.fundumental.edit', $list->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Edit Fundumental Details"></i></a>

                                        <a href="{{ route('admin.confirm-delete.fundumental', $list->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                            <i class="livicon" data-name="fundumental-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete fundumental">
                                            </i>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div id="tab3" class="tab-pane fade">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="credit-card" data-size="20" data-loop="true" data-c="#fff" data-hc="#fff"></i>
                            Exercises on Fundumental Group3
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered " id="table">
                            <thead>
                                <tr class="filters">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Repititions / Duration</th>                            
                                    <th>Unit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fundumentals[3] as $list)
                                <tr>
                                    <td>{{ $list->id }}</td>
                                    <td>{{ $list['exercise']->name }}</td>                            
                                    <td>
                                        <?php $durationArray = json_decode($list->duration, true); ?>

                                        Beginner(Min-{{$durationArray[1]['min']}}, Max - {{$durationArray[1]['max']}}) <br />
                                        Advanced(Min-{{$durationArray[2]['min']}}, Max - {{$durationArray[2]['max']}})

                                    </td>
                                    <td>
                                        @if($list->unit == 'times')
                                        Repititions
                                        @else
                                        Seconds
                                        @endif                               

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.fundumental.show', $list->id) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="View Fundumental Details"></i></a>
                                        <a href="{{ route('admin.fundumental.edit', $list->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Edit Fundumental Details"></i></a>

                                        <a href="{{ route('admin.confirm-delete.fundumental', $list->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                            <i class="livicon" data-name="fundumental-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete fundumental">
                                            </i>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div id="tab4" class="tab-pane fade">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="credit-card" data-size="20" data-loop="true" data-c="#fff" data-hc="#fff"></i>
                            Exercises on Fundumental Group4
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered " id="table">
                            <thead>
                                <tr class="filters">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Repititions / Duration</th>                            
                                    <th>Unit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fundumentals[4] as $list)
                                <tr>
                                    <td>{{ $list->id }}</td>
                                    <td>{{ $list['exercise']->name }}</td>                            
                                    <td>
                                        <?php $durationArray = json_decode($list->duration, true); ?>

                                        Beginner(Min-{{$durationArray[1]['min']}}, Max - {{$durationArray[1]['max']}}) <br />
                                        Advanced(Min-{{$durationArray[2]['min']}}, Max - {{$durationArray[2]['max']}})

                                    </td>
                                    <td>
                                        @if($list->unit == 'times')
                                        Repititions
                                        @else
                                        Seconds
                                        @endif                               

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.fundumental.show', $list->id) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="View Fundumental Details"></i></a>
                                        <a href="{{ route('admin.fundumental.edit', $list->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Edit Fundumental Details"></i></a>

                                        <a href="{{ route('admin.confirm-delete.fundumental', $list->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                            <i class="livicon" data-name="fundumental-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete fundumental">
                                            </i>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div id="tab5" class="tab-pane fade">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="credit-card" data-size="20" data-loop="true" data-c="#fff" data-hc="#fff"></i>
                            Exercises on Fundumental Group5
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered " id="table">
                            <thead>
                                <tr class="filters">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Repititions / Duration</th>                            
                                    <th>Unit</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fundumentals[5] as $list)
                                <tr>
                                    <td>{{ $list->id }}</td>
                                    <td>{{ $list['exercise']->name }}</td>                            
                                    <td>
                                        <?php $durationArray = json_decode($list->duration, true); ?>

                                        Beginner(Min-{{$durationArray[1]['min']}}, Max - {{$durationArray[1]['max']}}) <br />
                                        Advanced(Min-{{$durationArray[2]['min']}}, Max - {{$durationArray[2]['max']}})

                                    </td>
                                    <td>
                                        @if($list->unit == 'times')
                                        Repititions
                                        @else
                                        Seconds
                                        @endif                               

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.fundumental.show', $list->id) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="View Fundumental Details"></i></a>
                                        <a href="{{ route('admin.fundumental.edit', $list->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Edit Fundumental Details"></i></a>

                                        <a href="{{ route('admin.confirm-delete.fundumental', $list->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                            <i class="livicon" data-name="fundumental-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete fundumental">
                                            </i>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
        <!-- row-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.js') }}"></script>

<script>
$(document).ready(function () {
    $('#table').DataTable();
});
</script>

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