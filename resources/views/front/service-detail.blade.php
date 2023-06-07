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
                        <h2 class="secHeading">{{$service->name}}</h2>
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
                        <h3 class="subHeading">{{$service->name}}</h3>
                        <h4>{{$service->pricing_detail}}</h4>
                        <p>
                            {{$service->description}}
                        </p>
                        <a href="" class="themeBtn themeBtn2">BOok Now</a>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-duration="2000">
                    <figure>
                        <img src="{{$service->getImageUrl()}}" class="img-fluid" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
@endsection
