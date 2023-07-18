@extends('admin.layouts.app')
@section('title', 'Customers')
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
                        <h1>Customers</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Customer</li>
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
{{--                            <div class="card-header">--}}
{{--                                <a class="btn btn-primary pull-right addBtn" href="{{route('admin.add-customer')}}">Add Customer</a>--}}
{{--                            </div>--}}
                            <div class="col-md-12">

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>

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
        <div id="activateModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header"  style="background-color: #343a40;
            color: #fff;">
                        <h2 class="modal-title">Confirmation</h2>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h4 align="center" style="margin: 0;">Are you sure?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="ok_activate" name="ok_activate" class="btn btn-danger">Activate</button>
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
                dom: "Blfrtip",
                buttons: [{
                    extend: "copy",
                    className: "btn-sm"
                }, {
                    extend: "csv",
                    className: "btn-sm"
                }, {
                    extend: "excel",
                    className: "btn-sm"
                }, {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                }, {
                    extend: "print",
                    className: "btn-sm"
                }],
                responsive: true,
                processing: true,
                serverSide: true,
                pageLength: 10,
                ajax: {
                    url: `{{route(request()->segment(2))}}`,
                },
                columns: [


                    {data: 'id', name: 'id'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},

                    {data: 'action', name: 'action', orderable: false}
                ],

                "order": [[ 4, "asc" ]]

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
                            toastr.error('Exception Here ! Delete Firstly Child Category');
                        }else{
                            toastr.success('Record Delete Successfully');
                        }
                    }
                })
            });

            var activate_id;
            var action = '';
            var verb = '';
            var color = '';
            //on activate/unactivate click
            $(document,this).on('click','.activate',function(){
                activate_id = $(this).attr('id');

                //activate button text compute
                var activate_bool = $(this).data('activate');
                action = activate_bool == 1 ? 'Activate' : 'Inactivate';
                verb = activate_bool == 1 ? 'Activating' : 'Inactivating';
                color = activate_bool == 1 ? 'limegreen' : 'red';
                $('#ok_activate').text(action);
                $('#ok_activate').css('background-color', color);
                $('#ok_activate').css('border', color);

                $('#activateModal').modal('show');
            });
            //on activate/inactivate confirmation
            $(document).on('click','#ok_activate',function(){
                $.ajax({
                    type:"post",
                    url:`{{url('admin/'.request()->segment(2).'/activate/')}}/${activate_id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function(){
                        $('#ok_activate').text(verb + '...');
                        $('#ok_activate').attr("disabled",true);
                    },
                    success: function (data) {
                        DataTable.ajax.reload();
                        $('#ok_activate').text(action);
                        $('#ok_activate').attr("disabled",false);
                        $('#activateModal').modal('hide');
                        //   js_success(data);
                        if(data==0) {
                            toastr.error('Exception Here ! Activate');
                        }else{
                            toastr.success('Record '+action+'d Successfully');
                        }
                    }
                })
            });
        })
    </script>


    @endsection
