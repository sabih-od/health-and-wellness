@extends('dashboard.layouts.app')

@section('title', 'Notification')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="col-md-9 mx-auto dashboardcontent">
        <div class="row">
            <div class="col-md-12">
                <div class="recentTable">

                    <div class="showOne">
                        <div>
                            <h1>Notifications</h1>
                        </div>
                        <div>
                            <button class="btn themeBtn">Dismiss All</button>
                        </div>
                    </div>

                    <div class="reviewBox">
                        <div class="reviewContent">
                            <div class="close-icon">
                                <a href="#"><i class="fas fa-times text-danger-c"></i></a>
                            </div>
                            <div>
                                <h2>
                                    What Is Lorem Ipsum?
                                    <span>Wednesday 10:30 AM</span>
                                </h2>
                            </div>
                            <div class="content">
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                <a href="" class="more"><i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="reviewBox">
                        <figure>
                            <img src="{{asset('dashboard/images/userdata.png')}}" class="img-fluid" alt="img">
                        </figure>
                        <div class="reviewContent">
                            <div class="close-icon">
                                <a href="#"><i class="fas fa-times text-danger-c"></i></a>
                            </div>
                            <div>
                                <h2>
                                    Mindful Retreat
                                    <span>Wednesday 10:30 AM</span>
                                </h2>
                            </div>
                            <div class="content">
                                <h3>Ready to take session</h3>
                                <a href="" class="more"><i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="reviewBox">
                        <div class="reviewContent">
                            <div class="close-icon">
                                <a href="#"><i class="fas fa-times text-danger-c"></i></a>
                            </div>
                            <div>
                                <h2>
                                    What Is Lorem Ipsum?
                                    <span>Wednesday 10:30 AM</span>
                                </h2>
                            </div>
                            <div class="content">
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                <a href="" class="more"><i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="reviewBox">
                        <figure>
                            <img src="{{asset('dashboard/images/userdata.png')}}" class="img-fluid" alt="img">
                        </figure>
                        <div class="reviewContent">
                            <div class="close-icon">
                                <a href="#"><i class="fas fa-times text-danger-c"></i></a>
                            </div>
                            <div>
                                <h2>
                                    Mindful Retreat
                                    <span>Wednesday 10:30 AM</span>
                                </h2>
                            </div>
                            <div class="content">
                                <h3>Ready to take session</h3>
                                <a href="" class="more"><i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('script')

    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('9bc664b0ccbe734af34c', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            console.log('Notification',JSON.stringify(data));
        });
    </script>

@endsection
