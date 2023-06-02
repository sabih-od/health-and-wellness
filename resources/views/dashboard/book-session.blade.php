@extends('dashboard.layouts.app')

@section('title', 'Book Session')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="col-md-9 mx-auto dashboardcontent book">
        <div class="row">
            <div class="col-md-4">
                <div class="orderBox">
                    <div>
                        <h2>Health</h2>
                        <h3>$75 for 1<small>st</small> session</h3>
                        <a href="#" class="themeBtn">Book Now</a>
                    </div>
                    <div>
                        <img src="{{asset('dashboard/images/book-health.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="orderBox">
                    <div>
                        <h2>Wellness</h2>
                        <h3>$75 for 1<small>st</small> session</h3>
                        <a href="#" class="themeBtn">Book Now</a>
                    </div>
                    <div>
                        <img src="{{asset('dashboard/images/book-wellness.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="orderBox">
                    <div>
                        <h2>MAP </h2>
                        <h3>$75 for 1<small>st</small> session</h3>
                        <a href="#" class="themeBtn">Book Now</a>
                    </div>
                    <div>
                        <img src="{{asset('dashboard/images/book-map.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12 all-order flemember mt-4">
                <div class="recentTable addProdct px-5">
                    <div class="showOne border-0">
                        <div>
                            <h1>Book Sessions</h1>
                        </div>
                        <div>
                            <a href="booking.php" class="themeBtn">Book Appointment</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 d-flex p-0">
                            <div id="evoCalendar"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="searchScedule">
                                <h3>Search Schedule</h3>
                                <input type="text" placeholder="Search Schedule">
                                <h2>Schedule</h2>
                                <h4>May 03, 2023</h4>

                                <ul>
                                    <li class="healthtag">
                                        <ul>
                                            <li>
                                                <figure>
                                                    <img src="{{asset('dashboard/images/userdata.png')}}" alt="">
                                                </figure>
                                                <div>
                                                    <h5 class="mb-0">Mindful Retreat</h5>
                                                    <span>Wednesday, 24 May  |  10:30 - 11:00</span>
                                                </div>

                                            </li>
                                            <li>
                                                <figure>
                                                    <img src="{{asset('dashboard/images/userdata.png')}}" alt="">
                                                </figure>
                                                <div>
                                                    <h5 class="mb-0">Mindful Retreat</h5>
                                                    <span>Wednesday, 24 May  |  10:30 - 11:00</span>
                                                </div>

                                            </li>
                                        </ul>
                                    </li>
                                    <li class="wellnesstag">
                                        <figure>
                                            <img src="{{asset('dashboard/images/userdata.png')}}" alt="">
                                        </figure>
                                        <div>
                                            <h5 class="mb-0">Mindful Retreat</h5>
                                            <span>Wednesday, 24 May  |  10:30 - 11:00</span>
                                        </div>
                                    </li>
                                    <li class="wellnesstag">
                                        <figure>
                                            <img src="{{asset('dashboard/images/userdata.png')}}" alt="">
                                        </figure>
                                        <div>
                                            <h5 class="mb-0">Mindful Retreat</h5>
                                            <span>Wednesday, 24 May  |  10:30 - 11:00</span>
                                        </div>
                                    </li>
                                    <li class="wellnesstag">
                                        <figure>
                                            <img src="{{asset('dashboard/images/userdata.png')}}" alt="">
                                        </figure>
                                        <div>
                                            <h5 class="mb-0">Mindful Retreat</h5>
                                            <span>Wednesday, 24 May  |  10:30 - 11:00</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
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

@endsection

@section('script')
@endsection
