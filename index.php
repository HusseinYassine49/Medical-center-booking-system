<?php
require "assets/php/connection.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>home page </title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <!-- <link href="assets/img/favicon.png" rel="icon"> -->
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->

    <!-- Vendor CSS Files -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/carousel/">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Medilab
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }
</style>

<body>


    </div>

    <!-- End Header -->

    <!-- ======= Hero Section ======= -->

    <!-- End Hero -->


    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center ">

            <h1 class="logo me-auto"><a href="index.html">logo</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>

                    <li><a class="nav-link scrollto" href="#doctors">Doctors</a></li>


                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->

            <a href="assets/html/login.html" class="btn btn-primary me-md-2"><span class=" d-md-inline">Login</span>
            </a>

        </div>
    </header>
    <div class="container " id="hero" style="width: 100%; max-width: 100%; ">
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner w-100">
                <div class="carousel-item active">
                    <img src="./assets/img/1.jpg" class="d-block w-100" alt="First slide">

                    <div class="container">
                        <div class="carousel-caption text-end ">
                            <h1>"Book your Appointment Online".</h1>
                            <p>Conveniently schedule your next appointment online with just a few clicks.</p>
                            <!--   <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p> -->
                        </div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <img src="./assets/img/2.jpg" class="d-block w-100" alt="Second slide">

                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1>Find the Right Doctor for You.</h1>
                            <p>Receive Quality Healthcare Anytime, Anywhere.</p>
                            <!--  <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p> -->
                        </div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <img src="./assets/img/3.jpg" class="d-block w-100" style="height: 100%;" alt="Third slide">

                    <div class="container">
                        <div class="carousel-caption text-end">
                            <h1>Get access </h1>
                            <p>to top-quality healthcare services from the comfort of your home with our
                                online booking system..</p>
                            <!--    <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p> -->
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <main id="main">
        <!-- ======= Why Us Section ======= -->




        <!-- End Why Us Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xl-6 col-lg-6   align-items-stretch position-relative">
                        <img src="./assets/img/image.png" class="img-fluid rounded mx-auto d-block ">
                    </div>

                    <div style="background-color: #2262b1; color: aliceblue;" class="col-xl-6 col-lg-6 icon-boxes  flex-column align-items-stretch justify-content-center py-5 px-lg-5">
                        <h3>Mission:</h3>
                        <p>"To provide accessible, efficient, and reliable healthcare services by connecting patients
                            with qualified healthcare professionals through an intuitive and user-friendly online
                            booking platform.".</p>

                        <h3>Vision:</h3>
                        <p>"To revolutionize the way healthcare services are accessed and delivered, making quality
                            healthcare available to everyone, anytime, anywhere."</p>

                    </div>
                </div>

            </div>
        </section>
        <!-- End About Section -->


        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container">

                <div class="row">

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="fas fa-user-md"></i>
                            <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Doctors</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                        <div class="count-box">
                            <i class="far fa-hospital"></i>
                            <span data-purecounter-start="0" data-purecounter-end="18" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Departments</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="fas fa-flask"></i>
                            <span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Research Labs</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="fas fa-award"></i>
                            <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>
                            <p>Awards</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- End Counts Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <section class="border p-4 mb-4 d-flex align-items-center flex-column">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
                    <!-- Container wrapper -->
                    <div class="container-fluid">

                        <div class="nav-item dropdown js-example-basic-single">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-mdb-dropdown-init aria-expanded="false">
                                Type Doctors
                            </a>
                            <!-- Dropdown menu -->
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>

                        </ul>
                        <!-- Left links -->

                        <!-- Search form -->
                        <div class="input-group ps-5">
                            <div id="navbar-search-autocomplete" class="form-outline" data-mdb-input-init>
                                <input type="search" id="form1" class="form-control" />

                            </div>
                            <button type="button" class="btn btn-primary" data-mdb-ripple-init>
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Collapsible wrapper -->
                    </div>
                    <!-- Container wrapper -->
                </nav>
                <!-- Navbar -->
            </section>
            <div class="container">

                <div class="section-title">
                    <h2>Services</h2>
                    <p></p>
                </div>

                <div class="row " style=' 
                margin-left: 5%;
                width: 100%;
                padding: 10px;
              '>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-heartbeat"></i></div>
                            <h4><a href="">Online Booking</a></h4>
                            <p>Online Appointment Booking</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-pills"></i></div>
                            <h4><a href="">Patient</a></h4>
                            <p>Patient Feedback and Ratings </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                        <div class="icon-box">
                            <div class="icon"><i class="fas fa-hospital-user"></i></div>
                            <h4><a href="">AI-Powered</a></h4>
                            <p>AI-Powered Chatbot Assistance</p>
                        </div>
                    </div>


                </div>

            </div>
        </section>
        <!-- End Services Section -->




        <!-- End Departments Section -->
        <br>
        <!-- ======= Doctors Section ======= -->
        <section id="doctors" class="doctors">
            <div class="container">

                <div class="section-title">
                    <h2>Doctors</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                        sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                        ea. Quia fugiat sit in iste officiis commodi
                        quidem hic quas.</p>
                </div>

                <div class="row">

                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <div class="member d-flex align-items-start">
                            <div class="pic"><img src="assets/img/doctors/doctors-2.jpg" class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>Sarah Jhonson</h4>
                                <span>Anesthesiologist</span>
                                <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                                <div class="social">
                                    <a href=""><i class="ri-twitter-fill"></i></a>
                                    <a href=""><i class="ri-facebook-fill"></i></a>
                                    <a href=""><i class="ri-instagram-fill"></i></a>
                                    <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <div class="member d-flex align-items-start">
                            <div class="pic"><img src="assets/img/doctors/doctors-2.jpg" class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>Sarah Jhonson</h4>
                                <span>Anesthesiologist</span>
                                <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                                <div class="social">
                                    <a href=""><i class="ri-twitter-fill"></i></a>
                                    <a href=""><i class="ri-facebook-fill"></i></a>
                                    <a href=""><i class="ri-instagram-fill"></i></a>
                                    <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </section>


        <!-- ======= Gallery Section ======= -->

        <!-- End Gallery Section -->


    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">


            <div class="container d-md-flex py-4">

                <div class="me-md-auto text-center text-md-start">

                    <div class="credits">

                    </div>
                </div>
                <div class="social-links text-center text-md-right pt-3 pt-md-0">
                    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
            </div>
    </footer>
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>



</body>

</html>