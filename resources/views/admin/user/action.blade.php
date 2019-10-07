<div class="btn-icon-list">
    <a href="{{ route('view-user',$users->id) }}"><i class="fa fa-eye"></i></a>
    <a href="{{ route('edit-user', $users->id) }}"><i class="fa fa-pencil"></i></a>
    <a class="delete-user" title="Delete" href="Javascript:void(0);" data-id="{{$users->id}}"><i class="fa fa-trash-o"></i></a>
    <a href="{{ route('assign-role', $users->id) }}">User-Role</a>
    <a href="{{ route('assign-board', $users->id) }}">User-Board</a>
</div>
