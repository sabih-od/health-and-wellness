@extends('front.layouts.app')

@section('title', 'Membership')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="innerBanner">
        <img src="{{asset('images/innerBan.webp')}}" class="w-100" alt="">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="secHeading">Membership Rewards</h2>
                        <p>Choose the best option for you during introductory visit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="membershipInner aboutInner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="memberBox" data-aos="fade-up" data-aos-duration="2000">
                        <h2 class="secHeading">01</h2>
                        <h3>Health Management</h3>
                        <p>What services best suit your needs? Medication review, Virtual accompaniment to doctor's
                            visit, Desease specific plan with monthly follow up and supplemental holistic options.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="memberBox" data-aos="fade-up" data-aos-duration="2000">
                        <h2 class="secHeading">02</h2>
                        <h3>Health Promotion</h3>
                        <div class="points">
                            <p>Book a session</p>
                            <p><strong>Get 10 points</strong></p>
                        </div>
                        <div class="points">
                            <p>Order a plan</p>
                            <p><strong>Get 1 point for every $1 spent</strong></p>
                        </div>
                        <div class="points">
                            <p>Sign up to the site</p>
                            <p><strong>Get 50 points</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="memberBox" data-aos="fade-up" data-aos-duration="2000">
                        <h2 class="secHeading">03</h2>
                        <h3>Reward</h3>
                        <div class="points">
                            <p>10% off all bookings</p>
                            <p><strong>10 Points = 10% off the lowest <br> priced item in cart</strong></p>
                        </div>
                    </div>
                </div>
                @if(!\Illuminate\Support\Facades\Auth::check())
                    <div class="col-md-4 text-center mt-5">
                        <a href="{{route('front.signup')}}" class="themeBtn themeBtn2">Sign Up Now</a>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection

@section('script')
@endsection
