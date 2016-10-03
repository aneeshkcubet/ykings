@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Hiit
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
    <h1>Hiit</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>       
        <li class="active">Hiit</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Hiit
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
                            <th>Rewards</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hiit as $list)
                        <tr>
                            <td>{{ $list->id }}</td>
                            <td>{{ $list->name }}</td>
                            <td>{{ $list->description }}</td>
                            <td>{{ $list->rewards }}</td>
                            <td>{{ $list->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.hiit.show', $list->id) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="View Hiit Details"></i></a>
                                <a href="{{ route('admin.hiit.edit', $list->id) }}"><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Edit Hiit Details"></i></a>
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