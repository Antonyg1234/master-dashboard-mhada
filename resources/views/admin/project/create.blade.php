@extends('admin.app1')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-md-12">
                    <div class="m-subheader px-0 m-subheader--top">
                        <div class="d-flex align-items-center">
                            <h3 class="m-subheader__title m-subheader__title--separator">Add Project</h3>
                            <div class="ml-auto btn-list">
                                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                            </div>
                        </div>
                    </div>
                    <!-- END: Subheader -->
                    <div class="m-portlet m-portlet--mobile">
                        <form id="add-project" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('store-project')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="m-portlet__body m-portlet__body--spaced">
                                <div class="form-group m-form__group row">
                                    <div class="col-sm-4 form-group">
                                        <label class="col-form-label" for="name">Project Name:</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" id="name" name="name" class="form-control form-control--custom m-input"  value="{{ old('name') }}">
                                            <span class="text-danger">{{$errors->first('name')}}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 offset-sm-1 form-group">
                                        <label class="col-form-label" for="description">Project Description:</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" id="description" name="description" class="form-control form-control--custom m-input"  value="{{ old('description') }}">
                                            <span class="text-danger">{{$errors->first('description')}}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-sm-4 form-group">
                                        <label class="col-form-label" for="board_id">Board:<span class="star">*</span></label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <select title="Select Layout" data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="board_id" name="board_id">
                                                @foreach($boards as $board)
                                                    <option value={{$board->id}}>{{$board->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{$errors->first('board_id')}}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 offset-sm-1 form-group">
                                        <label class="col-form-label" for="project_url">Project Url:</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" id="project_url" name="project_url" class="form-control form-control--custom m-input"  value="{{ old('project_url') }}">
                                            <span class="text-danger">{{$errors->first('project_url')}}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions px-0">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="btn-list">
                                                <button type="submit" id="add_ward" class="btn btn-primary">Save</button>
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
        </div>
    </div>
@endsection

