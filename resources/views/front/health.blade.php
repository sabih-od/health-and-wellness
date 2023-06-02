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
                        <h2 class="secHeading">Health</h2>
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
                        <h3 class="subHeading">HEALTH</h3>
                        <h4>16 hr - $400 - Virtual</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                            non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <a href="" class="themeBtn themeBtn2">BOok Now</a>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-duration="2000">
                    <figure>
                        <img src="{{asset('images/service9.webp')}}" class="img-fluid" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
@endsection
