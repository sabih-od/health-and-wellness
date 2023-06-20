@extends('admin.layouts.app')
@section('title', 'Services')
@section('page_css')
    <style>
        .addBtn{
            float: right;
            /*margin-top: 10px;*/
        }
        td{
            text-align: center;
        }
    </style>

@endsection
@section('section')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sessions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Session</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-primary pull-right addBtn" href="{{route('admin.add-session')}}">Add Session</a>
                            </div>
                            <div class="col-md-12">

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Session</th>
                                        <th>Service</th>
                                        <th>Fees</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>

                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <div id="confirmModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header"  style="background-color: #343a40;
            color: #fff;">
                        <h2 class="modal-title">Confirmation</h2>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin: 0;">Are you sure you want to delete this ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="ok_delete" name="ok_delete" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var DataTable = $("#example1").DataTable({
                // dom: "Blfrtip",
                // buttons: [{
                //     extend: "copy",
                //     className: "btn-sm"
                // }, {
                //     extend: "csv",
                //     className: "btn-sm"
                // }, {
                //     extend: "excel",
                //     className: "btn-sm"
                // }, {
                //     extend: "pdfHtml5",
                //     className: "btn-sm"
                // }, {
                //     extend: "print",
                //     className: "btn-sm"
                // }],
                responsive: true,
                processing: true,
                serverSide: true,
                pageLength: 10,
                ajax: {
                    url: `{{route(request()->segment(2))}}`,
                },
                columns: [


                    {data: 'id', name: 'id'},
                    {
                        data: 'image',
                        name: 'image',
                        render: function( data, type, full, meta ) {
                            return `<img src="`+data+`" height="80"/>`;
                        }
                    },
                    {data: 'name', name: 'name'},
                    {data: 'service', name: 'service'},
                    {data: 'fees', name: 'fees'},
                    {data: 'date', name: 'date'},
                    {data: 'session_time', name: 'session_time'},
                    {data: 'status', name: 'status'},

                    {data: 'action', name: 'action', orderable: false}
                ],

                "order": [[ 2, "asc" ]]

            });

            var session_id;
            $(document,this).on('click','.activate',function(){
                session_id = $(this).attr('id');
                console.log("session_id" , session_id)
                $.ajax({
                    type:"post",
                    url:`{{url('admin/'.request()->segment(2).'/deactivate-status/')}}/${session_id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    // beforeSend: function(){
                    //     $('#ok_delete').text('Deleting...');
                    //     $('#ok_delete').attr("disabled",true);
                    // },
                    success: function (data) {
                        DataTable.ajax.reload();
                        // $('#ok_delete').text('Delete');
                        // $('#ok_delete').attr("disabled",false);
                        // $('#confirmModal').modal('hide');
                        // //   js_success(data);
                        // if(data==0) {
                        //     toastr.error('Exception Here ! Delete Firstly Child Service');
                        // }else{
                        //     toastr.success('Record Delete Successfully');
                        // }
                    }
                })
            });
            $(document,this).on('click','.deactivate',function(){
                session_id = $(this).attr('id');
                console.log("session_id" , session_id)
                $.ajax({
                    type:"post",
                    url:`{{url('admin/'.request()->segment(2).'/activate-status/')}}/${session_id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    // beforeSend: function(){
                    //     $('#ok_delete').text('Deleting...');
                    //     $('#ok_delete').attr("disabled",true);
                    // },
                    success: function (data) {
                        DataTable.ajax.reload();
                        // $('#ok_delete').text('Delete');
                        // $('#ok_delete').attr("disabled",false);
                        // $('#confirmModal').modal('hide');
                        // //   js_success(data);
                        // if(data==0) {
                        //     toastr.error('Exception Here ! Delete Firstly Child Service');
                        // }else{
                        //     toastr.success('Record Delete Successfully');
                        // }
                    }
                })
            });
            var delete_id;
            $(document,this).on('click','.delete',function(){
                delete_id = $(this).attr('id');
                $('#confirmModal').modal('show');
            });
            $(document).on('click','#ok_delete',function(){
                $.ajax({
                    type:"delete",
                    url:`{{url('admin/'.request()->segment(2).'/destroy/')}}/${delete_id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function(){
                        $('#ok_delete').text('Deleting...');
                        $('#ok_delete').attr("disabled",true);
                    },
                    success: function (data) {
                        DataTable.ajax.reload();
                        $('#ok_delete').text('Delete');
                        $('#ok_delete').attr("disabled",false);
                        $('#confirmModal').modal('hide');
                     //   js_success(data);
                        if(data==0) {
                            toastr.error('Exception Here ! Delete Firstly Child Service');
                        }else{
                            toastr.success('Record Delete Successfully');
                        }
                    }
                })
            });
        })
    </script>


    @endsection
