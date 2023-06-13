<?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>


<section class="dashboard">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-md-3">
                <div class="sideNAvigation">
                    <nav class="navbar navbar-expand-lg p-0">

                        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button> -->
                        <div class="collapse navbar-collapse" id="">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'index') ? 'active' : ''; ?>"
                                       href="index.php">
                                        <figure><img src="../../dashboard/images/home.png" class="img-fluid" alt="img">
                                        </figure>
                                        Home <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'all-orders') ? 'active' : ''; ?>"
                                       href="all-orders.php">
                                        <figure><img src="../../dashboard/images/order.png" class="img-fluid" alt="img">
                                        </figure>
                                        Orders
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($activePage == 'add-new-product') ? 'active' : ''; ?>"
                                       href="order-details.php">
                                        <figure><img src="../../dashboard/images/create.png" class="img-fluid"
                                                     alt="img"></figure>
                                        Create Order
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <figure><img src="../../dashboard/images/product.png" class="img-fluid"
                                                     alt="img"></figure>
                                        Products
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li class="nav-item">
                                            <a class="nav-link <?= ($activePage == 'all-products') ? 'active' : ''; ?>"
                                               href="all-products.php">
                                                <figure><img src="../../dashboard/images/order.png" class="img-fluid"
                                                             alt="img">
                                                </figure>
                                                All Product
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?= ($activePage == 'add-product') ? 'active' : ''; ?>"
                                               href="add-product.php">
                                                <figure><img src="../../dashboard/images/create.png" class="img-fluid"
                                                             alt="img"></figure>
                                                Add Product
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="all-team-members.php">
                                        <figure><img src="../../dashboard/images/team.png" class="img-fluid" alt="img">
                                        </figure>
                                        Team Members
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="invoice-details.php">
                                        <figure><img src="../../dashboard/images/invoice.png" class="img-fluid"
                                                     alt="img"></figure>
                                        Inovices
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="banner-purchase.php">
                                        <figure><img src="../../dashboard/images/advertise.png" class="img-fluid"
                                                     alt="img"></figure>
                                        Advertising
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <figure><img src="../../dashboard/images/message.png" class="img-fluid"
                                                     alt="img"></figure>
                                        Message
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <figure><img src="../../dashboard/images/manage.png" class="img-fluid"
                                                     alt="img"></figure>
                                        Manage Membership
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <figure><img src="../../dashboard/images/setting.png" class="img-fluid"
                                                     alt="img"></figure>
                                        Settings
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li class="nav-item">
                                            <a class="nav-link <?= ($activePage == 'profile.php') ? 'active' : ''; ?>"
                                               href="vendor-profile.php">
                                                <figure><img src="../../dashboard/images/invoice.png" class="img-fluid"
                                                             alt="img"></figure>
                                                Profile
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link <?= ($activePage == 'edit-profile.php') ? 'active' : ''; ?>"
                                               href="edit-profile.php">
                                                <figure><img src="../../dashboard/images/invoice.png" class="img-fluid"
                                                             alt="img"></figure>
                                                Edit Profile
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="vendor-customer.php">
                                        <figure><img src="../../dashboard/images/previous.png" class="img-fluid"
                                                     alt="img"></figure>
                                      Customers
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
