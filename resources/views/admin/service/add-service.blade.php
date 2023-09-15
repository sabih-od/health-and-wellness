@extends('admin.layouts.app')
@section('title', (isset($content->id) ?  'Edit' : 'Add').' Service')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Service Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Service Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Service</h3>
                            </div>
                            <form class="service-form" method="post"
                                  action="{{!empty($content->id)?url('admin/service-edit/'.$content->id):route('admin.add-service')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @if(Session::has('msg'))
                                        <div class="alert alert-success">{{Session::get('msg')}}</div>
                                    @endif
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name" id="name" value="{{$content->name?? old('name')}}"
                                               placeholder="Service">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Service Image</label>

                                        <div class="img-upload full-width-img">
                                            <div id="image-preview" class="img-preview">
                                                <img id="preview-image"
                                                     src="{{ isset($content) ? $content->get_service_picture() :  asset('images/user1.webp') }}"
                                                     width="150" alt="Image Preview">
                                            </div>
                                            <input type="file" name="image" class="img-upload" id="image-upload">
                                        </div>


                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Pricing Detail</label>
                                        <input type="text"
                                               class="form-control @error('pricing_detail') is-invalid @enderror"
                                               name="pricing_detail" id="name"
                                               value="{{$content->pricing_detail?? old('pricing_detail')}}"
                                               placeholder="Service" required>
                                        @error('pricing_detail')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Description</label>
                                        <textarea id="editor" class="@error('description') is-invalid @enderror"
                                                  name="description" required>  {{$content->description?? old('description')}}
                                        </textarea>

                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                    <a href="{{route('service')}}" class="btn btn-warning btn-md">Cancel</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')

    <script>
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function () {
                var image = document.getElementById('preview-image');
                image.src = reader.result;
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            } else {
                // If there is no file selected, you can set a default image URL here
                var defaultImageUrl = "{{asset('dashboard/images/user.png')}}";
                var image = document.getElementById('preview-image');
                image.src = defaultImageUrl;
            }
        }

        var imageUpload = document.getElementById('image-upload');
        imageUpload.addEventListener('change', previewImage);
    </script>

    <script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>

    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
