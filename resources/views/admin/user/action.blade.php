<div class="btn-icon-list">
    <a href="{{ route('view-project',$users->id) }}"><i class="fa fa-eye"></i></a>
    <a href="{{ route('edit-project', $users->id) }}"><i class="fa fa-pencil"></i></a>
    <a class="delete-user" title="Delete" href="Javascript:void(0);" data-id="{{$users->id}}"><i class="fa fa-trash-o"></i></a>
</div>
