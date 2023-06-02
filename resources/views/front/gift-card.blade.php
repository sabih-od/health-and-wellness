@extends('front.layouts.app')

@section('title', 'Gift Card')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="innerBanner">
        <img src="{{asset('images/innerBan.webp')}}" class="w-100" alt="">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="secHeading">Gift Card</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="giftInner aboutInner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 text-center">
                    <div class="faqHeadings">
                        <h2 class="secHeading">Gift Card</h2>
                        <h4>$25</h4>
                        <p>You can't go wrong with a gift card. Choose an amount and write a personalized <br> message
                            to make this gift your own.</p>
                    </div>
                    <div class="giftHeadings" data-aos="fade-up" data-aos-duration="2000">
                        <h4>Who's The Gift Card For?</h4>
                    </div>
                    <div class="giftTabs" data-aos="fade-up" data-aos-duration="2000">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                   aria-controls="home" aria-selected="true">For someone else</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                   aria-controls="profile" aria-selected="false">For myself</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <form class="amountForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Amount</label>
                                            <select>
                                                <option>$__ __</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Quantity</label>
                                            <select>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Recipient Email</label>
                                            <select>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Recipient Name</label>
                                            <select>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Delivery Date</label>
                                                <input type="text" class="form-control" placeholder="Now">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Message</label>
                                                <textarea type="text" class="form-control"
                                                          placeholder="Type your message"></textarea>
                                            </div>
                                            <button>Buy Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <form class="amountForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Recipient Email</label>
                                            <select>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Recipient Name</label>
                                            <select>
                                                <option>...</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Delivery Date</label>
                                                <input type="text" class="form-control" placeholder="Now">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Message</label>
                                                <textarea type="text" class="form-control"
                                                          placeholder="Type your message"></textarea>
                                            </div>
                                            <button>Buy Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
@endsection
