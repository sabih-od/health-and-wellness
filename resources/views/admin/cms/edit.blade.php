@extends('admin.layouts.app')
@section('title', 'CMS')
@section('section')
    <style>
        .img-upload #image-preview {
            width: 240px;
            height: 240px;
            border: 1px dashed #000;
            color: #ecf0f1;
            position: relative;
            background-repeat: no-repeat !important;
            background-position: center !important;
        }

        .img-upload #image-preview input {
            width: 120px;
            height: 40px;
            z-index: 10;
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translateX(-50%);
            margin-left: 0px;
            cursor: pointer;
            opacity: 0;
        }

        .img-upload #image-preview label {
            padding: 0px;
            z-index: 5;
            width: 130px;
            height: 40px;
            background-color: #ffffff;
            color: #143250;
            font-size: 14px;
            line-height: 40px;
            top: 60%;
            left: 50%;
            transform: translateX(-50%);
            right: 0;
            margin-left: 0px;
            bottom: 0px;
            margin-bottom: 0px;
            text-align: center;
            position: absolute;
            cursor: pointer;
            -webkit-transition: all 0.3s ease-in;
            -o-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
            /* box-shadow: 0px 0px 15px #eaeaea; */
            box-shadow: 0px 0px 10px rgb(0 0 0 / 10%);
        }

        label {
            display: inline-block;
            margin-bottom: 0.5rem;
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>CMS Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">CMS Page</li>
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
                                <h3 class="card-title">CMS Page</h3>
                            </div>

                            @foreach($content as $key => $value)
                                <form method="POST" action="{{ route('admin.cms.update', $key) }}"
                                      enctype="multipart/form-data">
                                    @csrf()
                                    <div title="{{ ucwords($key) }} Section" class="card-body">
                                        <div slot="body">
                                            @foreach($value as $value)
                                                @if($value['type'] === 'text')
                                                    @php $name = ''; @endphp
                                                    @foreach(explode('>', $value['heading']) as $hValue)
                                                        <label for="">
                                                            @php $name .= '['.trim($hValue).']'; @endphp
                                                        </label>
                                                    @endforeach
                                                    <div class="form-group">
                                                        <label for="page_title"
                                                               class="required">{{ ucwords($value['heading']) }}</label>
                                                        <input type="hidden" name="section{{$name.'[type]'}}"
                                                               value="text" class="form-control">
                                                        <input type="text"
                                                               name="section{{$name.'[value]'}}"
                                                               value="{{ $value['value'] }}" class="form-control">
                                                    </div>
                                                @endif
                                                @if($value['type'] === 'image')
                                                    @php $name = ''; @endphp
                                                    @foreach(explode('>', $value['heading']) as $hValue)
                                                        @php $name .= '['.trim($hValue).']'; @endphp
                                                    @endforeach
                                                    <div class="col-md-12 mt-3">
                                                        <label class='required'>{{ ucwords($value['heading']) }}</label>
                                                        <div class="img-upload">
                                                            {{--                                                        <span--}}
                                                            {{--                                                            class="control-info mt-10">{{ __('admin::app.settings.sliders.image-size') }}</span>--}}
                                                            <div id="image-preview" class="img-preview"
                                                                 style="background: url({{asset($value['value'])}});">
                                                                <input type='hidden' name='section{{$name.'[type]'}}'
                                                                       value='image'>
                                                                <input type="hidden" name='section{{$name.'[value][image_0]'}}' value="{{$value['value']}}">
                                                                <label for="image-upload" class="img-label"
                                                                       id="image-label">{{ __('Upload Image') }}</label>
                                                                <input type="file" name='section{{$name.'[value][image_0]'}}' class="img-upload">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($value['type'] === 'html')
                                                    @php $name = ''; @endphp
                                                    @foreach(explode('>', $value['heading']) as $hValue)
                                                        @php $name .= '['.trim($hValue).']'; @endphp
                                                    @endforeach
                                                    <div class=" form-group">
                                                        <label for="page_title"
                                                               class="required">{{ ucwords($value['heading']) }}</label>
                                                        <input type="hidden" name="section{{$name.'[type]'}}"
                                                               value="html">
                                                        <textarea type="text" class="form-control"
                                                                  name="section{{$name.'[value]'}}">{{ $value['value'] }}</textarea>
                                                    </div>
                                                @endif
                                            @endforeach
                                            <button type="submit" class="btn btn-lg btn-primary mt-2">Update Section</button>
                                        </div>
                                    </div>
                                </form>
                            @endforeach

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('front/js/nicEdit.js')}}"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function () {
            nicEditors.allTextAreas()
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            // IMAGE UPLOADING :)
            $(".img-upload").on("change", function () {
                var imgpath = $(this).parent();
                var file = $(this);
                readURL(this, imgpath);
            });

            function readURL(input, imgpath) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        imgpath.css('background', 'url(' + e.target.result + ')');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });


    </script>
@endsection
