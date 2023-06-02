@extends('admin.layouts.app')
@section('title', (isset($content->name) ? $content->name : ''). ' Forum Topic')
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
                        <li class="breadcrumb-item active">Forum Topic Detail</li>
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
                            <h3 class="card-title">Forum Topic Detail</h3>
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
                                        <th>Title</th>
                                        <td>{{$content->title??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Author</th>
                                        <td>{{$content->user->first_name .' '. $content->user->last_name}}</td>
                                    </tr>

                                    <tr>
                                        <th>Category</th>
                                        <td>{{$content->forum_category->name??''}}</td>
                                    </tr>

                                    <tr>
                                        <th>Title</th>
                                        <td>{{$content->description??''}}</td>
                                    </tr>

                                    <tr>
                                        <th colspan="2">Comments</th>
                                    </tr>
                                    @foreach($content->forum_comments as $forum_comment)
                                        @php
                                            if($forum_comment->user->role_id == 1) {
                                                $name = $forum_comment->user->name;
                                            } else {
                                                $name = $forum_comment->user->first_name . ' ' . $forum_comment->user->last_name;
                                            }
                                        @endphp
                                        <tr>
                                            <td colspan="2" class="text-left">
                                                {{$forum_comment->content}}
                                                <br />
                                                -{{$name}} ({{getPresentableDateTime($forum_comment->created_at)}})
                                            </td>
                                        </tr>
                                    @endforeach
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
