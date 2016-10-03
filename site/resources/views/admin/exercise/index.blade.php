@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Exercises
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
    .dataTables_wrapper .dataTables_processing{
        border:none;
        padding: 0;
        background: none;
        height:0;        
    }
</style>
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Exercises</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>       
        <li class="active">Exercises</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Exercises
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th width="5%">ID</th>
                            <th width="15%">Name</th>
                            <th width="20%">Description</th>
                            <th width="10%">Category</th>
                            <th width="10%">Type</th>
                            <th width="5%">Rewards</th>                         
                            <th width="10%">Unit</th>
                            <th width="10%">Equipment</th>
                            <th width="10%">Muscle Groups</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
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
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page",
            "sEmptyTable": "No Exercises found!",
            "sProcessing": "<img src='{{asset('img/ajax-loader.gif')}}' />"
        },
        ajax: '{!! route("admin.exercises.data") !!}',
        columns: [
            {data: 'id', name: 'exercises.id'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'category', name: 'category'},
            {data: 'type', name: 'type'},
            {data: 'rewards', name: 'rewards'},
            {data: 'unit', name: 'unit'},
            {data: 'equipment', name: 'equipment'},
            {data: 'musclegroup_string', name: 'musclegroup_string', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        order: [[0, 'desc']]   
    });
});
</script>
@stop