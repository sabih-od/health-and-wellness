@extends('admin.layouts.app')
@section('title', (isset($content->id) ?  'Edit' : 'Add').' Business Listing')

@section('page_css')
    {{--select2 css--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Business Listing Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Business Listing Form</li>
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
                                <h3 class="card-title">Business Listing</h3>
                            </div>
                            <form class="business_listing-form" method="post" action="{{!empty($content->id)?url('admin/business_listing-edit/'.$content->id):route('admin.add-business_listing')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @if(Session::has('msg'))
                                        <div class="alert alert-success">{{Session::get('msg')}}</div>
                                    @endif

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$content->name?? old('name')}}" placeholder="Name" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Business Name</label>
                                        <input type="text" class="form-control @error('business_name') is-invalid @enderror" name="business_name" id="business_name" value="{{$content->business_name?? old('business_name')}}" placeholder="Business Name" required>
                                        @error('business_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Main Category</label>
                                        <select class="form-control @error('main_category') is-invalid @enderror" name="main_category" id="main_category" required>
                                            <option value="">Select Main Category</option>
                                            <option value="Hero 2 Hero" {!! isset($content) && $content->main_category == 'Hero 2 Hero' ? 'selected' : '' !!}>Hero 2 Hero</option>
                                            <option value="Friends Of Public Safety-Local" {!! isset($content) && $content->main_category == 'Friends Of Public Safety-Local' ? 'selected' : '' !!}>Friends Of Public Safety-Local</option>
                                            <option value="Friends Of Public Safety-National" {!! isset($content) && $content->main_category == 'Friends Of Public Safety-National' ? 'selected' : '' !!}>Friends Of Public Safety-National</option>
                                        </select>
                                        @error('main_category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Business Category</label>
                                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id" required>
                                            <option value="">Select Business Category</option>
                                            @foreach($categories as $category)
                                                <option data-main-category="{{$category->main_category}}" value="{{$category->id}}" {!! isset($content) && $content->category_id == $category->id ? 'selected' : '' !!}>
                                                    {{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Logo</label>
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" id="logo">
                                        @error('logo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Address Line 1</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address">{{isset($content) && !is_null($content->address) ? $content->address : ''}}</textarea>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">State</label>
                                        <select class="form-control @error('business_state_id') is-invalid @enderror" name="business_state_id" id="business_state_id" required>
                                            <option value="">Select State</option>
                                            @foreach($business_states as $business_state)
                                                <option data-state="{{$business_state->state_id}}" value="{{$business_state->id}}" {!! isset($content) && $content->business_state_id == $business_state->id ? 'selected' : '' !!}>
                                                    {{$business_state->name}} ({{$business_state->full_name}})</option>
                                            @endforeach
                                        </select>
                                        @error('business_state_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">County</label>
                                        <select class="form-control @error('city_id') is-invalid @enderror" name="city_id" id="city_id" required>
                                            <option value="">Select County</option>
                                        </select>
                                        @error('city_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name" id="label_zipcode_website">Website</label>
                                        <input type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" id="zipcode" value="{{$content->zipcode?? old('zipcode')}}" placeholder="Website">
                                        @error('zipcode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Number</label>
                                        <input type="text" class="form-control @error('number') is-invalid @enderror" name="number" id="number" value="{{$content->number?? old('number')}}" placeholder="Number">
                                        @error('number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Business Description</label>
                                        <textarea class="form-control @error('business_description') is-invalid @enderror" name="business_description" id="business_description">{{isset($content) && !is_null($content->business_description) ? $content->business_description : ''}}</textarea>
                                        @error('business_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Service Description</label>
                                        <textarea class="form-control @error('service_description') is-invalid @enderror" name="service_description" id="service_description">{{isset($content) && !is_null($content->service_description) ? $content->service_description : ''}}</textarea>
                                        @error('service_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Services Offered To</label>
                                        <select class="form-control @error('services_offered_to') is-invalid @enderror" name="services_offered_to[]" id="services_offered_to" multiple="multiple">
                                            <option value="FIRE" {!! isset($content) && $content->services_offered_to == 'FIRE' ? 'selected' : '' !!}>FIRE</option>
                                            <option value="EMS" {!! isset($content) && $content->services_offered_to == 'EMS' ? 'selected' : '' !!}>EMS</option>
                                            <option value="LEO" {!! isset($content) && $content->services_offered_to == 'LEO' ? 'selected' : '' !!}>LEO</option>
                                        </select>
                                        @error('services_offered_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">ID Needed</label>
                                        <select class="form-control @error('id_needed') is-invalid @enderror" name="id_needed[]" id="id_needed" multiple="multiple">
                                            <option value="Government Issued ID" {!! isset($content) && $content->id_needed == 'Government Issued ID' ? 'selected' : '' !!}>Government Issued ID</option>
                                            <option value="On Duty/In Uniform" {!! isset($content) && $content->id_needed == 'On Duty/In Uniform' ? 'selected' : '' !!}>On Duty/In Uniform</option>
                                            <option value="Departmental ID" {!! isset($content) && $content->id_needed == 'Departmental ID' ? 'selected' : '' !!}>Departmental ID</option>
                                            <option value="ID.me Account" {!! isset($content) && $content->id_needed == 'ID.me Account' ? 'selected' : '' !!}>ID.me Account</option>
                                            <option value="GovX Account" {!! isset($content) && $content->id_needed == 'GovX Account' ? 'selected' : '' !!}>GovX Account</option>
                                            <option value="SheerID" {!! isset($content) && $content->id_needed == 'SheerID' ? 'selected' : '' !!}>SheerID</option>
                                            <option value="Any Honor 2 Honor Member" {!! isset($content) && $content->id_needed == 'Any Honor 2 Honor Member' ? 'selected' : '' !!}>Any Honor 2 Honor Member</option>
                                        </select>
                                        @error('id_needed')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Status</label>
                                        <select class="form-control @error('affiliation_dropdown') is-invalid @enderror" name="affiliation_dropdown[]" id="affiliation_dropdown" multiple="multiple">
                                            <option value="Career" {!! isset($content) && $content->affiliation_dropdown == 'Career' ? 'selected' : '' !!}>Career</option>
                                            <option value="Volunteer" {!! isset($content) && $content->affiliation_dropdown == 'Volunteer' ? 'selected' : '' !!}>Volunteer</option>
                                            <option value="Active" {!! isset($content) && $content->affiliation_dropdown == 'Active' ? 'selected' : '' !!}>Active</option>
                                            <option value="Retired" {!! isset($content) && $content->affiliation_dropdown == 'Retired' ? 'selected' : '' !!}>Retired</option>
                                        </select>
                                        @error('affiliation_dropdown')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                                    <a href="{{route('business_listing')}}" class="btn btn-warning btn-md">Cancel</a>
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
    {{--select2 js--}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            var isEdit = '{{isset($content)}}';
            isEdit = (isEdit == 1);

            //init multiselect elements
            $('#services_offered_to').select2();
            $('#id_needed').select2();
            $('#affiliation_dropdown').select2();

            if(isEdit) {
                //category populate
                populateCategories();

                //city populate if edit
                var city_id = '{{isset($content) ? $content->city_id : null}}';
                getCitiesByState();
                setTimeout(function() {
                    $('#city_id option[value="'+city_id+'"]').prop('selected', true);
                    $('#city_id').trigger('change');
                }, 1000);

                //services_offered_to
                var services_offered_to_items = '{{(isset($content) ? $content->services_offered_to : null)}}';
                services_offered_to_items = services_offered_to_items.replace(/&quot;/gi,"\"").replace(/\[/gi,"").replace(/\]/gi,"").split(',');
                services_offered_to_items.forEach(function(item) {
                    var newOption = new Option(item.replace('"', '').slice(0, -1), item.replace('"', '').slice(0, -1), true, true);
                    $("#services_offered_to option[value='"+item.replace('"', '').slice(0, -1)+"']").remove();
                    $('#services_offered_to').append(newOption);
                });
                $('#services_offered_to').trigger('change');

                //id_needed
                var id_needed_items = '{{(isset($content) ? $content->id_needed : null)}}';
                id_needed_items = id_needed_items.replace(/&quot;/gi,"\"").replace(/\[/gi,"").replace(/\]/gi,"").split(',');
                id_needed_items.forEach(function(item) {
                    var newOption = new Option(item.replace('"', '').slice(0, -1), item.replace('"', '').slice(0, -1), true, true);
                    $("#id_needed option[value='"+item.replace('"', '').slice(0, -1)+"']").remove();
                    $('#id_needed').append(newOption);
                });
                $('#id_needed').trigger('change');

                //affiliation_dropdown
                var affiliation_dropdown_items = '{{(isset($content) ? $content->affiliation_dropdown : null)}}';
                affiliation_dropdown_items = affiliation_dropdown_items.replace(/&quot;/gi,"\"").replace(/\[/gi,"").replace(/\]/gi,"").split(',');
                affiliation_dropdown_items.forEach(function(item) {
                    var newOption = new Option(item.replace('"', '').slice(0, -1), item.replace('"', '').slice(0, -1), true, true);
                    $("#affiliation_dropdown option[value='"+item.replace('"', '').slice(0, -1)+"']").remove();
                    $('#affiliation_dropdown').append(newOption);
                });
                $('#affiliation_dropdown').trigger('change');
            }

            //on business state change
            $('#business_state_id').on('change', function() {
                getCitiesByState();
            });

            //on main_category change
            $('#main_category').on('change', function() {
                populateCategories();
            });

            function getCitiesByState() {
                $('#city_id').html('<option value="">Select City</option>');
                if($('#business_state_id').val() == '') {
                    return
                }

                var url = '{{route('admin.getCityByStates', 'temp')}}';
                var selectedEl = $('#business_state_id').find(":selected");
                url = url.replace('temp', selectedEl.data('state'));
                $.ajax({
                    url: url,
                    type: 'GET',
                    type: 'GET',
                    success: function(data) {
                        data.forEach(function(item) {
                            $('#city_id').append('<option value="'+item.id+'">'+item.name+'</option>');
                        });
                    },
                    error: function() {

                    }
                });
            }

            function populateCategories() {
                let value = $('#main_category').val();

                $('#category_id option').each(function() {
                    if($(this).data('main-category') != value) {
                        $(this).prop('hidden', true);
                    } else {
                        $(this).prop('hidden', false);
                    }
                });
                $('#category_id').trigger('change');

                //optional fields for fops-N
                let required_fields_ids = [
                    '#name',
                    '#business_name',
                    '#main_category',
                    '#category_id',
                    // '#address',
                    '#business_state_id',
                    '#city_id',
                    // '#zipcode',
                    // '#number',
                    // '#business_description',
                    // '#service_description',
                    // '#services_offered_to',
                    // '#id_needed',
                    // '#affiliation_dropdown',
                ];
                let national_optional_fields_ids = [
                    '#business_state_id',
                    '#city_id',
                    '#number',
                    '#name',
                    '#business_name',
                    '#category_id',
                ];
                let check = !(value === 'Friends Of Public Safety-National');
                required_fields_ids.forEach(function (item) {
                    $(item).prop('required', true);
                });
                national_optional_fields_ids.forEach(function (item) {
                    $(item).prop('required', check);
                });

                $('#label_zipcode_website').html(value === 'Friends Of Public Safety-National' ? 'Website' : 'Zipcode');
                $('#zipcode').prop('placeholder', value === 'Friends Of Public Safety-National' ? 'Website' : 'Zipcode');
            }
        });
    </script>
@endsection
