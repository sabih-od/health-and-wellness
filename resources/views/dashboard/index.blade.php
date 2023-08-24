@extends('dashboard.layouts.app')

@section('title', 'Dashboard')
@section('description', '')
@section('keywords', '')

@section('content')


    <div class="col-lg-9 mx-xl-auto dashboardcontent">
        <div class="row">
            <div class="col-md-4">
                <div class="orderBox">
                    <div>
                        <h2> {{ $data['total_sessions'] ?? '' }} </h2>
                        <h3>Total Sessions</h3>
                    </div>
                    <div>
                        <img src="{{asset('dashboard/images/icons/session-total.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="orderBox">
                    <div>
                        <h2>{{ $data['pending_sessions'] ?? '' }}</h2>
                        <h3>Pending Sessions</h3>
                    </div>
                    <div>
                        <img src="{{asset('dashboard/images/icons/session-pending.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="orderBox">
                    <div>
                        <h2>{{ $data['complete_sessions'] ?? ''}}</h2>
                        <h3>Completed Sessions</h3>
                    </div>
                    <div>
                        <img src="{{asset('dashboard/images/icons/session-complete.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="showOne border-0">
                    <div>
                        <h2>All Sessions</h2>
                    </div>
                    <div>
                        <a href="{{ route('user.booking') }}" class="themeBtn">Book Appointment</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 all-order flemember">
                <div class="recentTable addProdct">
                    {{--                    <div class="showOne">--}}
                    {{--                        <div>--}}
                    {{--                            <label>Show</label>--}}
                    {{--                            <select>--}}
                    {{--                                <option>10</option>--}}
                    {{--                            </select>--}}
                    {{--                            <label>entries</label>--}}
                    {{--                        </div>--}}
                    {{--                        <div>--}}
                    {{--                            <form>--}}
                    {{--                                <input type="text" placeholder="Search">--}}
                    {{--                                <button><i class="far fa-search"></i></button>--}}
                    {{--                            </form>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <table id="example1" class="table table-responsive-lg">
                        <thead class="thead-dark">
                        <tr>
                            <th style="width: 0% !important;"></th>
                            <th style="text-align: left !important;">Sessions Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Time Remaining</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--                        <tr>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="d-flex align-items-center">--}}
                        {{--                                    <img src="{{asset('dashboard/images/userdata.png')}} " class="mr-3" alt="">--}}
                        {{--                                    Mindful Retreat--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                            <td>Wednesday, 24 May</td>--}}
                        {{--                            <td>10:30 - 11:00</td>--}}
                        {{--                            <td><span>Ready To Take Session</span></td>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="d-flex justify-content-center">--}}
                        {{--                                    <a href="#" class="themeBtn">Take A Session</a>--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        {{--                        <tr>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="d-flex align-items-center">--}}
                        {{--                                    <img src="{{asset('dashboard/images/userdata.png')}} " class="mr-3" alt="">--}}
                        {{--                                    Mindful Retreat--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                            <td>Wednesday, 24 May</td>--}}
                        {{--                            <td>10:30 - 11:00</td>--}}
                        {{--                            <td><span>Ready To Take Session</span></td>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="d-flex justify-content-center">--}}
                        {{--                                    <a href="#" class="themeBtn">Take A Session</a>--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        {{--                        <tr>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="d-flex align-items-center">--}}
                        {{--                                    <img src="{{asset('dashboard/images/userdata.png')}} " class="mr-3" alt="">--}}
                        {{--                                    Mindful Retreat--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                            <td>Wednesday, 24 May</td>--}}
                        {{--                            <td>10:30 - 11:00</td>--}}
                        {{--                            <td>--}}
                        {{--                                    <span>--}}
                        {{--                                        <small>Remaining Time</small>--}}
                        {{--                                        <div class="d-flex justify-content-center">--}}
                        {{--                                            <div>--}}
                        {{--                                                <h4 class="m-0">03 : </h4>--}}
                        {{--                                                <p class="mb-0 text-dark">Day</p>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div>--}}
                        {{--                                                <h4 class="m-0"> 00 : </h4>--}}
                        {{--                                                <p class="mb-0 text-dark">Hrs</p>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div>--}}
                        {{--                                                <h4 class="m-0"> 00</h4>--}}
                        {{--                                                <p class="mb-0 text-dark">Min</p>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </span>--}}
                        {{--                            </td>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="d-flex justify-content-center">--}}
                        {{--                                    <a href="#" class="themeBtn remain">Take A Session</a>--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        {{--                        <tr>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="d-flex align-items-center">--}}
                        {{--                                    <img src="{{asset('dashboard/images/userdata.png')}} " class="mr-3" alt="">--}}
                        {{--                                    Mindful Retreat--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                            <td>Wednesday, 24 May</td>--}}
                        {{--                            <td>10:30 - 11:00</td>--}}
                        {{--                            <td>--}}
                        {{--                                    <span>--}}
                        {{--                                        <small>Remaining Time</small>--}}
                        {{--                                        <div class="d-flex justify-content-center">--}}
                        {{--                                            <div>--}}
                        {{--                                                <h4 class="m-0">03 : </h4>--}}
                        {{--                                                <p class="mb-0 text-dark">Day</p>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div>--}}
                        {{--                                                <h4 class="m-0"> 00 : </h4>--}}
                        {{--                                                <p class="mb-0 text-dark">Hrs</p>--}}
                        {{--                                            </div>--}}
                        {{--                                            <div>--}}
                        {{--                                                <h4 class="m-0"> 00</h4>--}}
                        {{--                                                <p class="mb-0 text-dark">Min</p>--}}
                        {{--                                            </div>--}}
                        {{--                                        </div>--}}
                        {{--                                    </span>--}}
                        {{--                            </td>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="d-flex justify-content-center">--}}
                        {{--                                    <a href="#" class="themeBtn remain">Take A Session</a>--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        {{--                        <tr>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="d-flex align-items-center">--}}
                        {{--                                    <img src="{{asset('dashboard/images/userdata.png')}} " class="mr-3" alt="">--}}
                        {{--                                    Mindful Retreat--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                            <td>Wednesday, 24 May</td>--}}
                        {{--                            <td>10:30 - 11:00</td>--}}
                        {{--                            <td><span>Completed</span></td>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="d-flex justify-content-center">--}}
                        {{--                                    <a href="#" class="themeBtn completed">View Details</a>--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        {{--                        <tr>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="d-flex align-items-center">--}}
                        {{--                                    <img src="{{asset('dashboard/images/userdata.png')}} " class="mr-3" alt="">--}}
                        {{--                                    Mindful Retreat--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                            <td>Wednesday, 24 May</td>--}}
                        {{--                            <td>10:30 - 11:00</td>--}}
                        {{--                            <td><span>Completed</span></td>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="d-flex justify-content-center">--}}
                        {{--                                    <a href="#" class="themeBtn completed">View Details</a>--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                        {{--                        <tr>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="d-flex align-items-center">--}}
                        {{--                                    <img src="{{asset('dashboard/images/userdata.png')}} " class="mr-3" alt="">--}}
                        {{--                                    Mindful Retreat--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                            <td>Wednesday, 24 May</td>--}}
                        {{--                            <td>10:30 - 11:00</td>--}}
                        {{--                            <td><span>Completed</span></td>--}}
                        {{--                            <td>--}}
                        {{--                                <div class="d-flex justify-content-center">--}}
                        {{--                                    <a href="#" class="themeBtn completed">View Details</a>--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}

                        </tbody>
                    </table>
                    {{--                    <div class="showingNavigation">--}}
                    {{--                        <span>Showing 1 To 10 Of 33 Entries</span>--}}
                    {{--                        <div class="pagination">--}}
                    {{--                            <a href="#">Previous</a>--}}
                    {{--                            <a href="#" class="active">01</a>--}}
                    {{--                            <a href="#">02</a>--}}
                    {{--                            <a href="#">03</a>--}}
                    {{--                            <a href="#">04</a>--}}
                    {{--                            <a href="#">Next</a>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>

        </div>
    </div>

@endsection



{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>--}}



@section('script')

    <script src="{{asset('admin/datatables/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('admin/datatables/datatables.net/js/jquery.dataTables.min.js')}}"></script>

    <script>

        var interval;

        $(document).ready(function () {
            var DataTable = $("#example1").DataTable({
                // dom: "Blfrtip",
                // buttons: [{
                //     extend: "copy",
                //     className: "btn-sm"
                // }, {
                //     extend: "csv",
                //     className: "btn-sm"
                // }, {
                //     extend: "excel",
                //     className: "btn-sm"
                // }, {
                //     extend: "pdfHtml5",
                //     className: "btn-sm"
                // }, {
                //     extend: "print",
                //     className: "btn-sm"
                // }],
                responsive: true,
                processing: true,
                serverSide: true,
                pageLength: 10,
                ajax: {
                    url: `{{route('session.datatables')}}`,
                },
                columns: [
                    {
                        data: 'image',
                        name: 'image',
                        render: function (data, type, full, meta) {
                            return `<img src="` + data + `" height="80"/>`;
                        }
                    },
                    {data: 'session_name', name: 'session_name'},

                    {data: 'date', name: 'date'},
                    {data: 'session_time', name: 'session_time'},
                    {data: 'time_remaining', name: 'time_remaining'},
                    // {data: 'fees', name: 'fees'},
                    // {data: 'date', name: 'date'},
                    // {data: 'session_time', name: 'session_time'},
                    // {data: 'status', name: 'status'},

                    {data: 'action', name: 'action', orderable: false}
                ],
                "drawCallback": function( settings ) {
                    $('.countDown').each(function(index, event) {
                        console.log(index  , event)

                                countdown($(this).data('days'), $(this).data('hours'), $(this).data('minutes'), "count_down_" + $(this).data('id'))
                    })

                }
            });

            function countdown(days, hours, minutes, elementId) {
                console.log("in");
                const justId = elementId.replace('count_down_', '');
                console.log("Time Info" , days , hours , minutes);
                // Calculate the target time in milliseconds
                var targetTime = Date.now() + (days * 24 * 60 * 60 * 1000) + (hours * 60 * 60 * 1000) + (minutes * 60 * 1000);
                // Immediately update the countdown after the page loads
                updateCountdown(targetTime, elementId);

                // Update the countdown every minute
                 interval = setInterval(function() {
                    updateCountdown(targetTime, elementId);
                }, 60000);
            }

            function updateCountdown(targetTime, elementId) {
                // Calculate the remaining time in milliseconds
                console.log("targetTime" , targetTime);
                console.log("Date.now()" , Date.now());

                var remainingTime = targetTime - Date.now();
                console.log("remainingTime" , remainingTime)
                // Check if the countdown has finished
                if (remainingTime <= 10000) {
                    console.log("elementId" , elementId)
                    const justId = elementId.replace('count_down_', '');
                    $('#take_session_button_' + justId).prop('hidden', false);
                    $("#" + elementId).html("Ready To Take Session");
                    $('#days_hrs_' + justId).html('');
                    $('#renaming_time_' + justId).html('');
                    $('#action_btn_' + justId).removeClass("remain").html("Take A Session");
                    clearInterval(interval);

                    return;
                }

                // Calculate the remaining days, hours, and minutes
                var remainingDays = Math.floor(remainingTime / (24 * 60 * 60 * 1000));
                var remainingHours = Math.floor((remainingTime % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
                var remainingMinutes = Math.floor((remainingTime % (60 * 60 * 1000)) / (60 * 1000));

                // Display the countdown
                var countdownString = padZero(remainingDays) + ' : ' +
                    padZero(remainingHours) + ' : ' +
                    padZero(remainingMinutes) ;

                console.log(countdownString);
                document.getElementById(elementId).innerHTML = countdownString;
            }

            function padZero(number) {
                // Add leading zero if the number is less than 10
                return (number < 10 ? '0' : '') + number;
            }

            clearInterval(interval);




        });


    </script>
@endsection
