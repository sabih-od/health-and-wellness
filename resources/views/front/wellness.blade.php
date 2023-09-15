@extends('front.layouts.app')

@section('title', 'Education')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="innerBanner">
        <img src="{{asset('images/innerBan.webp')}}" class="w-100" alt="">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="secHeading">Education</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="serviceInner aboutInner">
        <div class="container">

            @forelse($courses as $course)
                <div class="row align-items-center">
                    <div class="col-md-6" data-aos="fade-left" data-aos-duration="2000">
                        <div class="servicesContents">
                            <h3 class="subHeading">{{ $course->course_title ?? '' }}</h3>
                            <h4 style="margin-bottom: 4% !important;">{{ $course->time_detail ?? ''}}</h4>
                            <h6 class="text-success">$ {{$course->price ?? ''}}</h6>

                            <p>
                                {{$course->course_description ?? ''}}
                            </p>

                            {{--                                <a href="" class="themeBtn themeBtn2">BOok Now</a>--}}

                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-right" data-aos-duration="2000">
                        <figure>
                            @php
                                $media = $course->getMedia('course_attachment')->first();
                            @endphp

                            @if ($media)
                                @if (strpos($media->mime_type, 'image') !== false)
                                    <img src="{{ $media->getUrl() }}" class="img-fluid serviceInner-img" alt="">
                                @elseif (strpos($media->mime_type, 'video') !== false)
                                    <video controls class="img-fluid">
                                        <source src="{{ $media->getUrl() }}" type="{{ $media->mime_type }}">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <div class="file-outer">
                                        <a class="file" href="{{ $media->getUrl() }}" download><i
                                                class="fas fa-file"></i></a>

                                    </div>
                                @endif
                            @else
                                <img src="{{ asset('images/service.webp') }}" class="img-fluid serviceInner-img" alt="">
                            @endif
                        </figure>
                    </div>
                </div>
            @empty
                <h5>No Course Found</h5>
            @endforelse
        </div>
    </section>

@endsection

@section('script')
@endsection
