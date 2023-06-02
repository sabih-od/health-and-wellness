@extends('dashboard.layouts.app')

@section('title', 'Booking')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="col-md-9 mx-auto dashboardcontent editprof booking">
        <div class="row">
            <div class="col-md-12">
                <div class="orderContent listNon">
                    <div>
                        <h2>Booking Form</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="recentTable editProfile">
                    <form class="editForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Your Name*</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" placeholder="john Smith">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Email *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" placeholder="johnsmith@gmial.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Phone *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" placeholder="+123 456 7890">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Address*</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" placeholder="Space Needle 000 Broad St, Seattles">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Service *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select>
                                            <option value="">Health</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Session *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select>
                                            <option value="">Mindful Retreat</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Date *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row align-items-start">
                                    <div class="col-md-3">
                                        <label>Time *</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="time">
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="row align-items-start">
                            <div class="col-md-1">
                                <label>Details *</label>
                            </div>
                            <div class="col-md-10 mx-auto">
                                <textarea placeholder="Lorem Ipsum is simply dummy text"></textarea>
                                <button onclick="window.location.href='payment.php'" class="themeBtn"
                                        type="button">continue</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('script')
@endsection
