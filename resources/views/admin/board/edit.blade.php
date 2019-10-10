@extends('admin.app1')

@section('content')

    <div class="col-md-8 list">
        <div class="col-md-12">
            <div class="m-subheader px-0 m-subheader--top">
                <div class="d-flex align-items-center">
                    <h1 class="m-subheader__title m-subheader__title--separator">Update Board</h1>
                    {{--                {{ Breadcrumbs::render('ward_view',$ward['id']) }}--}}
                    <div class="ml-auto btn-list">
                        <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left"
                                                                                  style="padding-right: 8px;"></i>Back</a>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-portlet m-portlet--mobile">
                <form id="edit-board" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
                      action="{{route('update-board',$board['id'])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="m-portlet__body m-portlet__body--spaced">
                        <div class="form-group m-form__group row">
                            <div class="col-sm-4 form-group">
                                <label class="col-form-label" for="name">Board Name:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" id="name" name="name"
                                           class="form-control form-control--custom m-input"
                                           value="{{ $board['name'] }}">
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                </div>
                            </div>

                            <div class="col-sm-4 offset-sm-1 form-group">
                                <label class="col-form-label" for="description">Board Description:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" id="description" name="description"
                                           class="form-control form-control--custom m-input"
                                           value="{{ $board['description'] }}">
                                    <span class="text-danger">{{$errors->first('description')}}</span>
                                </div>
                            </div>

                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-sm-4 form-group">
                                <label class="col-form-label" for="icon_url">Icon Url:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" id="icon_url" name="icon_url"
                                           class="form-control form-control--custom m-input"
                                           value="{{ $board['icon_url'] }}">
                                    <span class="text-danger">{{$errors->first('icon_url')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="btn-list">
                                        <button type="submit" id="edit_board" class="btn btn-primary">Update</button>
                                        <a href="{{route('list-board')}}" class="btn btn-secondary">Cancel</a>
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

