<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="user_delete_confirm_title">Delete User</h4>
</div>
<div class="modal-body">
    @if(isset($error))
        <div>{{ $error }}</div>
    @else
        Are you sure to want to delete this {{$entity}}?
    @endif
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
  @if(!$error)
    <a href="{{ $confirm_route }}" type="button" class="btn btn-danger">Yes</a>
  @endif
</div>
