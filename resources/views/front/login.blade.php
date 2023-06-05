@extends('front.layouts.app')

@section('title', 'Login')
@section('description', '')
@section('keywords', '')

@section('content')

    <section class="accountAccesSec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="orderContent listNon">
                        <div>
                            <h2>Login</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="whitebg">
                        <h2><span>Welcome back!</span>Sign in to your account</h2>
                        <form action="{{ route('login') }}" class="formStyle form-row" method="POST">
                            @csrf
                            <div class="input-group">
                                <label>Email or Mobile<em>*</em></label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Enter your Email or Mobile" name="email" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <label>Password<em>*</em></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="********" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-group justify-content-sm-between align-items-sm-center">
                                <button class="themeBtn rounded" href="#">Sign In</button>
                                <a href="forgot-password.php" class="forgetPass">Forgot my password</a>
                            </div>
                        </form>
                        <div class="or"><span>or</span></div>
                        <p>Don’t have an account? <a href="{{route('front.signup')}}">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
@endsection
