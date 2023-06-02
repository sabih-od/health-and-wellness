@extends('dashboard.layouts.app')

@section('title', 'Edit Profile')
@section('description', '')
@section('keywords', '')

@section('content')

    <div class="col-md-9 mx-auto dashboardcontent editprof booking">
        <div class="row">
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="accountAccesSec">
                                <div class="whitebg">
                                    <h2><span>Edit Profile</span></h2>
                                    <form action="" class="formStyle form-row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Name<em>*</em></label>
                                                <input type="text" class="form-control"
                                                       placeholder="Enter your Email or Mobile">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Email<em>*</em></label>
                                                <input type="email" class="form-control" placeholder="********">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Phone<em>*</em></label>
                                                <input type="text" class="form-control"
                                                       placeholder="Enter your Email or Mobile">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>City<em>*</em></label>
                                                <input type="email" class="form-control" placeholder="********">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Zip<em>*</em></label>
                                                <input type="text" class="form-control"
                                                       placeholder="Enter your Email or Mobile">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Fax<em>*</em></label>
                                                <input type="email" class="form-control" placeholder="********">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Address<em>*</em></label>
                                                <input type="text" class="form-control"
                                                       placeholder="Enter your Email or Mobile">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Bio<em>*</em></label>
                                                <input type="email" class="form-control" placeholder="********">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <label>Bio<em>*</em></label>
                                                <input type="email" class="form-control" placeholder="********">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group justify-content-sm-between align-items-sm-center">
                                                <a class="themeBtn rounded" href="#">Save Changes</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- section css end -->
    </div>

@endsection

@section('script')
@endsection
