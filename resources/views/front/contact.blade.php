@extends('front.layouts.app')

@section('title', 'Contact')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="innerBanner">
        <img src="{{asset('images/innerBan.webp')}}" class="w-100" alt="">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="secHeading">Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="contctPAge">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        @if($setting->address)
                            <div class="col-sm-4">
                                <div class="listCntct" data-aos="fade-right">
                                    <figure>
                                        <img src="{{asset('images/pin1.webp')}}" class="img-fluid" alt="">
                                    </figure>
                                    <h4>Address</h4>
                                    <a href="#">
                                        {{ $setting->address ?? '' }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if($setting->phone_no_1 || $setting->phone_no_2)
                            <div class="col-sm-4">
                                <div class="listCntct" data-aos="fade-down">
                                    <figure>
                                        <img src="{{asset('images/call1.webp')}}" class="img-fluid" alt="">
                                    </figure>
                                    <h4>Phone</h4>
                                    <a href="tel:{{$setting->phone_no_1 != null ? $setting->phone_no_1 : $setting->phone_no_2}}">{{$setting->phone_no_1 != null ? $setting->phone_no_1 : $setting->phone_no_2}}</a>
                                </div>
                            </div>
                        @endif

                        @if($setting->email)
                            <div class="col-sm-4">
                                <div class="listCntct" data-aos="fade-left">
                                    <figure>
                                        <img src="{{asset('images/mail1.webp')}}" class="img-fluid" alt="">
                                    </figure>
                                    <h4>Email</h4>
                                    <a href="mailto:{{$setting->email ?? ''}}">{{$setting->email ?? ''}}</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cntctInner aboutInner">
        <div class="containerfluid">
            <div class="row align-items-center justify-content-left">
                <div class="col-md-6">
                    <figure class="contImg" data-aos="fade-right">
                        <img src="{{asset('images/contctImg.webp')}}" class="img-fluid" alt="">
                    </figure>
                </div>
                <div class="col-md-5" data-aos="fade-right">
                    <div class="getForm">
                        <h2 class="secHeading">Contact Us</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s.</p>
                        <form action="{{ route('contact.via.mail') }}" method="POST" class="contctForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control"
                                               placeholder="Enter your name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control"
                                               placeholder="Enter your email" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control"
                                               placeholder="Type the subject" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea rows="6" name="message" class="form-control"
                                                  placeholder="Type your message here" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="themeBtn themeBtn2" type="submit">Submit Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@section('script')
@endsection
