@extends('admin.layouts.app')
@section('title', (isset($content->id) ?  'Edit' : 'Add').' Service')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Session Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Session Form</li>
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
                                <h3 class="card-title">Session</h3>
                            </div>
                            <form class="service-form" method="post"
                                  action="{{!empty($content->id)?url('admin/session-edit/'.$content->id):route('admin.add-session')}}"
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
                                               placeholder="Name" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Fees</label>
                                        <input type="number" class="form-control @error('fees') is-invalid @enderror"
                                               name="fees" id="name" value="{{$content->fees?? old('fees')}}"
                                               placeholder="Fees" required>
                                        @error('fees')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Services</label>
                                        <select class="form-control @error('service_id') is-invalid @enderror"
                                                name="service_id">
                                            <option selected disabled hidden> Select service</option>
                                            @foreach($services as $service)
                                                <option value="{{$service->id}}" @if( $service->id == isset($content->service_id)) selected @endif>{{ $service->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('service_id')
                                        <span class="invalid-feedback"
                                              role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Session Date</label>
                                        <input type="date"
                                               class="form-control @error('session_date') is-invalid @enderror"
                                               name="session_date" id="name"
                                               value="{{$content->date?? old('session_date')}}"
                                               placeholder="Service" required>
                                        @error('session_date')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    @php
                                        if(isset($content->session_time))
                                        {
                                                $timeParts = explode(' - ', $content->session_time);
                                                $startTime = $timeParts[0];
                                                $endTime = $timeParts[1];
                                        }
                                    @endphp

                                    <div class="form-group d-flex justify-content-between">
                                        <div class="w-50">
                                            <label for="name">Session Start Time</label>
                                            <input type="time"
                                                   class="form-control @error('session_start_time') is-invalid @enderror"
                                                   name="session_start_time" id="name"
                                                   value="{{$startTime ?? old('session_start_time')}}"
                                                   placeholder="Service" required>
                                            @error('session_start_time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="w-50 ml-2">
                                            <label for="name">Session End Time</label>
                                            <input type="time"
                                                   class="form-control @error('session_end_time') is-invalid @enderror"
                                                   name="session_end_time" id="name"
                                                   value="{{$endTime ?? old('session_end_time')}}"
                                                   placeholder="Service" required>
                                            @error('session_end_time')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label for="name">Session Image</label>
                                        {{--                                        <input type="file"--}}
                                        {{--                                               name="image" id="image" required>--}}
                                        <div class="img-upload full-width-img">
                                            <div id="image-preview" class="img-preview">
                                                @if(isset($content))
                                                <img id="preview-image"
                                                     src="{{  $content->get_session_picture() }}"
                                                     width="150" alt="Image Preview">
                                                    @endif
                                            </div>
                                            <input type="file" name="image" class="img-upload" id="image-upload"
                                                   class="form-control @error('image') is-invalid @enderror">
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
                                    <a href="{{route('session')}}" class="btn btn-warning btn-md">Cancel</a>
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
        $(document).ready(function () {

        });
    </script>
@endsection
