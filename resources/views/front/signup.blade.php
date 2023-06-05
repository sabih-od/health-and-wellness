@extends('front.layouts.app')

@section('title', 'Signup')
@section('description', '')
@section('keywords', '')

@section('content')

    <section class="accountAccesSec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="orderContent listNon">
                        <div>
                            <h2>Sign Up</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="whitebg">
                        <h2><span>Create an Account</span></h2>
                        <form action="{{ route('register') }}" class="formStyle form-row" method="POST">
                            @csrf
                            <div class="input-group">
                                <label>First Name<em>*</em></label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" required>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label>Last Name<em>*</em></label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" required>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label>Email Address<em>*</em></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label>Password<em>*</em></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="At least 6 characters" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label>Re-enter password<em>*</em></label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="At least 6 characters" name="password_confirmation" required>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group justify-content-md-end">
                                <button class="themeBtn rounded">Sign Up</button>
                            </div>
                        </form>
                        <div class="or"><span>or</span></div>
                        <p>Already have an account? <a href="{{route('front.login')}}">SignIn</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
@endsection
