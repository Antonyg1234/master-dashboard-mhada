@extends('admin.app1')

@section('content')
    <div class="col-md-8 list">
        <div class="col-md-12">
            <div class="m-subheader px-0 m-subheader--top">
                <div class="d-flex align-items-center">
                    <h1 class="m-subheader__title m-subheader__title--separator">Add User</h1>
                    <div class="ml-auto btn-list">
                        <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left"
                                                                                  style="padding-right: 8px;"></i>Back</a>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-portlet m-portlet--mobile">
                <form id="add-user" role="form" method="post" class="m-form m-form--rows m-form--label-align-right"
                      action="{{route('store-user')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="m-portlet__body m-portlet__body--spaced">
                        <div class="form-group m-form__group row">
                            <div class="col-sm-4 form-group">
                                <label class="col-form-label" for="name">Name:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" id="name" name="name"
                                           class="form-control form-control--custom m-input" value="{{ old('name') }}">
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                </div>
                            </div>

                            <div class="col-sm-4 offset-sm-1 form-group">
                                <label class="col-form-label" for="email">User Email:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" id="email" name="email"
                                           class="form-control form-control--custom m-input" value="{{ old('email') }}">
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                </div>
                            </div>

                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-sm-4 form-group">
                                <label class="col-form-label" for="username">User Name:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="text" id="username" name="username"
                                           class="form-control form-control--custom m-input"
                                           value="{{ old('username') }}">
                                    <span class="text-danger">{{$errors->first('username')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-4 offset-sm-1 form-group">
                                <label class="col-form-label" for="password">Password:</label>
                                <div class="m-input-icon m-input-icon--right">
                                    <input type="password" id="password" name="password"
                                           class="form-control form-control--custom m-input"
                                           value="{{ old('password') }}">
                                    <span class="text-danger">{{$errors->first('password')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-sm-4 form-group">
                                <label class="col-form-label" for="board">Board:<span class="star">*</span></label>
                                <div class="m-input-icon m-input-icon--right">
                                    <select title="Select Board" data-live-search="true"
                                            name="board[]" multiple
                                            id="board" name="board">
                                    @foreach($boards as $board)
                                            <option value={{$board->id}}>{{$board->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('board')}}</span>
                                </div>
                            </div>
                            <div class="col-sm-4 offset-sm-1 form-group">
                                <label class="col-form-label" for="role">Role:<span class="star">*</span></label>
                                <div class="m-input-icon m-input-icon--right">
                                    <select title="Select Role" data-live-search="true"
                                            name="role[]" multiple
                                            id="role" name="role">
                                        {{--<option value="">Select Role</option>--}}
                                        @foreach($roles as $role)
                                            <option value={{$role->id}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('role')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="btn-list">
                                        <button type="submit" id="add_user" class="btn btn-primary">Save</button>
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

@endsection
@push('scripts')
<script>
    $('#role, #board').multiselect({
        columns: 1,
        placeholder: 'Please Select',
        search: true,
        selectAll: true
    });

</script>

@endpush

