<div class="btn-icon-list">
    <a href="{{ route('view-project',$projects->id) }}"><i class="fa fa-eye"></i></a>
    <a href="{{ route('edit-project', $projects->id) }}"><i class="fa fa-pencil"></i></a>
    <a class="delete-project" title="Delete" href="Javascript:void(0);" data-id="{{$projects->id}}"><i class="fa fa-trash-o"></i></a>
</div>
