@extends('front.layouts.app')

@section('title', 'Health')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="innerBanner">
        <img src="{{asset('images/innerBan.webp')}}" class="w-100" alt="">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="secHeading">{{$session->session->name ?? ''}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="serviceInner aboutInner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6" data-aos="fade-right" data-aos-duration="2000">
                    <div class="servicesContents">
                        <h3 class="subHeading">Service : {{$service->name ?? ''}}</h3>
                        <p>Service Description : {!! $service->description ?? '' !!}</p>
{{--                        <h4>Pricing detail : {{$service->pricing_detail ?? ''}}</h4>--}}

{{--                        <p>--}}
{{--                            Booked By : {{$session->name ?? ''}}--}}
{{--                        </p>--}}

{{--                        <p>--}}
{{--                            Booked User Email : {{$session->email ?? ''}}--}}
{{--                        </p>--}}

{{--                        <p>--}}
{{--                            Session Fees : {{$session->session->fees ?? ''}}--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            Session Time : {{$session->sessionTiming->session_time ?? ''}}--}}
{{--                        </p>--}}
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-duration="2000">
                    <figure>
                        <img src="{{$service->get_service_picture()}}" class="img-fluid" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
@endsection
