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
            @foreach($services as $key => $service)
                <div class="row align-items-center">
                    @if ($key % 2 == 0)
                        <div class="col-md-6" data-aos="fade-left" data-aos-duration="2000">
                            <figure>
                                <img src="{{$service->getImageUrl()}}" class="img-fluid" alt="">
                            </figure>
                        </div>
                    @endif
                    <div class="col-md-6" data-aos="fade-right" data-aos-duration="2000">
                        <div class="servicesContents">
                            <h3 class="subHeading">{{$service->name ?? ''}}</h3>
                            <p>
                                {!! $service->description ?? '' !!}
                            </p>
                            <h4>{{$service->pricing_detail ?? ''}}</h4>
                            <a href="" class="themeBtn themeBtn2">BOok Now</a>
                        </div>
                    </div>
                    @if ($key % 2 != 0)
                        <div class="col-md-6" data-aos="fade-left" data-aos-duration="2000">
                            <figure>
                                <img src="{{$service->getImageUrl()}}" class="img-fluid" alt="">
                            </figure>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

@endsection

@section('script')
@endsection
