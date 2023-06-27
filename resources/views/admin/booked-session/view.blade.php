@extends('admin.layouts.app')
@section('title', (isset($content->name) ? $content->name : ''). ' Customer')
@section('page_css')
<!-- Datatables -->
<link href="{{ asset('admin/datatables/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/datatables/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/datatables/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
    rel="stylesheet">
<link href="{{ asset('admin/datatables/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
    rel="stylesheet">
<link href="{{ asset('admin/datatables/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
<style>
    th {
        background-color: #f7f7f7;
    }
</style>
@endsection
@section('section')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6 offset-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Booked Session Detail</li>
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
                            <h3 class="card-title">Booked Session Detail</h3>
{{--                            @if(course_is_joinable($content->id))--}}
{{--                                <button class="btn btn-success" style="float: right;">Start streaming</button>--}}
{{--                            @endif--}}
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Booked By</th>

                                        <td>{{$bookSession->name??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Booked User Email</th>

                                        <td>{{$bookSession->email??''}}</td>
                                    </tr>


                                    <tr>
                                        <th>Booked User Phone Number</th>
                                        <td>{{$bookSession->phone_number??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Session Name</th>
                                        <td>{{$bookSession->session->name??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Service Name</th>
                                        <td>{{$bookSession->session->service->name??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Date</th>
                                        <td>{{$bookSession->session->date ??  ''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Time</th>
                                        <td>{{$bookSession->sessionTiming->session_time??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Detail</th>
                                        <td>{{$bookSession->detail ??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Status</th>
                                        <td>{{$bookSession->status ?? ''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Transaction Id</th>
                                        <td>{{$bookSession->txnid??''}}</td>
                                    </tr>




{{--                                    <tr>--}}
{{--                                        <th>Affiliation Dropdown</th>--}}
{{--                                        <td>{{$content->affiliation_dropdown??''}}</td>--}}
{{--                                    </tr>--}}

{{--                                    <tr>--}}
{{--                                        <th>Department Associated With</th>--}}
{{--                                        <td>{{$content->department_associated_with??''}}</td>--}}
{{--                                    </tr>--}}

{{--                                    <tr>--}}
{{--                                        <th>Name of Hero Member</th>--}}
{{--                                        <td>{{$content->name_of_hero_member??''}}</td>--}}
{{--                                    </tr>--}}
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

</div>
@endsection
