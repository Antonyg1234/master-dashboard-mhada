@extends('admin.app1')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-md-12">

                    <div class="m-subheader px-0 m-subheader--top">
                        <div class="d-flex align-items-center">
                            <h3 class="m-subheader__title m-subheader__title--separator">Assign Role to User</h3>
                            <div class="ml-auto btn-list">
                                <a href="{{ route('list-user') }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                            </div>
                        </div>
                    </div>
                    @if(Session::has('success'))
                        <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="font-size:20px">×</span>
                            </button> {{ Session::get('success') }}
                        </div>
                    @endif
                    <br><br>
                    <form id="add-user" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('store-user-role',$user_id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-9">
                                <label><strong>Roles for {{$user_name}}</strong></label><br>

                                @foreach($roles as $role)
                                    <input type="checkbox" name="roles[]" value="{{$role->id}}"  {{in_array($role->id,$user_roles) ? 'checked' : ''}}> {{$role->display_name}}<br>
                                @endforeach
                            </div>
                        </div><br/>

                        <div class="row">
                            <div class="col-lg-9">
                                <div class="btn-list">
                                    <button type="submit" id="add_user" class="btn btn-primary">Save</button>
                                    <a href="{{route('list-user')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

