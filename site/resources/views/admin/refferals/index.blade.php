@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Refferals
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
    <h1>Refferals</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>        
        <li class="active">Refferals</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Refferals
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered data" id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>UserId</th>
                            <th>Email</th>
                            <th>Marketing Title</th>                            
                            <th>Parameters</th>
                            <th>Is Coach Subscribed</th>                            
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
});
$('#table').DataTable({
    processing: true,
    serverSide: true,
    "oLanguage": {
                "sLengthMenu": "_MENU_ records per page",
                "sEmptyTable": "No Users found!",
                "sProcessing": "<img src='{{asset('img/ajax-loader.gif')}}' />"
            },
    ajax: '{!! route("admin.refferals.data") !!}',
    columns: [
        {data: 'id', name: 'id'},
        {data: 'user_id', name: 'user_id'},
        {data: 'email', name: 'email'},
        {data: 'marketing_title', name: 'marketing_title'},
        {data: 'parameters', name: 'parameters'},
        {data: 'is_coach_subscribed', name: 'is_coach_subscribed'}
    ],
    order: [[0, 'desc']]
});
</script>
@stop