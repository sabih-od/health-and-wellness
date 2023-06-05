<!DOCTYPE html>
<html lang="en">

    <head>

        <!-- Required meta tags -->
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('dashboard/css/all.min.css')}}"/>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('dashboard/css/evo-calendar.css')}}"/>
        <link rel="stylesheet" href="{{asset('dashboard/css/custom.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('dashboard/css/responsive.css')}}"/>

        <title>@yield('title')
            | {{(isset($setting) && !is_null($setting['site_title'])) ? $setting['site_title'] : 'Health And Wellness Education Corporation Portal Design'}}</title>
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">

        @yield('css')
    </head>

    <body>
    <!-- Begin: Header -->

        <header>
            <div class="topBar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="deliveryList">
                                <ul>
                                    <li>
                                        <a href="index.php" class="logo"><img src="{{asset('dashboard/images/logo1.png')}}" class="img-fluid"
                                                                              alt="img"></a>
                                    </li>
                                    <li>
                                        <div class="search">
                                            <input type="text" class="form-control" placeholder="Search here">
                                            <button class="btn btnsearch"><i class="far fa-search"></i></button>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="heloMain">
                                            <div class="user">
                                                <a href="login.php"><i class="fas fa-user"></i></a>
                                            </div>
                                            <div class="heloContent">
                                                <div class="dropdown">
                                                    <a href="notification.php" class="btn usernotify">
                                                        <i class="fas fa-bell"></i>
                                                        <span class="notifycount">3</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="heloContent">
                                                <div class="dropdown">
                                                    <button class="btn userprofile dropdown-toggle" type="button"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                        <img src="{{asset('dashboard/images/user.png')}}" alt="">
                                                        <div>
                                                            @php
                                                                $user = \Illuminate\Support\Facades\Auth::user();
                                                                $name = $user->first_name . ' ' . $user->last_name;
                                                            @endphp
                                                            <h6 class="mb-0">{{$name}}</h6>
                                                            <span class="">Health</span>
                                                        </div>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Edit Profile</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- END: Header -->

        <?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>


        <section class="dashboard">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-lg-2 col-md-3">
                        <div class="sideNAvigation">
                            <nav class="navbar navbar-expand-lg p-0">

                                <div class="collapse navbar-collapse" id="">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link <?= ($activePage == 'index') ? 'active' : ''; ?>"
                                               href="index.php">
                                                <figure><img src="{{asset('dashboard/images/icons/home.png')}}" class="img-fluid" alt="img">
                                                </figure>
                                                Home <span class="sr-only">(current)</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?= ($activePage == 'all-sessions') ? 'active' : ''; ?>"
                                               href="all-sessions.php">
                                                <figure><img src="{{asset('dashboard/images/icons/sessions.png')}}" class="img-fluid" alt="img">
                                                </figure>
                                                All Sessions
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?= ($activePage == 'book-session') ? 'active' : ''; ?>"
                                               href="book-session.php">
                                                <figure><img src="{{asset('dashboard/images/icons/booking.png')}}" class="img-fluid" alt="img">
                                                </figure>
                                                Book Sessions
                                            </a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">
                                                <figure><img src="{{asset('dashboard/images/icons/settings.png')}}" class="img-fluid" alt="img">
                                                </figure>
                                                Settings
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li class="nav-item">
                                                    <a class="nav-link <?= ($activePage == 'profile') ? 'active' : ''; ?>"
                                                       href="profile.php">
                                                        <figure><img src="{{asset('dashboard/images/invoice.png')}}" class="img-fluid" alt="img">
                                                        </figure>
                                                        Profile
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link <?= ($activePage == 'edit-profile') ? 'active' : ''; ?>"
                                                       href="edit-profile.php">
                                                        <figure><img src="{{asset('dashboard/images/invoice.png')}}" class="img-fluid" alt="img">
                                                        </figure>
                                                        Edit Profile
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link <?= ($activePage == 'edit-password') ? 'active' : ''; ?>"
                                                       href="edit-password.php">
                                                        <figure><img src="{{asset('dashboard/images/invoice.png')}}" class="img-fluid" alt="img">
                                                        </figure>
                                                        Edit Password
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                    </ul>
                                    <div class="logout mt-auto">
                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                        <a class="nav-link" href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <figure><img src="{{asset('dashboard/images/icons/logout.png')}}" class="img-fluid" alt="img"></figure>
                                            Log Out
                                        </a>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>


                @yield('content')

                <!-- section css end -->
                </div>
            </div>
        </section>


        <!-- Begin: Footer -->
        <!-- <footer>
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        <a href="#" class="footerLogo"><img src="../../dashboard/images/new-logo.png" class="img-fluid"
                                alt="img"></a>
                    </div>
                    <div class="col-md-2">
                        <div class="quickList">
                            <ul>
                                <li><a href="collections.php">Best Sellers</a></li>
                                <li><a href="collections.php">Travel & Outdoor</a></li>
                                <li><a href="collections.php">Garden & Patio</a></li>
                                <li><a href="collections.php">Kitchen & Dining</a></li>
                                <li><a href="collections.php">Track Order</a></li>
                                <li><a href="collections.php">Health & Fitness</a></li>
                                <li><a href="collections.php">Phone Accessories</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="quickList">
                            <ul>
                                <li><a href="contact-us.php">Contact Us</a></li>
                                <li><a href="collections.php">Consumer Electronics</a></li>
                                <li><a href="collections.php">Auto Accessories</a></li>
                                <li><a href="collections.php">Product</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="quickList">
                            <ul>
                                <li><a href="faq.php">Faq's</a></li>
                                <li><a href="disclaimers.php">Disclaimers</a></li>
                                <li><a href="privacy-policy.php">Privacy Policy</a></li>
                                <li><a href="terms.php">Terms And Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="calFoter">
                            <ul>
                                <li><img src="../../dashboard/images/headphone.png" class="img-fluid" alt="img"> <a
                                        href="tel:1234567890"><strong>(808) 222-3333</strong></a></li>
                                <li> <img src="../../dashboard/images/email.png" class="img-fluid" alt="img"><a
                                        href="mailto:Info@youremail.com">Info@youremail.com</a>
                                </li>
                                <li><img src="../../dashboard/images/loc.png" class="img-fluid" alt="img"><span>671 Mill St
                                        Watertown North
                                        Dakota</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row copyRight">
                    <div class="col-md-6">
                        <p>© Copyright 2022. All Rights Reserved </p>
                    </div>
                    <div class="col-md-6">
                        <a href="#"><img src="../../dashboard/images/payment.png" class="img-fluid" alt="img"></a>
                    </div>
                </div>
            </div>
        </footer> -->
        <!-- END: Footer -->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{asset('dashboard/js/all.min.js')}}"></script>
        <script src="{{asset('dashboard/js/aos.js')}}"></script>
        <script src="{{asset('dashboard/js/evo-calendar.js')}}"></script>
        <script src="{{asset('dashboard/js/custom.min.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
                integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
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
