@extends('front.layouts.app')

@section('title', 'Faq')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="innerBanner">
        <img src="{{asset('images/innerBan.webp')}}" class="w-100" alt="">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="secHeading">FAQ</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="faqInner aboutInner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <div class="faqHeadings text-center">
                        <h2 class="secHeading">FREQUENTLY ASKED QUESTIONS</h2>
                        <h4 data-aos="fade-up" data-aos-duration="2000">For Your Information</h4>
                        <p data-aos="fade-up" data-aos-duration="2000">Here are some frequently asked questions that I
                            tend to receive. If you still have something
                            you’d like to know, feel free to contact me for more details and I will do my best to help
                            you get all the information you need.</p>
                    </div>
                </div>
            </div>

            @foreach($faqs as $index => $faq)
                <div class="row justify-content-center align-items-center @if($index % 2 == 1) flex-row-reverse @endif">
                    <div class="col-md-6">
                        <div class="faqsContents" data-aos="fade-right" data-aos-duration="2000">
                            <h3> {{ $faq->question ?? '' }} </h3>
                            <p>{{ $faq->answer ?? '' }}</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-left" data-aos-duration="2000">
                        <figure>
                            <!-- <img src="{{ $faq->get_faq_picture() }}" class="img-fluid" alt=""> -->
                            <img src="{{asset('images/img1.webp')}}" class="img-fluid" alt="">
                        </figure>
                    </div>

                    <div class="bordrPath">
                        <img src="{{asset('images/path1.webp')}}" class="img-fluid path1" alt="">
                        @if($index % 2 == 1)
                        <img src="{{asset('images/path2.webp')}}" class="img-fluid path2" alt="">
                        @endif
                    </div>

                </div>
            @endforeach


            {{--            <div class="row justify-content-center align-items-center">--}}
            {{--                <div class="col-md-6">--}}
            {{--                    <div class="faqsContents" data-aos="fade-right" data-aos-duration="2000">--}}
            {{--                        <h3>How can I start working with you?</h3>--}}
            {{--                        <p>To start your journey with us please schedule an introductory consultation session under the--}}
            {{--                            Our service section.</p>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-md-4" data-aos="fade-left" data-aos-duration="2000">--}}
            {{--                    <figure>--}}
            {{--                        <img src="{{asset('images/img1.webp')}}" class="img-fluid" alt="">--}}
            {{--                    </figure>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <div class="row justify-content-center align-items-center flex-row-reverse">--}}
            {{--                <div class="col-md-6">--}}
            {{--                    <div class="faqsContents" data-aos="fade-left" data-aos-duration="2000">--}}
            {{--                        <h3>Do you offer group consultations or workshops?</h3>--}}
            {{--                        <p>I offer a six weeks virtual Holistic health management group. As well as Medication--}}
            {{--                            administration course- a state certified program. If you were looking for something--}}
            {{--                            different from that please contact us at healthandwellnessed@gmail.com</p>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-md-4" data-aos="fade-right" data-aos-duration="2000">--}}
            {{--                    <figure>--}}
            {{--                        <img src="{{asset('images/img2.webp')}}" class="img-fluid" alt="">--}}
            {{--                    </figure>--}}
            {{--                </div>--}}
            {{--                <div class="bordrPath">--}}
            {{--                    <img src="{{asset('images/path1.webp')}}" class="img-fluid path1" alt="">--}}
            {{--                    <img src="{{asset('images/path2.webp')}}" class="img-fluid path2" alt="">--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <div class="row justify-content-center align-items-center">--}}
            {{--                <div class="col-md-6">--}}
            {{--                    <div class="faqsContents" data-aos="fade-right" data-aos-duration="2000">--}}
            {{--                        <h3>What should I prepare for my initial consultation?</h3>--}}
            {{--                        <p>To prepare for your initial appointment, please complete the health survey Form which was--}}
            {{--                            sent to you after you scheduled the appointment. As this will be virtual, be prepared to be--}}
            {{--                            on video camera- this creates better interpersonal connection as you start your journey.</p>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-md-4" data-aos="fade-left" data-aos-duration="2000">--}}
            {{--                    <figure>--}}
            {{--                        <img src="{{asset('images/img3.webp')}}" class="img-fluid" alt="">--}}
            {{--                    </figure>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </section>

@endsection

@section('script')
@endsection
