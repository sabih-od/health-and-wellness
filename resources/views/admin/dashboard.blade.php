@extends('admin.layouts.app')
@section('section')
@section('title', 'Dashboard')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content pb-3">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3> {{ $data['services'] ?? '' }}</h3>
                            <p>Total Service</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        {{--                        <a href="#" class="small-box-footer">More info <i--}}
                        {{--                                class="fas fa-arrow-circle-right"></i></a>--}}
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $data['sessions'] ?? '' }}</h3>
                            <p>Total Session</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        {{--                        <a href="#" class="small-box-footer">More info <i--}}
                        {{--                                class="fas fa-arrow-circle-right"></i></a>--}}
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3> {{ $data['booked_sessions'] ?? '' }} </h3>
                            <p>Booked Session</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        {{--                        <a href="#" class="small-box-footer">More info <i--}}
                        {{--                                class="fas fa-arrow-circle-right"></i></a>--}}
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3> {{ $data['users']->count() ?? '' }} </h3>
                            <p>Total Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        {{--                        <a href="#" class="small-box-footer">More info <i--}}
                        {{--                                class="fas fa-arrow-circle-right"></i></a>--}}
                    </div>
                </div>
                <!-- ./col -->
            </div>
            {{-- latest orders --}}
            <div class="row mt-4 mb-3">

                <div class="w-100 p-2">
                    <a href="{{ route('customer') }}">
                        <button class="btn btn-outline-primary float-right">View All</button>
                    </a>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Address</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['users'] as $index => $user)
                        <tr>
                            <th scope=""> {{ $index + 1 }} </th>
                            <td> {{ $user->first_name ?? '' }} </td>
                            <td>{{ $user->last_name ?? '' }}</td>
                            <td>{{ $user->email ?? '' }}</td>
                            <td>{{ $user->phone ?? '' }}</td>
                            <td>{{ $user->address ?? '' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>

            <div class="row mb-5">

                <div class="col-md-12 all-order flemember mt-4">
                    <div class="recentTable addProdct px-5">
                        <div class="showOne border-0">
                            <div>
                                <h1>Sessions</h1>
                            </div>
                            {{--                            <div>--}}
                            {{--                                <a href="{{ route('user.booking') }}" class="themeBtn">Book Appointment</a>--}}
                            {{--                            </div>--}}
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


        {{-- latest orders end --}}
        <!-- /.row -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->

        <form id="hidden_form" method="POST" hidden>
            @csrf
            <input type="hidden" name="date" id="form_date">
        </form>

    </section>




    <!-- /.content -->
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        var htmlCode = '<div class="wellnesstag" data-name="' + item.service.name + '" onclick="goToBooking()">' +
                            '<figure>' +
                            '<img src="' + item.media[0].original_url + '" alt="">' +
                            '</figure>' +
                            '<div>' +
                            '<h5 class="mb-0">' + item.name + '</h5>' +
                            '<span>' + item.date + ' | ' + item.session_time + '</span>' +
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


</script>

@endsection
