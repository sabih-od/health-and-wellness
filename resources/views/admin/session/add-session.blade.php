@extends('admin.layouts.app')
@section('title', (isset($content->id) ?  'Edit' : 'Add').' Session')
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
                                                <option value="{{$service->id}}"
                                                        @if($service->id == (isset($content->service_id) ? $content->service_id : 1)) selected @endif>
                                                    {{ $service->name ?? '' }}
                                                </option>
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

                                    {{--                                    @dd($content);--}}


                                    <div class="w-100 mt-3">
                                        @if(isset($content))
                                            <button id="duplicateEditButton" class="btn btn-primary float-right"
                                                    type="button">
                                                Additional Session Timing's
                                            </button>
                                        @else
                                            <button id="duplicateButton" class="btn btn-primary float-right"
                                                    type="button">
                                                Additional Session Timing's
                                            </button>
                                        @endif
                                    </div>

                                    <div id="originalDiv" style="margin-top:6%;">
                                        @if(isset($content) && count($content->sessionTimings) > 0 )
                                            @for($i = 0 ; $i < count($content->sessionTimings); $i++)
                                                {{--                                                @dump($content->sessionTimings[0])--}}

                                                @php
                                                    $timeParts = explode(' - ', $content->sessionTimings[$i]->session_time);
                                                    $startTime = $timeParts[0];
                                                    $endTime = $timeParts[1];
                                                $index = $content->sessionTimings[$i];

                                                @endphp


                                                <div id="containerDiv"
                                                     class="containerDiv_{{$content->sessionTimings[$i]->id}} form-group d-flex justify-content-between">
                                                    <div class="w-50">
                                                        <label for="name" style="margin-bottom: 14px;">Session Start
                                                            Time</label>
                                                        <input type="time"
                                                               onchange="checkFunction(this)"
                                                               class="form-control @error('session_start_time') is-invalid @enderror"
                                                               name="session_start_time[]" id="name"
                                                               value="{{$startTime ?? old('session_start_time')}}"
                                                               placeholder="Service" required>
                                                        @error('session_start_time')
                                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="w-50 ml-2">
                                                        <div class="d-flex justify-content-between">
                                                            <label for="name">Session End Time</label>
                                                            <button class="btn-sm btn-dark" type="button"
                                                                    style="margin-bottom: 6px;"
                                                                    onclick="removeTimeContainer(this)"> X
                                                            </button>
                                                        </div>

                                                        <input type="time"
                                                               onchange="checkFunction(this)"
                                                               class="form-control @error('session_end_time') is-invalid @enderror"
                                                               name="session_end_time[]" id="name"
                                                               value="{{$endTime ?? old('session_end_time')}}"
                                                               placeholder="Service" required>
                                                        @error('session_end_time')
                                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            @endfor

                                        @else
                                            <div id="containerDiv"
                                                 class="form-group d-flex justify-content-between">
                                                <div class="w-50">
                                                    <label for="name" style="margin-bottom: 14px;">Session Start
                                                        Time</label>
                                                    <input type="time"
                                                           class="form-control @error('session_start_time') is-invalid @enderror"
                                                           name="session_start_time[]" id="name"
                                                           value="{{$startTime ?? old('session_start_time')}}"
                                                           placeholder="Service" required>
                                                    @error('session_start_time')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>
                                                <div class="w-50 ml-2">
                                                    <div class="d-flex justify-content-between">
                                                        <label for="name">Session End Time</label>
                                                        <button class="btn-sm btn-dark" type="button"
                                                                style="margin-bottom: 6px;"
                                                                onclick="removeTimeContainer(this)"> X
                                                        </button>
                                                    </div>

                                                    <input type="time"
                                                           class="form-control @error('session_end_time') is-invalid @enderror"
                                                           name="session_end_time[]" id="name"
                                                           value="{{$endTime ?? old('session_end_time')}}"
                                                           placeholder="Service" required>
                                                    @error('session_end_time')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        @endif

                                    </div>


                                    <div class="form-group">
                                        <label for="name">Session Image</label>

                                        <div class="img-upload full-width-img">
                                            <div id="image-preview" class="img-preview">
                                                <img id="preview-image" src="{{ isset($content) ? $content->get_session_picture() :  asset('images/user1.webp') }}"
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

        function checkFunction(input) {
            var containerDiv = input.closest('div[class^="containerDiv_"]');
            var containerValue = containerDiv.getAttribute('class');
            var changedValue = input.value;
            var sessionTimeType = input.name;

            var containerDiv = input.closest('div[class^="containerDiv_"]');

            var containerValue = containerDiv.getAttribute('class');

            var sessionTimeId = containerValue.split('_')[1];

            $.ajax({
                url: "{{ route('updateSessionTime') }}",
                type: 'GET',
                data: {
                    sessionTimeId: sessionTimeId,
                    sessionTimeType: sessionTimeType,
                    changeTime: changedValue,
                },
                success: function (response) {
                    console.log("Response time:", response);
                    // Clear previous options

                    // if (response == false) {
                    //     toastr.error('Session Timing Is Booked')
                    // } else {
                    //     containerDiv.remove();
                    //
                    //     toastr.success('Session Timing Deleted Successfully')
                    //
                    // }

                },
                error: function (xhr, status, error) {
                    console.log("Error:", status, error);
                }
            });

        }

    </script>

    <script>
        function removeTimeContainer(button) {
            // Get the parent container div


            var containerDiv = button.closest('div[class^="containerDiv_"]');

            if (containerDiv) {

                var containerValue = containerDiv.getAttribute('class');

                var sessionTimeId = containerValue.split('_')[1];

                console.log("btn 11", containerValue, sessionTimeId)

                if (sessionTimeId) {

                    $.ajax({
                        url: "{{ route('deleteSessionTiming') }}",
                        type: 'GET',
                        data: {
                            sessionTimeId: sessionTimeId
                        },
                        success: function (response) {
                            console.log("Response time:", response);
                            // Clear previous options

                            if (response == false) {
                                toastr.error('Session Timing Is Booked')
                            } else {
                                containerDiv.remove();

                                toastr.success('Session Timing Deleted Successfully')

                            }

                        },
                        error: function (xhr, status, error) {
                            console.log("Error:", status, error);
                        }
                    });
                } else {
                    console.log("In");
                    var containerDiv = button.closest('div[id^="containerDiv_"]');

                    containerValue.remove();

                }
            } else {

                // var containerDivCount = $("#originalDiv").find("[id^='containerDiv']").length;
                //
                // if (containerDivCount < 2) {
                //     toastr.error('Each session should have one timings')
                //
                // } else {
                //     var containerDiv = button.closest('div[id^="containerDiv"]');
                //     containerDiv.remove();
                //
                // }

                var containerDiv = button.closest('div[id^="containerDiv"]');
                containerDiv.remove();

            }


            //FOR REMVOE FROM FRONT END
        }
    </script>

    <script>

        // Get references to the button and the container div
        const duplicateEditButton = document.getElementById('duplicateEditButton');

        if(duplicateEditButton != null){

            const containerDiv1 = document.getElementById('originalDiv');
            const label1 = document.querySelector('label[for="name"]');

            // Function to duplicate the original div
            function duplicateDiv() {


                // Clone the original div
                const originalDiv = document.getElementById('containerDiv');
                const clonedDiv = originalDiv.cloneNode(true);


                clonedDiv.classList.remove(clonedDiv.classList[0]);

                const clonedStartTimeInput = clonedDiv.querySelector('input[name="session_start_time[]"]');
                const clonedEndTimeInput = clonedDiv.querySelector('input[name="session_end_time[]"]');
                clonedStartTimeInput.value = '';
                clonedEndTimeInput.value = '';

                clonedStartTimeInput.setAttribute('name', 'session_start_time_cloned[]');
                clonedEndTimeInput.setAttribute('name', 'session_end_time_cloned[]');

                // Add event listener to the remove button
                // const removeButton = clonedDiv.querySelector('.removeButton');
                // removeButton.addEventListener('click', removeDiv);

                // Append the cloned div to the container
                containerDiv1.appendChild(clonedDiv);
            }

            // Function to remove the cloned div
            // function removeDiv(event) {
            //     const divToRemove = event.target.parentNode.parentNode.parentNode;
            //     divToRemove.remove();
            // }

            // Add event listener to the button
            duplicateEditButton.addEventListener('click', duplicateDiv);

        }

    </script>

    <script>

        // Get references to the button and the container div
        const duplicateButton = document.getElementById('duplicateButton');
        const containerDiv = document.getElementById('originalDiv');
        const label = document.querySelector('label[for="name"]');

        // Function to duplicate the original div
        function duplicateDiv() {


            // Clone the original div
            const originalDiv = document.getElementById('containerDiv');
            const clonedDiv = originalDiv.cloneNode(true);


            clonedDiv.classList.remove(clonedDiv.classList[0]);

            const clonedStartTimeInput = clonedDiv.querySelector('input[name="session_start_time[]"]');
            const clonedEndTimeInput = clonedDiv.querySelector('input[name="session_end_time[]"]');
            clonedStartTimeInput.value = '';
            clonedEndTimeInput.value = '';

            // Add event listener to the remove button
            // const removeButton = clonedDiv.querySelector('.removeButton');
            // removeButton.addEventListener('click', removeDiv);

            // Append the cloned div to the container
            containerDiv.appendChild(clonedDiv);
        }

        // Function to remove the cloned div
        // function removeDiv(event) {
        //     const divToRemove = event.target.parentNode.parentNode.parentNode;
        //     divToRemove.remove();
        // }

        // Add event listener to the button
        duplicateButton.addEventListener('click', duplicateDiv);
    </script>



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


@endsection
