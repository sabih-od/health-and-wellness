@extends('admin.layouts.app')
@section('title', (isset($content->name) ? $content->name : ''). ' Product')
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
                        <li class="breadcrumb-item active">Product Detail</li>
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
                            <h3 class="card-title">Product Detail</h3>
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
                                        <th>Product Title</th>
                                        <td>{{$content->title??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Product Seller</th>
                                        <td>{{is_null($content->user_id) ? 'Admin' : ($content->user->first_name . ' ' . $content->user->last_name)}}</td>
                                    </tr>

                                    <tr>
                                        <th>Product Seller Phone</th>
                                        <td>{{is_null($content->user_id) ? '' : $content->user->phone}}</td>
                                    </tr>

                                    <tr>
                                        <th>Product Price</th>
                                        <td>{{$content->price??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Product Category</th>
                                        <td>{{$content->category->name ?? ''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Product Description</th>
                                        <td>{{$content->description??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Product State</th>
                                        <td>{{$content->state->name ??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Product County</th>
                                        <td>{{$content->county->name??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Product Zipcode</th>
                                        <td>{{$content->zipcode??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Gallery</th>
                                        @php
                                            $gallery_images = $content->get_all_images();
                                        @endphp
                                        <td>
                                            <div class="row">
                                                @foreach($gallery_images as $gallery_image)
                                                    <div class="col-md-3">
                                                        <img src="{{$gallery_image->getUrl()}}" alt="" height="150">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
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
