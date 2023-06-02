@extends('admin.layouts.app')
@section('title', (isset($content->name) ? $content->name : ''). ' Event')
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
                        <li class="breadcrumb-item active">Event Detail</li>
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
                            <h3 class="card-title">Event Detail</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>

                                        <td>{{$content->id??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Name</th>
                                        <td>{{$content->name??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Author</th>
                                        <td>{{$content->user->first_name .' '. $content->user->last_name}}</td>
                                    </tr>

                                    <tr>
                                        <th>State</th>
                                        <td>{{$content->state->name??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Address</th>
                                        <td>{{$content->address??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Date</th>
                                        <td>{{$content->date??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Time</th>
                                        <td>{{$content->time??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Detail</th>
                                        <td>{{$content->detail??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Image</th>
                                        <td><img height="100" src="{{$content->getMedia('site_event_images')->first() ? $content->getMedia('site_event_images')->first()->getUrl() : asset('front/images/logo.png')}}" alt=""></td>
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

</div>
@endsection
