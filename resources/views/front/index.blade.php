@extends('front.layouts.app')

@section('title', 'Home')
@section('description', '')
@section('keywords', '')

@section('content')

<section class="main-slider p-0" id="mainSlider">
    <div class="swiper-container homeSlider">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="slide-inner bg-image" data-background="images/mainBan.webp">
                    <div class="container">
                        <div class="row aic">
                            <div class="col-lg-9">
                                <div class="slideOne">
                                    <h2 class="secHeading" data-swiper-parallax="-200">Health and Wellness <br>
                                        Education Corporation</h2>
                                    <p data-swiper-parallax="-200">
                                        Diverse knowledge is power I alway say, so. What Ails you? let’s understand it
                                        and make appropriate changes- Spiritually, Physically and emotionally.
                                        You are Mind, Body and soul – Let’s chat. click to book a session with me for
                                        overall cleansing and healing guidance From Colon health, spirituality concerns
                                        to relationship dynamics let’s create and activate your plan- see my bio for
                                        reference.
                                    </p>
                                    <a href="{{route('front.contact')}}" class="themeBtn">Contact us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slide-inner bg-image" data-background="images/mainBan.webp">
                    <div class="container">
                        <div class="row aic">
                            <div class="col-lg-9">
                                <div class="slideOne">
                                    <h2 class="secHeading" data-swiper-parallax="-200">Health and Wellness <br>
                                        Education Corporation</h2>
                                    <p data-swiper-parallax="-200">
                                        Diverse knowledge is power I alway say, so. What Ails you? let’s understand it
                                        and make appropriate changes- Spiritually, Physically and emotionally.
                                        You are Mind, Body and soul – Let’s chat. click to book a session with me for
                                        overall cleansing and healing guidance From Colon health, spirituality concerns
                                        to relationship dynamics let’s create and activate your plan- see my bio for
                                        reference.
                                    </p>
                                    <a href="{{route('front.contact')}}" class="themeBtn">Contact us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div> -->
    </div>
    <div class="scroll">
        <a href="#about"><img src="{{asset('images/mouse.webp')}}" class="img-fluid" alt=""><span>Scroll Down</span></a>
    </div>
</section>

<section class="aboutSec" id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="aboutContent">
                    <h2 class="secHeading">About Me</h2>
                    <p data-aos="fade-right" data-aos-duration="2000">I migrated to this country from Haiti at a
                        young
                        age. As a child, I grew up watching the
                        women in the family take care of people so naturally that’s what I wanted to do. My 1st
                        career was in the social service field, after receiving my 1st. Bachelor’s degree in
                        psychology and sociology. As a Social worker, I enjoyed advocating for inner city families
                        while connecting them to various services. Along the way I was able to rise up in leadership
                        in my church where I was ordained as a minister. As a minister I got to support people of
                        all ages with spiritual and life counseling as well as mentorship. As I entered my 30s, the
                        medical field called out to me, hence receiving my second bachelor’s degree in the field of
                        Nursing. As a nurse I worked with various age groups in various settings. </p>
                    <a href="{{route('front.contact')}}" class="themeBtn themeBtn2">Contact us</a>
                </div>
            </div>
            <div class="col-md-6 circle" data-aos="fade-left" data-aos-duration="2000">
                <div class="aboutImg">
                    <img src="{{asset('images/abt1.webp')}}" class="img-fluid" alt="">
                    <img src="{{asset('images/abt2.webp')}}" class="img-fluid abt2" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="aboutBgs">
        <img src="{{asset('images/aboutFlower.webp')}}" data-aos="zoom-in" class="img-fluid flower" alt="">
        <img src="{{asset('images/aboutFruit.webp')}}" data-aos="zoom-in" class="img-fluid fruit" alt="">
    </div>
</section>

