@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Media
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
    <h1>Media</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>       
        <li class="active">Media</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Media
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>                            
                            <th>Media</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medias as $list)
                        <tr>
                            <td>{{ $list->id }}</td>
                            <td>{{ $list->name }}</td>                            
                            <td>
                                {{ $list->description }}
                            </td>
                            <td>                                                               
                                <img width="100%" src="{{asset('uploads/images/media/small/'.$list->path)}}" alt="{{ $list->name }}" />
                            </td>
                            <td>
                                <a href="{{ route('admin.media.show', $list->id) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="View Media Details"></i></a>
                                <a href="{{ route('admin.confirm-delete.media', $list->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="livicon" data-name="media-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete media">
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
            "sEmptyTable": "No Workouts found!",
            "sProcessing": "<img src='{{asset('img/ajax-loader.gif')}}' />"
        },
        ajax: '{!! route("admin.medias.data") !!}',
        columns: [
            {data: 'id', name: 'medias.id'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'content', name: 'content', orderable: false, searchable: false},            
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        order: [[0, 'desc']]   
    });
</script>
@stop