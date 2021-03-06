@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Stretchings
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
    <h1>Stretchings</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>       
        <li class="active">Stretchings</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Stretchings
                </h4>
            </div>
            <br />
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
                        @foreach ($stretching as $list)
                        <tr>
                            <td>{{ $list->id }}</td>
                            <td>{{ $list->exercise_id }}</td>                            
                            <td>
                                <?php $durationArray = json_decode($list->duration, true); ?>
                                Min-{{$durationArray['min']}}, Max - {{$durationArray['max']}}

                            </td>
                            <td>
                                @if($list->unit == 'times')
                                Repititions
                                @else
                                Seconds
                                @endif                               

                            </td>
                            <td>
                                <a href="{{ route('admin.stretching.show', $list->id) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="View Stretching Details"></i></a>
                                <a href="{{ route('admin.stretching.edit', $list->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Edit Stretching Details"></i></a>

                                <a href="{{ route('admin.confirm-delete.stretching', $list->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="livicon" data-name="stretching-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete stretching">
                                    </i>
                                </a>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>    <!-- row-->
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