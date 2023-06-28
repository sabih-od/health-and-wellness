@extends('admin.layouts.app')
@section('title', (isset($content->id) ?  'Edit' : 'Add').' Customer')
@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customer Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Customer Form</li>
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
                                <h3 class="card-title">Customer</h3>
                            </div>
                            <form class="customer-form" method="post" action="{{!empty($content->id)?url('admin/customer-edit/'.$content->id):route('admin.add-customer')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @if(Session::has('msg'))
                                        <div class="alert alert-success">{{Session::get('msg')}}</div>
                                    @endif
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{$content->first_name?? old('first_name')}}" placeholder="First Name" required>
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{$content->last_name?? old('last_name')}}" placeholder="Last Name" required>
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{$content->email?? old('email')}}" placeholder="Email" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{$content->phone?? old('phone')}}" placeholder="Phone" required>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" value="{{$content->address?? old('address')}}" placeholder="Address" required>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Zipcode</label>
                                        <input type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" id="zipcode" value="{{$content->zipcode?? old('zipcode')}}" placeholder="Zipcode" required>
                                        @error('zipcode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                                        @error('assword')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                    <a href="{{route('customer')}}" class="btn btn-warning btn-md">Cancel</a>
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
        $(document).ready(function(){
            //init daterange
            var date_range_el = $('#date_range');
            var date_range_time_from_el = $('#input_date_range_time_from');
            var date_range_time_to_el = $('#input_date_range_time_to');
            date_range_el.daterangepicker();

            //populate date_range
            var edit_check = `<?php echo(empty($content->id) || empty($content->date_range)); ?>`;
            if(edit_check) {
                date_range_el.val('');
                date_range_time_from_el.val('');
                date_range_time_to_el.val('');
            }

            //populate schedule types

            //empty date_range value on cancel click
            date_range_el.on('cancel.daterangepicker', function(ev, picker) {
                date_range_el.val('');
            });

            //on add custom date
            $('.btn_add_custom_dates').on('click', function(){
                $('.custom_dates_inner_wrapper')
                .append(`<div>
                            <input type="date" class="input_custom_dates" name="custom_dates[]" required>
                            <input type="time" class="input_time_from" name="time_froms[]" required>
                            <input type="time" class="input_time_to" name="time_tos[]" required>
                            <input type="button" class="btn btn-danger btn-sm btn_remove_custom_dates" value="-" style="margin-top: 10px;margin-bottom: 10px;">
                        </div>`);
            });

            //on remove custom date
            $('body').on('click', '.btn_remove_custom_dates', function(){
                if($('.input_custom_dates').length > 1) {
                    $(this).parent().remove();
                }
            });

            //on schedule type select
            $('.input_schedule_types').on('change', function() {
                let val = $(this).val();
                let date_range_input = $('#date_range');
                let date_range_time_from_input = $('#input_date_range_time_from');
                let date_range_time_to_input = $('#input_date_range_time_to');
                let custom_date_inputs = $('.input_custom_dates');
                let date_range_wrapper = $('.date_range_wrapper');
                let custom_dates_wrapper = $('.custom_dates_wrapper');
                let custom_dates_inner_wrapper = $('.custom_dates_inner_wrapper');

                if(val === 'date_range') {
                    date_range_input.prop('required', true);
                    date_range_time_from_input.prop('required', true);
                    date_range_time_to_input.prop('required', true);
                    date_range_el.val('')
                    date_range_time_from_el.val('');
                    date_range_time_to_el.val('');
                    custom_dates_inner_wrapper.html('');
                    date_range_wrapper.prop('hidden', false);
                    custom_dates_wrapper.prop('hidden', true);
                }

                if(val === 'custom_dates') {
                    date_range_input.prop('required', false);
                    date_range_time_from_input.prop('required', false);
                    date_range_time_to_input.prop('required', false);
                    date_range_el.val('')
                    date_range_time_from_el.val('');
                    date_range_time_to_el.val('');
                    custom_dates_inner_wrapper
                    .html(`<div>
                                <input type="date" class="input_custom_dates" name="custom_dates[]" required>
                                <input type="time" class="input_time_from" name="time_froms[]" required>
                                <input type="time" class="input_time_to" name="time_tos[]" required>
                                <input type="button" class="btn btn-danger btn-sm btn_remove_custom_dates" value="-" style="margin-top: 10px;margin-bottom: 10px;">
                            </div>`);
                    date_range_wrapper.prop('hidden', true);
                    custom_dates_wrapper.prop('hidden', false);
                }
            });
        });
    </script>
@endsection
