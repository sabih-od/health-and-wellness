@extends('admin.layouts.app')
@section('title', (isset($content->id) ?  'Edit' : 'Add').' Course')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Course Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Course Form</li>
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
                                <h3 class="card-title">Course</h3>
                            </div>
                            <form class="course-form" method="post"
                                  action="{{!empty($content->id)?url('admin/course/edit/'.$content->id):route('admin.add.course')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @if(Session::has('msg'))
                                        <div class="alert alert-success">{{Session::get('msg')}}</div>
                                    @endif
                                    <div class="form-group">
                                        <label for="name">Course Title</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="title" id="name" value="{{$content->course_title?? old('name')}}"
                                               placeholder="Course Title" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Course Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  name="description" id="description" placeholder="Course Description"
                                                  required>{{$content->course_description ?? old('description')}}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Course Category</label>
                                        <select
                                            class="form-control @error('description') is-invalid @enderror"
                                            name="category_id" id="price_detail" placeholder="Course Category"
                                        >
                                            <option selected>Select Category</option>

                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"
                                                        @if($category->id == (isset($content->category_id) ? $content->category_id : 1)) selected @endif>
                                                    {{ $category->category ?? '' }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Course Time Detail</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="time_detail" id="name"
                                               value="{{$content->time_detail?? old('name')}}"
                                               placeholder="Course Time Detail" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="fees">Course Price</label>
                                        <input type="number" step="0.01"
                                               class="form-control @error('fees') is-invalid @enderror" name="price"
                                               id="fees" value="{{$content->price?? old('fees')}}" placeholder="0.00"
                                        >
                                        @error('fees')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Course Attachment</label>

                                        <div class="img-upload full-width-img">
                                            <div id="image-preview" class="img-preview">

                                                @if(isset($content))

                                                    @php
                                                        $media = $content->getMedia('course_attachment')->first();
                                                    @endphp

                                                    @if ($media)
                                                        @if (strpos($media->mime_type, 'image') !== false)
                                                            <img id="preview-image" width="250"
                                                                 src="{{ $media->getUrl() }}"
                                                                 class="img-fluid serviceInner-img" alt="">
                                                        @elseif (strpos($media->mime_type, 'video') !== false)
                                                            <video id="preview-image" controls width="250"
                                                                   class="img-fluid serviceInner-img">
                                                                <source src="{{ $media->getUrl() }}"
                                                                        type="{{ $media->mime_type }}">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @else
                                                            <a href="{{ $media->getUrl() }}"
                                                               target="_blank"><i
                                                                    class="fas fa-file"></i>{{ $media->file_name }}</a>
                                                        @endif
                                                    @else
                                                        <img width="250" src="{{ asset('images/service.webp') }}"
                                                             class="img-fluid serviceInner-img" alt="">
                                                    @endif

                                                @else

                                                    <img id="preview-image"
                                                         src="{{ asset('images/user1.webp') }}"
                                                         width="250"
                                                         alt="Image Preview">

                                                @endif
                                            </div>
                                            <input type="file" name="attachment" class="img-upload" id="image-upload">
                                        </div>


                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                    <a href="{{route('admin.courses')}}" class="btn btn-warning btn-md">Cancel</a>
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

    {{--    <script>--}}
    {{--        $(document).ready(function () {--}}
    {{--            //init daterange--}}
    {{--            var date_range_el = $('#date_range');--}}
    {{--            var date_range_time_from_el = $('#input_date_range_time_from');--}}
    {{--            var date_range_time_to_el = $('#input_date_range_time_to');--}}
    {{--            date_range_el.daterangepicker();--}}

    {{--            //populate date_range--}}
    {{--            var edit_check = `<?php echo(empty($content->id) || empty($content->date_range)); ?>`;--}}
    {{--            if (edit_check) {--}}
    {{--                date_range_el.val('');--}}
    {{--                date_range_time_from_el.val('');--}}
    {{--                date_range_time_to_el.val('');--}}
    {{--            }--}}

    {{--            //populate schedule types--}}

    {{--            //empty date_range value on cancel click--}}
    {{--            date_range_el.on('cancel.daterangepicker', function (ev, picker) {--}}
    {{--                date_range_el.val('');--}}
    {{--            });--}}

    {{--            //on add custom date--}}
    {{--            $('.btn_add_custom_dates').on('click', function () {--}}
    {{--                $('.custom_dates_inner_wrapper')--}}
    {{--                    .append(`<div>--}}
    {{--                            <input type="date" class="input_custom_dates" name="custom_dates[]" required>--}}
    {{--                            <input type="time" class="input_time_from" name="time_froms[]" required>--}}
    {{--                            <input type="time" class="input_time_to" name="time_tos[]" required>--}}
    {{--                            <input type="button" class="btn btn-danger btn-sm btn_remove_custom_dates" value="-" style="margin-top: 10px;margin-bottom: 10px;">--}}
    {{--                        </div>`);--}}
    {{--            });--}}

    {{--            //on remove custom date--}}
    {{--            $('body').on('click', '.btn_remove_custom_dates', function () {--}}
    {{--                if ($('.input_custom_dates').length > 1) {--}}
    {{--                    $(this).parent().remove();--}}
    {{--                }--}}
    {{--            });--}}

    {{--            //on schedule type select--}}
    {{--            $('.input_schedule_types').on('change', function () {--}}
    {{--                let val = $(this).val();--}}
    {{--                let date_range_input = $('#date_range');--}}
    {{--                let date_range_time_from_input = $('#input_date_range_time_from');--}}
    {{--                let date_range_time_to_input = $('#input_date_range_time_to');--}}
    {{--                let custom_date_inputs = $('.input_custom_dates');--}}
    {{--                let date_range_wrapper = $('.date_range_wrapper');--}}
    {{--                let custom_dates_wrapper = $('.custom_dates_wrapper');--}}
    {{--                let custom_dates_inner_wrapper = $('.custom_dates_inner_wrapper');--}}

    {{--                if (val === 'date_range') {--}}
    {{--                    date_range_input.prop('required', true);--}}
    {{--                    date_range_time_from_input.prop('required', true);--}}
    {{--                    date_range_time_to_input.prop('required', true);--}}
    {{--                    date_range_el.val('')--}}
    {{--                    date_range_time_from_el.val('');--}}
    {{--                    date_range_time_to_el.val('');--}}
    {{--                    custom_dates_inner_wrapper.html('');--}}
    {{--                    date_range_wrapper.prop('hidden', false);--}}
    {{--                    custom_dates_wrapper.prop('hidden', true);--}}
    {{--                }--}}

    {{--                if (val === 'custom_dates') {--}}
    {{--                    date_range_input.prop('required', false);--}}
    {{--                    date_range_time_from_input.prop('required', false);--}}
    {{--                    date_range_time_to_input.prop('required', false);--}}
    {{--                    date_range_el.val('')--}}
    {{--                    date_range_time_from_el.val('');--}}
    {{--                    date_range_time_to_el.val('');--}}
    {{--                    custom_dates_inner_wrapper--}}
    {{--                        .html(`<div>--}}
    {{--                                <input type="date" class="input_custom_dates" name="custom_dates[]" required>--}}
    {{--                                <input type="time" class="input_time_from" name="time_froms[]" required>--}}
    {{--                                <input type="time" class="input_time_to" name="time_tos[]" required>--}}
    {{--                                <input type="button" class="btn btn-danger btn-sm btn_remove_custom_dates" value="-" style="margin-top: 10px;margin-bottom: 10px;">--}}
    {{--                            </div>`);--}}
    {{--                    date_range_wrapper.prop('hidden', true);--}}
    {{--                    custom_dates_wrapper.prop('hidden', false);--}}
    {{--                }--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection
