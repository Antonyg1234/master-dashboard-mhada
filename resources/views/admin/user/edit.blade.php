@extends('admin.app1')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-md-12">
                    <div class="m-subheader px-0 m-subheader--top">
                        <div class="d-flex align-items-center">
                            <h3 class="m-subheader__title m-subheader__title--separator">Update User</h3>
                            {{--                {{ Breadcrumbs::render('ward_view',$ward['id']) }}--}}
                            <div class="ml-auto btn-list">
                                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                            </div>
                        </div>
                    </div>
                    <!-- END: Subheader -->
                    <div class="m-portlet m-portlet--mobile">
                        <form id="edit-user" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('update-user',$user['id'])}}" enctype="multipart/form-data">
                            @csrf
                            <div class="m-portlet__body m-portlet__body--spaced">
                                <div class="form-group m-form__group row">
                                    <div class="col-sm-4 form-group">
                                        <label class="col-form-label" for="name">Name:</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" id="name" name="name" class="form-control form-control--custom m-input"  value="{{ $user['name'] }}">
                                            <span class="text-danger">{{$errors->first('name')}}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 offset-sm-1 form-group">
                                        <label class="col-form-label" for="email">User Email:</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" id="email" name="email" class="form-control form-control--custom m-input"  value="{{ $user['email'] }}">
                                            <span class="text-danger">{{$errors->first('email')}}</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-sm-4 form-group">
                                        <label class="col-form-label" for="username">user Url:</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" id="username" name="username" class="form-control form-control--custom m-input"  value="{{ $user['username'] }}">
                                            <span class="text-danger">{{$errors->first('username')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions px-0">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="btn-list">
                                                <button type="submit" id="edit_user" class="btn btn-primary">Update</button>
                                                <a href="{{route('list-user')}}" class="btn btn-secondary">Cancel</a>
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

