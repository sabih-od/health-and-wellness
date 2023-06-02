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
                                    <a class="nav-link <?= ($activePage == 'index') ? 'active' : ''; ?>" href="index.php">
                                        <figure><img src="images/icons/home.png" class="img-fluid" alt="img">
                                        </figure>
                                        Home <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'all-sessions') ? 'active' : ''; ?>" href="all-sessions.php">
                                        <figure><img src="images/icons/sessions.png" class="img-fluid" alt="img">
                                        </figure>
                                        All Sessions
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'book-session') ? 'active' : ''; ?>" href="book-session.php">
                                        <figure><img src="images/icons/booking.png" class="img-fluid" alt="img"></figure>
                                        Book Sessions
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <figure><img src="images/icons/settings.png" class="img-fluid" alt="img"></figure>
                                        Settings
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li class="nav-item">
                                            <a class="nav-link <?= ($activePage == 'profile') ? 'active' : ''; ?>" href="profile.php">
                                                <figure><img src="images/invoice.png" class="img-fluid" alt="img"></figure>
                                                Profile
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?= ($activePage == 'edit-profile') ? 'active' : ''; ?>" href="edit-profile.php">
                                                <figure><img src="images/invoice.png" class="img-fluid" alt="img"></figure>
                                                Edit Profile
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?= ($activePage == 'edit-password') ? 'active' : ''; ?>" href="edit-password.php">
                                                <figure><img src="images/invoice.png" class="img-fluid" alt="img"></figure>
                                                Edit Password
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                            <div class="logout mt-auto">
                                <a class="nav-link" href="#">
                                    <figure><img src="images/icons/logout.png" class="img-fluid" alt="img"></figure>
                                   Log Out
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>