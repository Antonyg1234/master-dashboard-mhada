<div class="btn-icon-list">
    <a href="{{ route('view-role',$roles->id) }}"><i class="fa fa-eye"></i></a>
    <a href="{{ route('edit-role', $roles->id) }}"><i class="fa fa-pencil"></i></a>
    <a class="delete-role" title="Delete" href="Javascript:void(0);" data-id="{{$roles->id}}"><i class="fa fa-trash-o"></i></a>
</div>
