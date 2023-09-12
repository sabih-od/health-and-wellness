<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="shortcut icon" href="{{asset('images/aboutFlower.webp')}}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/slick.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/slick-theme.min.css')}}"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/custom.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
          integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="icon" type="image/x-icon"
          href="{{ asset('/uploads/settings/'.$setting->favicon ?? 'front/images/logo.png') }}">
    <title>@yield('title')
        | {{(isset($setting) && !is_null($setting['site_title'])) ? $setting['site_title'] : 'Health and wellness education corporation'}}</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    @yield('css')
</head>

<body>
<!-- Begin: Header -->

<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg p-0">
            <a class="navbar-brand" href="{{route('front.home')}}">
                <img
                    src="{{isset($setting->logo) ? URL::asset('uploads/settings/'.$setting->logo) : URL::asset('admin/dist/img/AdminLTELogo.png')}}"
                    alt="img">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fas fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('front.home')}}">Home <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('front.about')}}">About Me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('front.faq')}}">FAQ</a>
                    </li>
                    <li class="nav-item customDropdown">
                        <a class="nav-link" href="{{route('front.services')}}">Services</a>
                        <ul class="menu">
                            @foreach($services as $service)
                                <li>
                                    <a href="{{route('serviceDetail', $service->id)}}">{{$service->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('front.gift-card')}}">Gift Card</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('front.membership')}}">Membership Rewards</a>
                    </li>
                </ul>
                <div class="form-inline">
                    <a href="{{route('front.membership')}}" class="themeBtn">Contact us</a>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <a href="{{route('front.login')}}"
                           class="loginLink"> <img src="{{ Auth::user()->get_profile_picture() }}"> </a>
                    @else
                        <a href="{{route('front.login')}}" class="loginLink"><i class="fas fa-user"></i></a>
                    @endif

                </div>
            </div>
        </nav>
    </div>
</header>

@yield('content')

<!-- Begin: Footer -->
<footer>
    <div class="container">
        <div class="row justify-content-between align-items-lg-center">
            <div class="col-md-4">
                <a href="" class="footLogo">
                    <img src="{{asset('images/footLogo.webp')}}" class="img-fluid" alt="">
                </a>
                <ul class="socialLinks">

                    @if ($setting->facebook)
                        <li><a href="{{$setting->facebook ?? ''}}"><i class="fab fa-facebook-f"></i></a></li>

                    @endif

                    @if ($setting->twitter)
                        <li><a href="{{$setting->tweeter ?? ''}}"><i class="fab fa-twitter"></i></a></li>

                    @endif

                    @if ($setting->instagram)
                        <li><a href="{{$setting->instagram ?? ''}}"><i class="fab fa-instagram"></i></a></li>

                    @endif


                </ul>
            </div>
            <div class="col-md-4">
                <h4>Quick Links</h4>
                <ul class="links">
                    <li><a href="{{route('front.home')}}">Home</a></li>
                    <li><a href="{{route('front.about')}}">About Me</a></li>
                    <li><a href="{{route('front.faq')}}">FAQ</a></li>
                    <li><a href="{{route('front.services')}}">Services</a></li>
                    <li><a href="{{route('front.gift-card')}}">Gift Card</a></li>
                    <li><a href="{{route('front.membership')}}">Membership Rewards</a></li>
                    <li><a href="{{route('front.contact')}}">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>Contact Us</h4>
                <ul class="contactLinks">
                    @if($setting->phone_no_1)
                        <li><a href="tel:{{$setting->phone_no_1 ?? ''}}"><img src="{{asset('images/call.webp')}}" class="img-fluid"
                                                          alt="">{{$setting->phone_no_1 ?? ''}}</a>
                        </li>
                    @endif

                    @if($setting->email)
                        <li><a href="mailto:{{$setting->email ?? ''}}"><img src="{{asset('images/email.webp')}}"
                                                                         class="img-fluid"
                                                                         alt="">{{$setting->email ?? ''}}</a></li>
                    @endif

                    @if($setting->address)
                        <li><a href=""><img src="{{asset('images/pin.webp')}}" class="img-fluid"
                                            alt="">{{$setting->address ?? ''}}</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="row copyRight">
            <div class="col-md-12 text-center">
                <p>Copyright © 2023 Health And Wellness Education Corporation. All Right Reserved</p>
            </div>
        </div>
    </div>
</footer>
<!-- END: Footer -->


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('js/all.min.js')}}"></script>
<script src="{{asset('js/slick.min.js')}}"></script>
<script src="{{asset('js/aos.js')}}"></script>
<script src="{{asset('js/gsap.js')}}"></script>
<script src="{{asset('js/scrollTrigger.js')}}"></script>
<script src="{{asset('js/custom.min.js')}}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
      integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
      crossorigin="anonymous" referrerpolicy="no-referrer"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if(session()->has('success'))
    <script type="text/javascript">  toastr.success('{{ session('success')}}');</script>
    @php session()->remove('success'); @endphp
@endif
@if(session()->has('error'))
    <script type="text/javascript"> toastr.error('{{ session('error')}}');</script>
@endif

@yield('script')

<script>
    $(document).ready(function () {
        // alert('ready');
    });
</script>


</body>

</html>
