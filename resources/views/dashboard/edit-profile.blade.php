@extends('dashboard.layouts.app')

@section('title', 'Edit Profile')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="col-md-9 mx-auto dashboardcontent editprof booking">
        <div class="row">
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="accountAccesSec">
                                <div class="whitebg">
                                    <h2><span>Edit Profile</span></h2>
                                    <form action="{{route('user.editProfile')}}" class="formStyle form-row" method="POST">
                                        @csrf
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>First Name<em>*</em></label>
                                                <input type="text" class="form-control" placeholder="First Name" name="first_name" required value="{{\Illuminate\Support\Facades\Auth::user()->first_name ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Last Name<em>*</em></label>
                                                <input type="text" class="form-control" placeholder="Last Name" name="last_name" required value="{{\Illuminate\Support\Facades\Auth::user()->last_name ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Email<em>*</em></label>
                                                <input type="email" class="form-control" placeholder="email" name="email" required value="{{\Illuminate\Support\Facades\Auth::user()->email ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Phone<em>*</em></label>
                                                <input type="text" class="form-control" placeholder="Phone" name="phone" required value="{{\Illuminate\Support\Facades\Auth::user()->phone ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>City<em>*</em></label>
                                                <input type="text" class="form-control" placeholder="City" name="city" required value="{{\Illuminate\Support\Facades\Auth::user()->city ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Zip<em>*</em></label>
                                                <input type="text" class="form-control" placeholder="Zip" name="zip" required value="{{\Illuminate\Support\Facades\Auth::user()->zip ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Fax<em>*</em></label>
                                                <input type="text" class="form-control" placeholder="Fax" name="fax" required value="{{\Illuminate\Support\Facades\Auth::user()->fax ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Address<em>*</em></label>
                                                <input type="text" class="form-control" placeholder="Address" name="address" required value="{{\Illuminate\Support\Facades\Auth::user()->address ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Bio<em>*</em></label>
                                                <input type="text" class="form-control" placeholder="Bio" name="bio" required value="{{\Illuminate\Support\Facades\Auth::user()->bio ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group justify-content-sm-between align-items-sm-center">
                                                <button type="submit" class="themeBtn rounded" href="#">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- section css end -->
    </div>

@endsection

@section('script')
@endsection
