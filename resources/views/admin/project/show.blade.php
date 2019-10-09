@extends('admin.app1')

@section('content')

    <div class="col-md-8 list">
        <div class="col-md-12">
            <div class="m-subheader px-0 m-subheader--top">
                <div class="d-flex align-items-center">
                    <h1 class="m-subheader__title m-subheader__title--separator">View Project</h1>
                    {{--                {{ Breadcrumbs::render('ward_view',$ward['id']) }}--}}
                    <div class="ml-auto btn-list">
                        <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left"
                                                                                  style="padding-right: 8px;"></i>Back</a>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-portlet m-portlet--mobile">
                <form id="view-project" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
                      action="{{route('store-project')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="m-portlet__body m-portlet__body--spaced">
                        <div class="form-group m-form__group row">
                            <div class="col-sm-4 form-group">
                                <label class="col-form-label" for="name">Project Name:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input disabled type="text" id="name" name="name"
                                           class="form-control form-control--custom m-input"
                                           value="{{ $project['name'] }}">
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                </div>
                            </div>

                            <div class="col-sm-4 offset-sm-1 form-group">
                                <label class="col-form-label" for="description">Project Description:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input disabled type="text" id="description" name="description"
                                           class="form-control form-control--custom m-input"
                                           value="{{ $project['description'] }}">
                                    <span class="text-danger">{{$errors->first('description')}}</span>
                                </div>
                            </div>

                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-sm-4 form-group">
                                <label class="col-form-label" for="board_id">Board:<span class="star">*</span></label>
                                <div class="m-input-icon m-input-icon--right">
                                    <select disabled title="Select Layout" data-live-search="true"
                                            class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                            id="board_id" name="board_id">
                                        @foreach($boards as $board)
                                            <option value="{{$board->id}}" {{($project['board_id'] == $board->id) ? 'selected' : '' }} >{{$board->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('board_id')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-4 offset-sm-1 form-group">
                                <label class="col-form-label" for="project_url">Project Url:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    @if(isset($project['project_url']))
                                        <a href="{{$project['project_url']}}" target="_blank">{{$project['project_url']}}</a>
                                    @else
                                        <span>No Project Url Available.</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="btn-list">
                                        <a href="{{route('list-project')}}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

