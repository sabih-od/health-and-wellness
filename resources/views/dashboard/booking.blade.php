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
                    <form class="editForm" action=" {{route('user.sessionBooking')}} " method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Your Name*</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="name" placeholder="john Smith">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Email *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="email" placeholder="johnsmith@gmial.com">
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
                                        <input type="text" name="phone_number" placeholder="+123 456 7890">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Address*</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" placeholder="Space Needle 000 Broad St, Seattles">
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
                                        <select id="serviceSelect" name="service_id" onchange="renderSession(event)">
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
                                        <select id="sessionSelect" name="session_id">
                                            <option selected hidden>Select Session</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--                        <div class="row">--}}
                        {{--                            <div class="col-md-6">--}}
                        {{--                                <div class="row align-items-start">--}}
                        {{--                                    <div class="col-md-3">--}}
                        {{--                                        <label>Date *</label>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="col-md-8">--}}
                        {{--                                        <input type="date">--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="col-md-6">--}}
                        {{--                                <div class="row align-items-start">--}}
                        {{--                                    <div class="col-md-3">--}}
                        {{--                                        <label>Time *</label>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="col-md-8">--}}
                        {{--                                        <input type="time">--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}


                        <div class="row align-items-start">
                            <div class="col-md-1">
                                <label>Details *</label>
                            </div>
                            <div class="col-md-10 mx-auto">
                                <textarea placeholder="Lorem Ipsum is simply dummy text" name="detail"></textarea>
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
                            $('#sessionSelect').append('<option value="' + session.id + '">' + session.name + '</option>');
                        }
                    }
                    else {
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
