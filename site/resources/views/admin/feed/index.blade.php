@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Feeds
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
    <h1>Feeds</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.index') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>        
        <li class="active">Feeds</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Feeds
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered data">
                    <thead>
                        <tr class="filters">
                            <th width="2%">Id</th>
                            <th width="10%">Image</th>
                            <th width="20%">Feed Text</th>
                            <th width="50%">Comments</th>
                            <th width="10%">Author</th>
                            <th width="4%">Claps</th>
                            <th width="4%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feeds as $list)
                        <tr>
                            <td>{{$list['id']}}</td>
                            <td>@if(isset($list['image'][0])) 
                                <img width="50" height="50" src='{{{ url('/').'/uploads/images/feed/small/'.$list['image'][0]['path'] }}}' />
                                @else 
                                <img width="50" height="50" src='{{{ url('/').'/img/feed_placeholder.png' }}}' /> 
                                @endif
                            </td>
                            <td>{{$list['feed_text']}}</td>
                            <td>
                                @if($list['comment_count'] > 0)
                                <table class="table table-bordered" width="100%">
                                    <thead>
                                        <tr class="filters">
                                            <th width="70%">Comment</th>
                                            <th width="20%">Author</th>
                                            <th width="10%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list['comments'] as $comment)
                                        <tr>
                                            <td>{{$comment['comment_text']}}</td>
                                            <td>
                                                <a href="" title="{{$comment['profile']['first_name']}} {{$comment['profile']['last_name']}}">
                                                    @if($comment['profile']['image'] != '')
                                                    <img width="30" height="30" src='{{{ url('/').'/uploads/images/profile/small/'.$list['profile']['image'] }}}' />
                                                    @else
                                                    @if($comment['profile']['gender'] < 2)
                                                    <img width="30" height="30" src='{{{ url('/').'/img/avatar04.png' }}}' />
                                                    @else
                                                    <img width="30" height="30" src='{{{ url('/').'/img/avatar3.png' }}}' />
                                                    @endif
                                                    @endif
                                                    <br />
                                                    {{$comment['profile']['first_name']}} {{$comment['profile']['last_name']}}
                                                </a>
                                            </td>
                                            <td>                                                
                                                <a href="{{ route('admin.feed.comment.delete', $comment['id']) }}">
                                                    <i class="livicon" data-name="comment-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete comment.">
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @else
                                No Comments
                                @endif

                            </td>
                            <td>
                                <a href="" title="{{$list['profile']['first_name']}} {{$list['profile']['last_name']}}">
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
                            <td>{{$list['clap_count']}}</td>
                            <td>                                
                                <a href="{{ route('admin.confirm-delete.feed', $list['id']) }}" data-toggle="modal" data-target="#delete_confirm">
                                    <i class="livicon" data-name="feed-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete feed.">
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
    $('.data').DataTable();
});
</script>
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="delete_confirm_title" aria-hidden="true">
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