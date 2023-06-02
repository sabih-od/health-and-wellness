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
                        <form action="" class="formStyle form-row">
                            <div class="input-group">
                                <label>First Name<em>*</em></label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="input-group">
                                <label>Last Name<em>*</em></label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="input-group">
                                <label>Email Address<em>*</em></label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="input-group">
                                <label>Password<em>*</em></label>
                                <input type="text" class="form-control" placeholder="At least 6 characters">
                            </div>
                            <div class="input-group">
                                <label>Re-enter password<em>*</em></label>
                                <input type="text" class="form-control" placeholder="At least 6 characters">
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
