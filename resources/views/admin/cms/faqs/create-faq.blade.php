@extends('admin.layouts.app')
@section('title', (isset($content->id) ?  'Edit' : 'Add').' Service')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>FAQ's Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">FAQ's Form</li>
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
                                <h3 class="card-title">FAQ's</h3>
                            </div>
                            <form class="service-form" method="post" action="{{ route('admin.add.faq') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @if(Session::has('msg'))
                                        <div class="alert alert-success">{{Session::get('msg')}}</div>
                                    @endif
                                    <div class="form-group">
                                        <label for="name">Question</label>
                                        <input type="text" class="form-control @error('question') is-invalid @enderror" name="question" id="name" value="{{$content->question?? old('question')}}" placeholder="Question" required>
                                        @error('question')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                        <div class="form-group">
                                            <label for="name">Answer</label>
                                            <input type="text" class="form-control @error('answer') is-invalid @enderror" name="answer" id="name" value="{{$content->answer?? old('answer')}}" placeholder="Answer" required>
                                            @error('answer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    <div class="form-group">
{{--                                        <label for="name">Image</label>--}}
{{--                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" required>--}}
{{--                                        @error('image')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                                        @enderror--}}

                                        <div class="img-upload full-width-img">
                                            <div id="image-preview" class="img-preview">
                                                <img id="preview-image" src="{{ asset('images/user1.webp') }}" width="150" alt="Image Preview">
                                            </div>
                                            <input type="file" name="image" class="img-upload" id="image-upload">
                                        </div>

                                    </div>

{{--                                    <div class="form-group">--}}
{{--                                        <label for="name">Description</label>--}}
{{--                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="" cols="30" rows="10" required>--}}
{{--                                            {{$content->description?? old('description')}}--}}
{{--                                        </textarea>--}}
{{--                                        @error('description')--}}
{{--                                            <span class="invalid-feedback" role="alert">--}}
{{--                                                <strong>{{ $message }}</strong>--}}
{{--                                            </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                    <a href="{{route('faq')}}" class="btn btn-warning btn-md">Cancel</a>
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

            reader.onload = function() {
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

{{--    <script>--}}
{{--        $(document).ready(function(){--}}

{{--        });--}}
{{--    </script>--}}
@endsection
