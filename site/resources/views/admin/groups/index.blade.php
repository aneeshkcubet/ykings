@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('groups/title.management')
@parent
@stop

{{-- Content --}}
@section('content')
<section class="content-header">
    <h1>@lang('groups/title.management')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>Groups</li>
        <li class="active">Groups</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Groups List
                    </h4>
                    <div class="pull-right">
                    <a href="{{ route('create/group') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                    </div>
                </div>
                <br />
                <div class="panel-body">
                    @if ($groups->count() >= 1) {{ $groups->render() }}

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>@lang('groups/table.id')</th>
                                    <th>@lang('groups/table.name')</th>
                                    <th>@lang('groups/table.users')</th>
                                    <th>@lang('groups/table.created_at')</th>
                                    <th>@lang('groups/table.actions')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($groups as $group)
                                <tr>
                                    <td>{{{ $group->id }}}</td>
                                    <td>{{{ $group->name }}}</td>
                                    <td>{{{ $group->users()->count() }}}</td>
                                    <td>{{{ $group->created_at->diffForHumans() }}}</td>
                                    <td>
                                        <a href="{{ route('update/group', $group->id) }}">
                                                <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit group"></i>
                                            </a>
                                            <!-- let's not delete 'Admin' group by accident -->
                                            @if ($group->id !== 1)
                                                <a href="{{ route('confirm-delete/group', $group->id) }}" data-toggle="modal" data-target="#delete_confirm">
                                                <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete group"></i>
                                                </a>
                                            @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $groups->render() }}

                    @else
                        @lang('general.noresults')
                    @endif   
                </div>
            </div>
        </div>
    </div>    <!-- row-->
</section>




@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>
<script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
@stop
