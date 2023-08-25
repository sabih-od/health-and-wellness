@extends('dashboard.layouts.app')

@section('title', 'Payment')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="col-lg-9 mx-xl-auto dashboardcontent editprof booking">
        <div class="row">
            <div class="col-md-12">
                <div class="orderContent listNon">
                    <div>
                        <h2>Payment</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <form class="row formStyle" action="thank-you.php">
                    <div class="col-md-12 mb-4 text-center">
                        <img src="images/card-img.png" alt="img">
                    </div>
                    <div class="col-md-6">
                        <label>card number</label>
                        <input type="number" class="form-control" placeholder="card number">
                    </div>
                    <div class="col-md-6">
                        <label>name on card</label>
                        <input type="text" class="form-control" placeholder="card title">
                    </div>
                    <div class="col-md-4">
                        <label>expiration date</label>
                        <input type="date" class="form-control" placeholder="mm/yy">
                    </div>
                    <div class="col-md-2">
                        <label>cvv</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <div class="checkbox mt-4">
                            <input type="checkbox" id="box-2">
                            <label for="box-2">
                                <h5>save card</h5><span>information is encrypted and securely stored.</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="applyCoupon d-sm-flex">
                            <button class="themeBtn btnStyle btn-block">Place Order</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@section('script')
@endsection
