@extends('admin.app1')

@section('content')
    {{--<div class="container">--}}
        {{--<div class="row justify-content-center">--}}
            <div class="col-md-8 list">
                <h3>PROJECT LIST</h3>
                <a href="{{route('add-project')}}" class="btn btn-primary align-left">
                    Add Project
                </a>
            <br/>

                @if(Session::has('success'))
                    <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" style="font-size:20px">×</span>
                        </button> {{ Session::get('success') }}
                    </div>
            @endif
                <!--begin: Datatable -->

            {!! $html->table() !!}
            <!--end: Datatable -->


            </div>
            <input type="hidden" id="myModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" />

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">

            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        {{--</div>--}}
    {{--</div>--}}


@endsection

@push('scripts')
{!! $html->scripts() !!}
<script>
    //function to detele
    $(document).ready(function () {
        $(document).on("click", ".delete-project", function () {
            var id = $(this).attr("data-id");
            alert();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                data:{
                    id:id
                },
                url:"{{route('loadDeleteProjectUsingAjax')}}",
                success:function(res)
                {
                    $("#myModal").html(res);
                    $("#myModalBtn").click();
                }
            });
        });
    });

</script>
@endpush

