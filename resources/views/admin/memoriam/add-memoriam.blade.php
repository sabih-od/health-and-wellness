@extends('admin.layouts.app')
@section('title', (isset($content->id) ?  'Edit' : 'Add').' Memoriam')

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
                        <h1>Memoriam Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Memoriam Form</li>
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
                                <h3 class="card-title">Memoriam</h3>
                            </div>
                            <form class="memoriam-form" method="post" action="{{!empty($content->id)?url('admin/memoriam-edit/'.$content->id):route('admin.add-memoriam')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @if(Session::has('msg'))
                                        <div class="alert alert-success">{{Session::get('msg')}}</div>
                                    @endif

                                    <div class="form-group">
                                        <label for="name">Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

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
                                        <label for="name">Age</label>
                                        <input type="number" step="1" class="form-control @error('age') is-invalid @enderror" name="age" id="age" value="{{$content->age?? old('age')}}" required>
                                        @error('age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

{{--                                    <div class="form-group">--}}
{{--                                        <label for="name">Birth Date</label>--}}
{{--                                        <input type="date" class="form-control @error('birth') is-invalid @enderror" name="birth" id="birth" value="{{$content->birth?? old('birth')}}" required>--}}
{{--                                        @error('birth')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}

                                    <div class="form-group">
                                        <label for="name">End of Watch</label>
                                        <input type="date" class="form-control @error('death') is-invalid @enderror" name="death" id="death" value="{{$content->death?? old('death')}}" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}" required>
                                        @error('death')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" required>{{isset($content) && !is_null($content->description) ? $content->description : ''}}</textarea>
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
                                    <a href="{{route('memoriam')}}" class="btn btn-warning btn-md">Cancel</a>
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
            }
        });
    </script>
@endsection
