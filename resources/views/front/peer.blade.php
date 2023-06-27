@extends('front.layouts.app')

@section('title', 'stream')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="innerBanner">
        <img src="{{asset('images/innerBan.webp')}}" class="w-100" alt="">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="secHeading">Session Stream</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="aboutSec aboutInner">
        <div class="container">
            <div class="row align-items-end">
                <h1>Hello</h1>
            </div>
        </div>
    </section>

@endsection

@section('script')
@endsection
