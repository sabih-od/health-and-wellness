@extends('dashboard.layouts.app')

@section('title', 'Forgot Password')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="col-md-9 mx-auto dashboardcontent editprof booking">
        <div class="row">
            <div class="col-md-12">
                <div class="orderContent listNon">
                    <div>
                        <h2>FORGOT PASSWORD</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="accountAccesSec">
                            <div class="whitebg">
                                <h2><span>Reset Password</span></h2>
                                <form action="" class="formStyle form-row">
                                    <div class="input-group">
                                        <label>New Password<em>*</em></label>
                                        <input type="text" class="form-control" placeholder="At least 6 characters">
                                    </div>
                                    <div class="input-group">
                                        <label>Confirm Password<em>*</em></label>
                                        <input type="text" class="form-control" placeholder="At least 6 characters">
                                    </div>
                                    <div class="input-group justify-content-md-end">
                                        <button class="themeBtn rounded">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('script')
@endsection
