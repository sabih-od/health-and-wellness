@extends('front.layouts.app')

@section('title', 'Forgot Password')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="col-lg-9 mx-xl-auto dashboardcontent editprof booking">
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

                                @if (session()->has('message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif

                                <form action="{{ route('reset.password.post') }}" class="formStyle form-row" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="input-group">
                                        <label>E-Mail Address<em>*</em></label>
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{$email}}" readonly required>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif

                                    <div class="input-group">
                                        <label>New Password<em>*</em></label>
                                        <input type="password" class="form-control" placeholder="At least 6 characters" name="password" required autofocus>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif

                                    <div class="input-group">
                                        <label>Confirm Password<em>*</em></label>
                                        <input type="password" class="form-control" placeholder="At least 6 characters" name="password_confirmation" required>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif

                                    <div class="input-group justify-content-md-end">
                                        <button class="themeBtn rounded">Reset Password</button>
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
