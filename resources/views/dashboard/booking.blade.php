@extends('dashboard.layouts.app')

@section('title', 'Booking')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="col-md-9 mx-auto dashboardcontent editprof booking">
        <div class="row">
            <div class="col-md-12">
                <div class="orderContent listNon">
                    <div>
                        <h2>Booking Form</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="recentTable editProfile">
                    <form class="editForm" action=" {{route('user.sessionBooking')}} " method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Your Name*</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="name" placeholder="john Smith"
                                               class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Email *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="email" placeholder="johnsmith@gmial.com"
                                               class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Phone *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="phone_number" placeholder="+123 456 7890"
                                               class="form-control @error('phone_number') is-invalid @enderror">
                                        @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Address*</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" placeholder="Space Needle 000 Broad St, Seattles"
                                               name="address"
                                               class="form-control @error('address') is-invalid @enderror">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Service *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select id="serviceSelect" name="service_id" onchange="renderSession(event)"
                                                class="form-control @error('service_id') is-invalid @enderror">
                                            @error('service_id')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                            <option selected hidden>Select Serivce</option>
                                            @foreach($data['services'] as $service)
                                                <option value="{{ $service->id }}"> {{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Session *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select id="sessionSelect" name="session_id" onchange="renderSessionTimmings(event)"
                                                class="form-control @error('session_id') is-invalid @enderror">

                                            @error('session_id')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                            <option selected hidden>Select Session</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Session Timings *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select id="sessionTimingSelect" name="session_timing_id"
                                                class="form-control @error('session_timing_id') is-invalid @enderror">

                                            @error('session_timing_id')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                            <option selected hidden>Select Session</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>

                        </div>


                        <div class="row align-items-start">
                            <div class="col-md-1">
                                <label>Details *</label>
                            </div>
                            <div class="col-md-10 mx-auto">
                                <textarea placeholder="Lorem Ipsum is simply dummy text" name="detail"
                                          class="form-control @error('detail') is-invalid @enderror"></textarea>
                                @error('detail')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                {{--                                <button onclick="window.location.href='payment.php'" class="themeBtn"--}}
                                {{--                                        type="button">continue--}}
                                {{--                                </button>--}}

                                <button class="themeBtn" type="submit">Continue</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
        function renderSessionTimmings(event) {
            var sessionId = event.target.value; // Get the selected service ID
            console.log("sessionId" , sessionId)
            // Make an AJAX request to fetch the sessions based on the selected service ID
            // Assuming you have a route in your Laravel application to handle this request

            // Example using jQuery AJAX
            $.ajax({
                url: "{{ route('getSessionsTimingBySession') }}",
                type: 'GET',
                data: {
                    sessionId: sessionId
                },
                success: function (response) {
                    console.log("Response time:", response);
                    // Clear previous options
                    $('#sessionTimingSelect').empty();

                    // Add a default option
                    $('#sessionTimingSelect').append('<option selected hidden>Select Session</option>');

                    // Loop through the sessions and add them as options
                    if (response.length > 0) {
                        for (var i = 0; i < response.length; i++) {
                            var sessionTiming = response[i];
                            console.log("select Session Time", sessionTiming);
                            $('#sessionTimingSelect').append('<option value="' + sessionTiming.id + '">' + sessionTiming.session_time + '</option>');
                        }
                    } else {
                        $('#sessionTimingSelect').append('<option value="">' + "Session not available" + '</option>');
                    }

                },
                error: function (xhr, status, error) {
                    console.log("Error:", status, error);
                    alert('Error');
                }
            });

        }
    </script>

    <script>

        function renderSession(event) {
            var serviceId = event.target.value; // Get the selected service ID

            // Make an AJAX request to fetch the sessions based on the selected service ID
            // Assuming you have a route in your Laravel application to handle this request

            // Example using jQuery AJAX
            $.ajax({
                url: "{{ route('getSessionsByService') }}",
                type: 'GET',
                data: {
                    serviceId: serviceId
                },
                success: function (response) {
                    console.log("Response:", response);
                    // Clear previous options
                    $('#sessionSelect').empty();

                    // Add a default option
                    $('#sessionSelect').append('<option selected hidden>Select Session</option>');

                    // Loop through the sessions and add them as options
                    if (response.length > 0) {
                        for (var i = 0; i < response.length; i++) {
                            var session = response[i];
                            console.log("selec session", session);
                            $('#sessionSelect').append('<option value="' + session.id + '">' + session.name + '</option>');
                        }
                    } else {
                        $('#sessionSelect').append('<option value="">' + "Session not available" + '</option>');
                    }

                },
                error: function (xhr, status, error) {
                    console.log("Error:", status, error);
                    alert('Error');
                }
            });

        }


    </script>

@endsection
