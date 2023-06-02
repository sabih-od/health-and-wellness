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
                        <form action="" class="formStyle form-row">
                            <div class="input-group">
                                <label>Email or Mobile<em>*</em></label>
                                <input type="text" class="form-control"
                                       placeholder="Enter your Email or Mobile">
                            </div>
                            <div class="input-group">
                                <label>Password<em>*</em></label>
                                <input type="password" class="form-control" placeholder="********">
                            </div>
                            <div class="input-group justify-content-sm-between align-items-sm-center">
                                <a class="themeBtn rounded" href="#">Sign In</a>
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
