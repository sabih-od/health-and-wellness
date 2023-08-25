@extends('dashboard.layouts.app')

@section('title', 'Book Session')
@section('description', '')
@section('keywords', '')

@section('content')

    @php

        $services = \App\Models\Service::inRandomOrder()->limit(3)->get();

    @endphp

    <div class="col-lg-9 mx-xl-auto dashboardcontent book">
        <div class="row">

            @foreach($services as $service)
            <div class="col-md-4">
                <div class="orderBox">
                    <div>

                        <h2> {{$service->name ?? ''}} </h2>
                        <h3>{{ $service->pricing_detail ?? '' }} session</h3>
                        <a href=" {{ route('user.booking') }} " class="themeBtn">Book Now</a>
                    </div>
                    <div>
                        <img src="{{asset('dashboard/images/book-health.png')}}" alt="">
                    </div>
                </div>
            </div>
            @endforeach
{{--            <div class="col-md-4">--}}
{{--                <div class="orderBox">--}}
{{--                    <div>--}}
{{--                        <h2>Wellness</h2>--}}
{{--                        <h3>$75 for 1<small>st</small> session</h3>--}}
{{--                        <a href="#" class="themeBtn">Book Now</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('dashboard/images/book-wellness.png')}}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4">--}}
{{--                <div class="orderBox">--}}
{{--                    <div>--}}
{{--                        <h2>MAP </h2>--}}
{{--                        <h3>$75 for 1<small>st</small> session</h3>--}}
{{--                        <a href="#" class="themeBtn">Book Now</a>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <img src="{{asset('dashboard/images/book-map.png')}}" alt="">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>

        <div class="row">

            <div class="col-md-12 all-order flemember mt-md-4">
                <div class="recentTable addProdct px-lg-5">
                    <div class="showOne border-0">
                        <div>
                            <h1>Book Sessions</h1>
                        </div>
                        <div>
                            <a href="{{ route('user.booking') }}" class="themeBtn">Book Appointment</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">


                            <div id="evoCalendar"></div>
                            {{-- <a>Book A Ticket</a> --}}
                            {{--                            <div id="calendar"></div>--}}
                        </div>

{{--                        <div class="col-md-4">--}}
{{--                            <div class="searchScedule">--}}
{{--                                <h3>Search Schedule</h3>--}}
{{--                                <input type="text" placeholder="Search Schedule">--}}
{{--                                <h2>Schedule</h2>--}}
{{--                                <h4>May 03, 2023</h4>--}}

{{--                                <ul>--}}
{{--                                    <li class="wellnesstag" data-name="wellness">--}}
{{--                                        <figure>--}}
{{--                                            <img src="{{asset('dashboard/images/userdata.png')}}" alt="">--}}
{{--                                        </figure>--}}
{{--                                        <div>--}}
{{--                                            <h5 class="mb-0">Mindful Retreat</h5>--}}
{{--                                            <span>Wednesday, 24 May  |  10:30 - 11:00</span>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="wellnesstag" data-name="wellness">--}}
{{--                                        <figure>--}}
{{--                                            <img src="{{asset('dashboard/images/userdata.png')}}" alt="">--}}
{{--                                        </figure>--}}
{{--                                        <div>--}}
{{--                                            <h5 class="mb-0">Mindful Retreat</h5>--}}
{{--                                            <span>Wednesday, 24 May  |  10:30 - 11:00</span>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li class="wellnesstag" data-name="wellness">--}}
{{--                                        <figure>--}}
{{--                                            <img src="{{asset('dashboard/images/userdata.png')}}" alt="">--}}
{{--                                        </figure>--}}
{{--                                        <div>--}}
{{--                                            <h5 class="mb-0">Mindful Retreat</h5>--}}
{{--                                            <span>Wednesday, 24 May  |  10:30 - 11:00</span>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>

        </div>
        <!-- <section class="calndrSec">
        <div class="container">

            <div class="row no-guuters">
                <div class="col-md-12">
                    <div class="evntHead">
                        <h3 class="headOne">Book Sessions</h3>
                        <a href="booking.php" class="themeBtn">Book Appointment</a>
                    </div>
                </div>
                <div class="col-md-8 d-flex p-0">
                    <div id="evoCalendar"></div>
                </div>
                <div class="col-md-4">
                    <div class="searchScedule">
                        <h3>Search Schedule</h3>
                        <input type="text" placeholder="Search Schedule">
                        <h2>Schedule</h2>
                        <h4>December 03, 2022</h4>

                        <ul>
                            <li>
                                <h5>Etxsh Clinic & Show # 01 Greenville TX</h5>
                                <span>27 July 2023 - 9 July 2023</span>
                                <p>Longhorn Arena and Event Center...</p>
                                <a href="#">View Details ></a>
                            </li>
                            <li>
                                <h5>Etxsh Clinic & Show # 01 Greenville TX</h5>
                                <span>27 July 2023 - 9 July 2023</span>
                                <p>Longhorn Arena and Event Center...</p>
                                <a href="#">View Details ></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    </div>

    <form id="hidden_form" method="POST" hidden>
        @csrf
        <input type="hidden" name="date" id="form_date">
    </form>

@endsection

@section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{--    <script src="path/to/evo-calendar.js"></script>--}}
    <script src="{{ asset('dashboard/js/evo-calendar.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

    <script>

        $("#evoCalendar").evoCalendar();


        $('body').on('click', '.day', function () {
            var options = {year: 'numeric', month: 'long', day: 'numeric'};
            var today = new Date($(this).attr('data-date-val'));
            $('#todays_date').html(today.toLocaleDateString("en-US", options));

            $('#form_date').val($(this).attr('data-date-val'));
            var selected_date = $(this).attr('data-date-val');
            console.log("selected_date", selected_date)
            fetchEvents();

        });

        function fetchEvents() {
            $.ajax({
                type: 'POST',
                url: '{{route('fetchDateSessions')}}',
                data: $('#hidden_form').serialize(),
                success: function (data) {
                    console.log("data", data);

                    if (data.length > 0) {
                        $(".event-empty").remove();
                        var parentElement = $(".event-list");

                        parentElement.html('');
                        for (var i = 0; i < data.length; i++) {
                            var item = data[i];

                            console.log("item", item)
                            var htmlCode = '<div class="wellnesstag" data-name="'+ item.session.service.name +'" onclick="goToBooking()">' +
                                '<figure>' +
                                '<img src="' + item.session.media[0].original_url + '" alt="">' +
                                '</figure>' +
                                '<div>' +
                                '<h5 class="mb-0">' + item.session.name + '</h5>' +
                                '<span>' + item.session.date + ' | ' + item.session_time + '</span>' +
                                '</div>' +
                                '</div>';


                            parentElement.append(htmlCode);
                        }
                    }
                },
                error: function (e) {
                    console.log(e);
                },
            });
        }

        function goToBooking()
        {
            window.location.replace('/user/booking');
        }

    </script>


@endsection
