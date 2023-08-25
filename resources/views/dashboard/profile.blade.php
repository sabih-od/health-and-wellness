@extends('dashboard.layouts.app')

@section('title', 'profile')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="col-lg-9 mx-xl-auto dashboardcontent all-order flemember">
        <div class="row">
            <div class="col-md-12">
                <!-- <div class="orderContent listNon">
                    <div>
                        <h2>User Profile</h2>
                        <ul>
                            <li><a href="#">Dashboard </a></li>
                            <li><span>&gt;</span></li>
                            <li><a href="#">Setting </a></li>
                            <li><span>&gt;</span></li>
                            <li><a href="#">User Profile</a></li>
                        </ul>
                    </div>
                    <div>
                        <a href="edit-profile.php" class="themeBtn">Edit Profile</a>
                    </div>
                </div> -->
                <div class="showOne border-0">
                    <div>
                        <h2>User Profile</h2>
                    </div>
                    <div>
                        <a href="{{route('user.editProfile')}}" class="themeBtn">Edit Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="acountInfo buyerProfile">
                    <h2>Account Information <img src="{{$user = \Illuminate\Support\Facades\Auth::user()->get_profile_picture()}}" class="img-fluid"
                                                 alt="img"></h2>

                    @php
                        $user = \Illuminate\Support\Facades\Auth::user();
                    @endphp
                    <div class="vendorEmail">
                        <ul>
                            <li><label>Name:</label><span>{{$user->first_name . ' ' . $user->last_name}}</span></li>
                            <li><label>Email:</label><span>{{$user->email}}</span></li>
                            <li><label>Phone:</label><span>{{$user->phone}}</span></li>
                            <li><label>City:</label><span>{{$user->city}}</span></li>
                            <li><label>Zip:</label>{{$user->zip}}</li>
{{--                            <li><label>Fax:</label><span>{{$user->fax}}</span></li>--}}
                            <li><label>Address:</label><span>{{$user->address}}</span></li>
                            <li><label>Bio:</label><span>{{$user->bio}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="acountInfo">
                    <h2 class="border-0 mb-4">My Sessions</h2>
                    <div class="waletBox">
                        <div>
                            <img src="../images/icons/profile-total.png" alt="">
                            <h3>Total Sessions</h3>
                            <h4>50</h4>
                        </div>
                        <div>
                            <img src="../images/icons/profile-total.png" alt="">
                            <h3>Pending Sessions</h3>
                            <h4>50</h4>
                        </div>
                        <div>
                            <img src="../images/icons/profile-total.png" alt="">
                            <h3>Completed Sessions</h3>
                            <h4>50</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('script')
@endsection
