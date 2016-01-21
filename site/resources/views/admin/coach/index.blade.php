@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Coaches
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
    <h1>Coaches</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>       
        <li class="active">Coaches</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Coaches
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>User</th>
                            <th>Focus</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Muscle Groups</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coachArray as $list)
                        <tr>
                            <td>{{ $list['id'] }}</td>
                            <td><a href="" title="{{$list['profile']['first_name']}} {{$list['profile']['last_name']}}">
                                    @if($list['profile']['image'] != '')
                                    <img width="50" height="50" src='{{{ url('/').'/uploads/images/profile/small/'.$list['profile']['image'] }}}' />
                                    @else
                                    @if($list['profile']['gender'] < 2)
                                    <img width="50" height="50" src='{{{ url('/').'/img/avatar04.png' }}}' />
                                    @else
                                    <img width="50" height="50" src='{{{ url('/').'/img/avatar3.png' }}}' />
                                    @endif
                                    @endif
                                    <br />
                                    {{$list['profile']['first_name']}} {{$list['profile']['last_name']}}
                                </a>
                            </td>
                            <td>
                                @if($list['category'] == 1)
                                Lean
                                @elseif($list['category'] == 2)
                                Athletic
                                @else
                                Strength
                                @endif
                            </td>
                            <td>{{ $list['height'] }}</td>
                            <td>{{ $list['weight'] }}</td>
                            <td>{{ $list['muscle_groups'] }}</td>
                            <td>
<!--                                <a href="{{ route('admin.hiit.show', $list['id']) }}"><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="View Coach Details"></i></a>-->
                                <a href="{{ route('admin.confirm-delete.coach', $list['id']) }}" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="livicon" data-name="coach-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete coach">
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