<section class="travelSegmentSec">
    <div class="container-fluid px-0">
        <div class="row justify-content-center no-gutters">
            <div class="col-md-8 text-center mb-5">
                <h2 class="secHeading">Our Services</h2>
            </div>
            <div class="col-md-12">
                <div class="travelSegment">
                    <div class="segmentCard">
                        <img src="{{asset('images/srv1.webp')}}" class="img-fluid" alt="">
                        <div class="content">
                            <h3>Education</h3>
                            <p>
                                State-certified Medication Administration program
                            </p>
                            <a href="" class="themeBtn">Book Know</a>
                        </div>
                    </div>
                    <div class="segmentCard">
                        <img src="{{asset('images/srv3.jpg')}}" class="img-fluid" alt="">
                        <div class="content">
                            <h3>Wellness</h3>
                            <p>
                                Work with a Spiritual Guide for wholeness
                            </p>
                            <a href="" class="themeBtn">Book Know</a>
                        </div>
                    </div>
                    <div class="segmentCard">
                        <img src="{{asset('images/srv2.webp')}}" class="img-fluid" alt="">
                        <div class="content">
                            <h3>Health</h3>
                            <p>
                                Work with a registered nurse as your personal health coach for your medical concerns
                            </p>
                            <a href="" class="themeBtn">Book Know</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="dreamSec">
    <div class="container">
        <h2 class="secHeading text-center">Your Dream Private Practice</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="dreamWrap" data-aos="fade-up" data-aos-duration="2000">
                    <figure>
                        <img src="{{asset('images/dream1.webp')}}" class="img-fluid" alt="">
                    </figure>
                    <div class="dreamContent">
                        <h4>RUn Your Practice, Your Way</h4>
                        <p>Access everything you need to run a thriving practice with one simple, secure solution.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dreamWrap" data-aos="fade-up" data-aos-duration="2000">
                    <figure>
                        <img src="{{asset('images/dream2.webp')}}" class="img-fluid" alt="">
                    </figure>
                    <div class="dreamContent">
                        <h4>Manage Care With Ease</h4>
                        <p>Simplify your client care experience on an easy-to-use client portal.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dreamWrap" data-aos="fade-up" data-aos-duration="2000">
                    <figure>
                        <img src="{{asset('images/dream3.webp')}}" class="img-fluid" alt="">
                    </figure>
                    <div class="dreamContent">
                        <h4>Find The Flexibility You Need</h4>
                        <p>Save time with tools that help you take control of your schedule and streamline your
                            workload.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="callusSec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="callusContent">
                    <h2 class="secHeading">Need Help Contact Us Any Time!</h2>
                    <a href="{{route('front.contact')}}" class="themeBtn">Contact us</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bookingSec">
    <div class="container">
        <h2 class="secHeading text-center">Everything You Need From Booking</h2>
        <div class="row">
            <div class="col-lg-7" data-aos="fade-right" data-aos-duration="2000">
                <figure>
                    <img src="{{asset('images/bookImg.webp')}}" class="img-fluid" alt="">
                </figure>
            </div>
            <div class="col-lg-5" data-aos="fade-up" data-aos-duration="2000">
                <div class="bookingWrap">
                    <div class="scheduleBox">
                        <img src="{{asset('images/icon1.webp')}}" class="img-fluid" alt="">
                        <h4>Scheduling<span>Send free reminders and schedule appointments on your time, on your
                                terms.</span></h4>
                    </div>
                    <div class="scheduleBox">
                        <img src="{{asset('images/icon2.webp')}}" class="img-fluid" alt="">
                        <h4>Telehealth<span>Offer HIPAA-compliant video appointments, including
                                screen-sharing.</span></h4>
                    </div>
                    <div class="scheduleBox">
                        <img src="{{asset('images/icon3.webp')}}" class="img-fluid" alt="">
                        <h4>Support<span>Rely on an all-star customer success team that’s there for you every step
                                of the way.</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faq">
    <div class="container">
        <h2 class="secHeading mb-4">Frequently Asked Questions</h2>
        <div class="row">
            <div class="col-md-12" data-aos="fade-up" data-aos-duration="2000">
                <div id="accordion">
                    @foreach($data['faqs'] as $index => $faq)
                    <div class="card">
                        <div id="heading{{ $index }}">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $index }}"
                                    aria-expanded="false"
                                    aria-controls="collapse{{ $index }}">{{ $faq->question ?? '' }}
                                    <i class="fas fa-sort-up"></i>
                                </button>
                            </h5>
                        </div>
                        <div id="collapse{{ $index }}" class="collapse" aria-labelledby="heading{{ $index }}"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p>{{ $faq->answer ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    {{--                        <div class="card ">--}}
                    {{--                            <div id="headingTwo ">--}}
                    {{--                                <h5 class="mb-0">--}}
                    {{--                                    <button class="btn btn-link collapsed" data-toggle="collapse"--}}
                    {{--                                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">--}}
                    {{--                                        Do you offer group consultations or workshops?--}}
                    {{--                                        <i class="fas fa-plus"></i>--}}
                    {{--                                    </button>--}}
                    {{--                                </h5>--}}
                    {{--                            </div>--}}
                    {{--                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"--}}
                    {{--                                 data-parent="#accordion">--}}
                    {{--                                <div class="card-body">--}}
                    {{--                                    <p>To start your journey with us please schedule an introductory consultation--}}
                    {{--                                        session under the Our service section.</p>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="card ">--}}
                    {{--                            <div id="headingTwo ">--}}
                    {{--                                <h5 class="mb-0">--}}
                    {{--                                    <button class="btn btn-link collapsed" data-toggle="collapse"--}}
                    {{--                                            data-target="#collapsethree" aria-expanded="false"--}}
                    {{--                                            aria-controls="collapsethree">--}}
                    {{--                                        What should I prepare for my initial consultation?--}}
                    {{--                                        <i class="fas fa-plus"></i>--}}
                    {{--                                    </button>--}}
                    {{--                                </h5>--}}
                    {{--                            </div>--}}
                    {{--                            <div id="collapsethree" class="collapse" aria-labelledby="headingthree"--}}
                    {{--                                 data-parent="#accordion">--}}
                    {{--                                <div class="card-body">--}}
                    {{--                                    <p>To start your journey with us please schedule an introductory consultation--}}
                    {{--                                        session under the Our service section.</p>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                </div>
            </div>
        </div>
    </div>
</section>
{{--    @dd($data);--}}
<section class="testimonials">
    <div class="container">
        <h2 class="secHeading text-center mb-5">Our Testimonials</h2>
        <div class="swiper mySwiper2">
            <div class="swiper-wrapper">
                @foreach($data['testimonials'] as $testimonial)
                <div class="swiper-slide">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="testi-wrp">
                                <img src="{{asset('images/quote.webp')}}" class="img-fluid" alt="">
                                <p>" {{ $testimonial->description ?? '' }} "</p>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
                {{--                    <div class="swiper-slide">--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-12">--}}
                {{--                                <div class="testi-wrp">--}}
                {{--                                    <img src="{{asset('images/quote.webp')}}" class="img-fluid"
                alt="">--}}
                {{--                                    <p>" Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor--}}
                {{--                                        incididunt ut labore et dolore maecenas aliqua Quis ipsum eiusmod tempor--}}
                {{--                                        incididunt ut labore et accumsan lacus vel facilisis Quis ipsum eiusmod tempor--}}
                {{--                                        incididunt ut labore et accumsan lacus vel facilisis "</p>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}

                {{--                    </div>--}}
                {{--                    <div class="swiper-slide">--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-12">--}}
                {{--                                <div class="testi-wrp">--}}
                {{--                                    <img src="{{asset('images/quote.webp')}}" class="img-fluid"
                alt="">--}}
                {{--                                    <p>" Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor--}}
                {{--                                        incididunt ut labore et dolore maecenas aliqua Quis ipsum eiusmod tempor--}}
                {{--                                        incididunt ut labore et accumsan lacus vel facilisis Quis ipsum eiusmod tempor--}}
                {{--                                        incididunt ut labore et accumsan lacus vel facilisis "</p>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}

                {{--                    </div>--}}
            </div>
        </div>
        <div thumbsSlider="" class="swiper mySwiper1">
            <div class="swiper-wrapper">
                @foreach($data['testimonials'] as $testimonial)
                <div class="swiper-slide">
                    <img src="{{ $testimonial->get_testimonial_picture() }}" class="img-fluid" />
                    <h3>{{ $testimonial->name ?? '' }}<span>{{ $testimonial->job_title ?? '' }}</span></h3>
                </div>
                @endforeach
                {{--                    <div class="swiper-slide">--}}
                {{--                        <img src="{{asset('images/user2.webp')}}" class="img-fluid"/>--}}
                {{--                        <h3>Jane Smith<span>Cleint</span></h3>--}}
                {{--                    </div>--}}
                {{--                    <div class="swiper-slide ">--}}
                {{--                        <img src="{{asset('images/user3.webp')}}" class="img-fluid"/>--}}
                {{--                        <h3>Jane Smith<span>Cleint</span></h3>--}}
                {{--                    </div>--}}
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

@endsection

@section('script')
@endsection
