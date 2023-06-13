@extends('dashboard.layouts.app')

@section('title', 'Edit Password')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="col-md-9 mx-auto dashboardcontent editprof">
        <div class="row">
            <div class="col-md-12">
                <div class="orderContent listNon">
                    <div>
                        <h2>Edit Password</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="recentTable editProfile">
                    <!-- <div class="row align-items-start">
                        <div class="col-md-2">
                            <label>User Profile*</label>
                        </div>
                        <div class="col-md-10">
                            <div class="changeProfile">
                                <div>
                                    <figure>
                                        <img src="images/editimg.png" class="img-fluid" alt="img">
                                    </figure>
                                    <a href="#" class="themeBtn">Change</a>
                                    <a href="#" class="themeBtn remove">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <form action="{{ route('userEditPassword') }}" method="POST" class="editForm">
                        @csrf
                        <div class="row align-items-start">
                            <div class="col-md-2">
                                <label>Current Password*</label>
                            </div>
                            <div class="col-md-10">
                                <input type="password" placeholder="*********" name="current_password"
                                       class="form-control @error('current_password') is-invalid @enderror">
                                @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="row align-items-start">
                            <div class="col-md-2">
                                <label>Change Password*</label>
                            </div>
                            <div class="col-md-10">
                                <input type="password" placeholder="*********" name="password"
                                       class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row align-items-start">
                            <div class="col-md-2">
                                <label>Repeat Password*</label>
                            </div>
                            <div class="col-md-10">
                                <input type="password" placeholder="*********" name="password_confirmation"
                                       class="form-control @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row align-items-start">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-10">
                                <button class="themeBtn" type="submit">Save Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('script')
@endsection
