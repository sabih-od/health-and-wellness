@extends('front.layouts.app')

@section('title', 'Services')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="innerBanner">
        <img src="{{asset('images/innerBan.webp')}}" class="w-100" alt="">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="secHeading">Services</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="serviceInner aboutInner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-left" data-aos-duration="2000">
                    <figure>
                        <img src="{{asset('images/service7.webp')}}" class="img-fluid" alt="">
                    </figure>
                </div>
                <div class="col-md-6" data-aos="fade-right" data-aos-duration="2000">
                    <div class="servicesContents">
                        <h3 class="subHeading">Wellness</h3>
                        <p>
                            Work with a Spiritual Guide for wholeness
                        </p>
                        <h4>1 hr - Video Chat</h4>
                        <a href="" class="themeBtn themeBtn2">BOok Now</a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-left" data-aos-duration="2000">
                    <div class="servicesContents">
                        <h3 class="subHeading">Education</h3>
                        <p>
                            State-certified Medication Administration program
                        </p>
                        <h4>45 min - Phone or video chat</h4>
                        <a href="" class="themeBtn themeBtn2">BOok Now</a>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-right" data-aos-duration="2000">
                    <figure>
                        <img src="{{asset('images/service8.webp')}}" class="img-fluid" alt="">
                    </figure>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-left" data-aos-duration="2000">
                    <figure>
                        <img src="{{asset('images/service9.webp')}}" class="img-fluid" alt="">
                    </figure>
                </div>
                <div class="col-md-6" data-aos="fade-right" data-aos-duration="2000">
                    <div class="servicesContents">
                        <h3 class="subHeading">Health</h3>
                        <p>
                            Work with a registered nurse as your personal health coach for your medical concerns
                        </p>
                        <h4>16 hr - $400 - Virtual</h4>
                        <a href="" class="themeBtn themeBtn2">BOok Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
@endsection
