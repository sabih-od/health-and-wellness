@extends('admin.layouts.app')
@section('title', (isset($content->name) ? $content->name : ''). ' Business Listing')
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
                        <li class="breadcrumb-item active">Business Listing Detail</li>
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
                            <h3 class="card-title">Business Listing Detail</h3>
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
                                        <th>Logo</th>
                                        <td>
                                            <img src="{{$content->getMedia('business_listing_logos')->first() ? $content->getMedia('business_listing_logos')->first()->getUrl() : asset('front/images/logo.png')}}" height="80">
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Name</th>
                                        <td>{{$content->name??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Main Category</th>
                                        <td>{{$content->main_category??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Business Category</th>
                                        <td>{{$content->category->name??''}}</td>
                                    </tr>

                                    @if($content->business_state)
                                        <tr>
                                            <th>Business State</th>
                                            <td>{{$content->business_state->name}} ({{$content->business_state->full_name}})</td>
                                        </tr>
                                    @endif

                                    @if($content->city)
                                        <tr>
                                            <th>County</th>
                                            <td>{{$content->city->name??''}}</td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th>Zipcode</th>
                                        <td>{{$content->zipcode??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Address</th>
                                        <td>{{$content->address??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Number</th>
                                        <td>{{$content->number??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Business Description</th>
                                        <td>{{$content->business_description??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Service Description</th>
                                        <td>{{$content->service_description??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Services Offered To</th>
                                        <td>{{$content->getMultiSelectPresentableData('services_offered_to')??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>ID Needed</th>
                                        <td>{{$content->getMultiSelectPresentableData('id_needed')??''}}</td>
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
