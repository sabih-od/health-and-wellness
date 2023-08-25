@extends('dashboard.layouts.app')

@section('title', 'Notification')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="col-lg-9 mx-xl-auto dashboardcontent">
        <div class="row">
            <div class="col-md-12">
                <div class="recentTable">

                    <div class="showOne">
                        <div>
                            <h1>Notifications</h1>
                        </div>
                        <div>
{{--                            <button class="btn themeBtn">Dismiss All</button>--}}
                        </div>
                    </div>

                    @foreach($notifications as $noti)

                        @php

                            $dateTime = $noti->created_at;

                            $carbon = \Carbon\Carbon::parse($dateTime);

                            $formattedDateTime = $carbon->format('l h:i A');

                        @endphp

                        <div class="reviewBox">
                            <div class="reviewContent">
{{--                                <div class="close-icon">--}}
{{--                                    <a href="#"><i class="fas fa-times text-danger-c"></i></a>--}}
{{--                                </div>--}}
                                <div>
                                    <h2>
                                        {{ $noti->notification ?? '' }}
                                        <span>{{$formattedDateTime ?? ''}}</span>
                                    </h2>
                                </div>
{{--                                <div class="content d-flex justify-content-end">--}}
{{--                                    --}}{{--                                <p>It is a long established fact that a reader will be distracted by the readable--}}
{{--                                    --}}{{--                                    content of a page when looking at its layout.</p>--}}
{{--                                    <a href="" class="more"><i class="fas fa-arrow-right"></i></a>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    @endforeach

                    {{--                    <div class="reviewBox">--}}
                    {{--                        <div class="reviewContent">--}}
                    {{--                            <div class="close-icon">--}}
                    {{--                                <a href="#"><i class="fas fa-times text-danger-c"></i></a>--}}
                    {{--                            </div>--}}
                    {{--                            <div>--}}
                    {{--                                <h2>--}}
                    {{--                                    What Is Lorem Ipsum?--}}
                    {{--                                    <span>Wednesday 10:30 AM</span>--}}
                    {{--                                </h2>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="content">--}}
                    {{--                                <p>It is a long established fact that a reader will be distracted by the readable--}}
                    {{--                                    content of a page when looking at its layout.</p>--}}
                    {{--                                <a href="" class="more"><i class="fas fa-arrow-right"></i></a>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="reviewBox">--}}
                    {{--                        <figure>--}}
                    {{--                            <img src="{{asset('dashboard/images/userdata.png')}}" class="img-fluid" alt="img">--}}
                    {{--                        </figure>--}}
                    {{--                        <div class="reviewContent">--}}
                    {{--                            <div class="close-icon">--}}
                    {{--                                <a href="#"><i class="fas fa-times text-danger-c"></i></a>--}}
                    {{--                            </div>--}}
                    {{--                            <div>--}}
                    {{--                                <h2>--}}
                    {{--                                    Mindful Retreat--}}
                    {{--                                    <span>Wednesday 10:30 AM</span>--}}
                    {{--                                </h2>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="content">--}}
                    {{--                                <h3>Ready to take session</h3>--}}
                    {{--                                <a href="" class="more"><i class="fas fa-arrow-right"></i></a>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="reviewBox">--}}
                    {{--                        <div class="reviewContent">--}}
                    {{--                            <div class="close-icon">--}}
                    {{--                                <a href="#"><i class="fas fa-times text-danger-c"></i></a>--}}
                    {{--                            </div>--}}
                    {{--                            <div>--}}
                    {{--                                <h2>--}}
                    {{--                                    What Is Lorem Ipsum?--}}
                    {{--                                    <span>Wednesday 10:30 AM</span>--}}
                    {{--                                </h2>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="content">--}}
                    {{--                                <p>It is a long established fact that a reader will be distracted by the readable--}}
                    {{--                                    content of a page when looking at its layout.</p>--}}
                    {{--                                <a href="" class="more"><i class="fas fa-arrow-right"></i></a>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="reviewBox">--}}
                    {{--                        <figure>--}}
                    {{--                            <img src="{{asset('dashboard/images/userdata.png')}}" class="img-fluid" alt="img">--}}
                    {{--                        </figure>--}}
                    {{--                        <div class="reviewContent">--}}
                    {{--                            <div class="close-icon">--}}
                    {{--                                <a href="#"><i class="fas fa-times text-danger-c"></i></a>--}}
                    {{--                            </div>--}}
                    {{--                            <div>--}}
                    {{--                                <h2>--}}
                    {{--                                    Mindful Retreat--}}
                    {{--                                    <span>Wednesday 10:30 AM</span>--}}
                    {{--                                </h2>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="content">--}}
                    {{--                                <h3>Ready to take session</h3>--}}
                    {{--                                <a href="" class="more"><i class="fas fa-arrow-right"></i></a>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            console.log("In");
            // AJAX request
            $.ajax({
                url: 'dismiss-notifications', // Replace with your API endpoint
                type: 'GET', // or 'POST', 'PUT', etc. depending on your API

                success: function(data) {
                    // Handle the API response
                    console.log(data);
                    // You can perform any further actions with the response here
                },

                error: function(error) {
                    // Handle any errors that occurred during the AJAX request
                    console.error('Error:', error);
                }
            });
        });
    </script>



@endsection
