<div class="btn-icon-list">
    <a href="{{ route('view-project',$boards->id) }}"><i class="fa fa-eye"></i></a>
    <a href="{{ route('edit-project', $boards->id) }}"><i class="fa fa-pencil"></i></a>
    <a class="delete-board" title="Delete" href="Javascript:void(0);" data-id="{{$boards->id}}"><i class="fa fa-trash-o"></i></a>
</div>
