<?php
require "include/connection.php";
$sql = "SELECT Department_name, icon FROM department";
$result = $con->query($sql);

$sqlc = "SELECT COUNT(*) AS department_count FROM department";
$resultc = $con->query($sqlc);

$sql_departments = "SELECT COUNT(*) AS department_count FROM `department`";
$result_departments = $con->query($sql_departments);

// Fetch the count
$department_count = 0;
if ($result_departments->num_rows > 0) {
    $row_departments = $result_departments->fetch_assoc();
    $department_count = $row_departments['department_count'];
}

// Query to count the number of doctors
$sql_doctors = "SELECT COUNT(*) AS doctor_count FROM `doctors`";
$result_doctors = $con->query($sql_doctors);

// Fetch the count
$doctor_count = 0;
if ($result_doctors->num_rows > 0) {
    $row_doctors = $result_doctors->fetch_assoc();
    $doctor_count = $row_doctors['doctor_count'];
}

// Query to count the number of users
$sql_users = "SELECT COUNT(*) AS user_count FROM users where Role= 0";
$result_users = $con->query($sql_users);

// Fetch the count
$user_count = 0;
if ($result_users->num_rows > 0) {
    $row_users = $result_users->fetch_assoc();
    $user_count = $row_users['user_count'];
}

$sql_feedbacks = "SELECT COUNT(*) AS feedback_count FROM feedback";
$result_feedback = $con->query($sql_feedbacks);

// Fetch the count
$feedback_count = 0;
if ($result_feedback->num_rows > 0) {
    $row_feedback = $result_feedback->fetch_assoc();
    $feedback_count = $row_feedback['feedback_count'];
}

?>
<!DOCTYPE html>
<html lang="en">
git

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="homestyle/home.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href="homestyle/login.css" rel="stylesheet">
    <link href="homestyle/info.css" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <div class="top">
        <nav class="navbar navbar-expand-lg ">

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active ">
                        <a class="nav-link logo" href="#"> <img
                                src="assets/img/[removal.ai]_c0cb32db-1e50-436c-9b63-1a67a673b8e5__9bbc4608-6b59-4810-a978-f1022d9d2585.png"
                                style="width: 10%;height:10%">Clinic Click<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item login">
                        <a class="nav-link" href="login/login.php">
                            <div class="d-flex justify-content-between align-items-center p-2 ">
                                <i class="bi bi-box-arrow-in-right"></i><i class="fas fa-sign-in-alt login"></i>
                            </div>

                    </li>

                    <a class="nav-link list" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-list login"></i>

                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Home</a>
                        <a class="dropdown-item" href="#about">About</a>
                        <a class="dropdown-item" href="#services">Services</a>
                        <a class="dropdown-item" href="#doctors">Doctors</a>

                    </div>

                </ul>
            </div>
        </nav>
        <nav class="h-navbar">
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item active ">
                        <a class="nav-link logo" href="#">Clinic Click<span class="sr-only">(current)</span></a>
                    </li>
                    <div style="display: flex;">
                        <li class="nav-item login">
                            <a class="nav-link" href="login/login.php">
                                <div class="d-flex justify-content-between align-items-center p-2 ">
                                    <i class="bi bi-box-arrow-in-right"></i><i class="fas fa-sign-in-alt login"></i>
                                </div>
                            </a>
                        </li>

                        <a class="nav-link list" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-list login"></i>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Home</a>
                            <a class="dropdown-item" href="#about">About</a>
                            <a class="dropdown-item" href="#services">Services</a>
                            <a class="dropdown-item" href="#doctors">Doctors</a>

                        </div>
                    </div>
                </ul>
            </div>
        </nav>
        <div class="buttons-center">
            <a href="login/login.php"><button class="book-now">Book Your Appointment</button></a>
            <a href="#doctors"><button class="meet-dr">Meet Our Doctors</button></a>
        </div>
    </div>
    <div class="fixed-navbar" id="fixed-navbar">
        <nav class="sticky-top bg-light navbar-expand-lg">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 navbar2">
                <li class="nav-item nav-item2">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item nav-item2">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item nav-item2">
                    <a class="nav-link" href="#services">Services</a>
                </li>
                <li class="nav-item nav-item2">
                    <a class="nav-link" href="#doctors">Doctors</a>
                </li>
            </ul>

        </nav>
    </div>

    <div id="about" class="about">
        <div class="mission">
            <h3>Our Mission:</h3>
            <p>To provide accessible, efficient, and reliable healthcare services by connecting patients with qualified
                healthcare professionals through an intuitive and user-friendly online booking platform.</p>
        </div>
        <div class="2div" style="width: 50%;">
            <img class="about-image"
                src="assets/img/[removal.ai]_ab0af4a2-a502-43c2-a9d0-0193807eca11-_445ae47d-301a-4120-adc8-461efa542360.png">

        </div>
        <div class="vision">
            <h3>Our Vision:</h3>
            <p>To revolutionize the way healthcare services are accessed and delivered, making quality healthcare
                available to everyone, anytime, anywhere.</p>
        </div>
    </div>


    <div id="services" class="services">
        <h3>Our Services</h3><br>
        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link service-title" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                            Convenient Appointment Booking
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div class="card-text" style="text-align: right;">Streamline your healthcare experience with our
                            easy-to-use online appointment scheduling system. Say goodbye to long waiting times and
                            enjoy the convenience of managing your healthcare appointments online.

                        </div>

                        <div class="card-image"><img src="assets/img/61e8be99d482c40c4f294b577a7d2e92.jpg"></div>


                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed service-title" data-toggle="collapse"
                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Instant Doctor Availability
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <div class="card-image"><img
                                src="assets/img/doctor-using-smartphone-health-care-260nw-1209713866.png"></div>

                        <div class="card-text">Check real-time availability of our expert medical professionals. Whether
                            it's for routine check-ups or specialized consultations, easily find the right appointment
                            slot for your needs.</div>


                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed service-title" data-toggle="collapse"
                            data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Never Miss an Appointment
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <div class="card-text" style="text-align: right;"> Receive automated reminders and notifications
                            for your upcoming appointments. Stay updated with appointment details, including any changes
                            or rescheduling options, to maintain continuity in your healthcare journey. </div>

                        <div class="card-image"><img src="assets/img/dna.jpg"></div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="counts" class="counts">
        <div class="container">

            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="fas fa-user-md"></i>
                        <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p class="number"><?php echo $doctor_count ?></p>
                        <p class="card-text clinic_name" style="font-size: 1.1rem;">Doctors</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                    <div class="count-box">
                        <i class="far fa-hospital"></i>
                        <span class="number" data-purecounter-start="0" data-purecounter-end="18"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p class="number"><?php echo $department_count ?></p>
                        <p class="card-text clinic_name" style="font-size: 1.1rem;">Departments</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="count-box">
                        <i class="fa-solid fa-user"></i>
                        <span class="number" data-purecounter-start="0" data-purecounter-end="12"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p class="number"><?php echo $user_count ?></p>
                        <p class="card-text clinic_name" style="font-size: 1.1rem;">Patients</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="fas fa-award"></i>
                        <span class="number" data-purecounter-start="0" data-purecounter-end="150"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p class="number"><?php echo $feedback_count ?></p>
                        <p class="card-text clinic_name" style="font-size: 1.1rem;">Awards</p>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <div class="clinics" id="clinica">
        <h3>Clinics</h3><br>
        <div class="container">

            <div class="row">
                <?php
                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card col-md-3 col-sm-1 clinics-card" style="width: 18rem;">';
                        echo '<div>'.$row["icon"].'</div';
                        echo '<div class="card-body">';
                        echo '<p class="card-text clinic_name">' . $row["Department_name"] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </div>
        </div>
    </div>
    <br>
    <div class="clinics" id="clinica">
        <h3>Doctors</h3><br>
        <div class="container">

            <?php $sql = "SELECT doctorID, AVG(rating) AS average_rating FROM feedback WHERE status = 'accepted' GROUP BY doctorID ORDER BY average_rating DESC LIMIT 2";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="row">';
                while ($row = $result->fetch_assoc()) {
                    // Fetching doctor details from another table based on drID
                    $doctorId = $row['drID'];
                    $sql_doctor = "SELECT Fname, Lname FROM users WHERE id = $doctorId";
                    $result_doctor = $con->query($sql_doctor);

                    if ($result_doctor->num_rows > 0) {
                        $doctor_info = $result_doctor->fetch_assoc();

                        echo '
            <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="member d-flex align-items-start">
                    <div class="pic"><img src="assets/img/doctors/doctors-' . $doctorId . '.jpg" class="img-fluid" alt=""></div>
                    <div class="member-info">
                        <h4>' . $doctor_info['Fname'] . ' ' . $doctor_info['Lname'] . '</h4>
                        <span>Anesthesiologist</span> <!-- Assuming specialty is static -->
                        <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                        <div class="social">
                            <a href=""><i class="ri-twitter-fill"></i></a>
                            <a href=""><i class="ri-facebook-fill"></i></a>
                            <a href=""><i class="ri-instagram-fill"></i></a>
                            <a href=""><i class="ri-linkedin-box-fill"></i></a>
                        </div>
                    </div>
                </div>
            </div>';
                    }
                }
                echo '</div>';
            } ?>
        </div>
    </div>


    <div class="doctors" id="doctors">
        <h3>Meet Our Expert Doctors</h3><br>



    </div>
    <div class="" id="">
        <input class="invisible" type="checkbox" id="checkbox-cover">
        <input class="invisible" type="checkbox" id="checkbox-page1">
        <input class="invisible" type="checkbox" id="checkbox-page2">
        <input class="invisible" type="checkbox" id="checkbox-page3">

        <div class="container containerr">
            <div class="cover">

                <img id="cover-img"
                    src="assets/img/[removal.ai]_7e21d6e4-845b-489d-a114-5bb2590cdd61-register-your-life-changing-decision (1).png">
            </div>


            <div class="page" id="page1">
                <div class="front-page">

                    <div class="outer">
                        <div class="content">
                            <div class="form-wrapper">
                                <form action="process_registration.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="name">Full Name:</label>
                                                <input type="text" class="form-control" id="name" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="email">Email Address:</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="donation_type">Type of Donation:</label>
                                            <select class="form-control" id="donation_type" name="donation_type"
                                                required>

                                                <option value="live">Live Organ Donation</option>
                                                <option value="after_death">Organ Donation After Death</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn  btn-register">Register</button>
                                </form>
                                <!--HERE THE END OF THE FORM-->
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="back-cover">

            </div>
            <div class="trapezoid"></div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <!-- About Section -->
                <div class="col-md-4">

                    <p>We are dedicated to providing you with the best possible healthcare experience by connecting you
                        with top-rated doctors and specialists.</p>
                </div>

                <!-- Quick Links Section -->
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="home.php" class="text-white">Home</a></li>
                        <li><a href="#about" class="text-white">About Us</a></li>
                        <li><a href="#services" class="text-white">Services</a></li>
                        <li><a href="#doctors" class="text-white">Doctors</a></li>
                        <li><a href="#" class="text-white">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Contact Section -->
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt"></i> 123 Medical Center Drive, City, State, ZIP</li>
                        <li><i class="fas fa-phone-alt"></i> (123) 456-7890</li>
                        <li><i class="fas fa-envelope"></i> contact@medicalcenter.com</li>
                    </ul>
                    <div class="mt-3">
                        <a href=""><i class="ri-twitter-fill text-white"></i></a>
                        <a href=""><i class="ri-facebook-fill text-white"></i></a>
                        <a href=""><i class="ri-instagram-fill text-white"></i></a>
                        <a href=""><i class="ri-linkedin-box-fill text-white"></i></a>
                    </div>
                </div>

                <hr class="bg-white">
                <div class="text-center">
                    <p class="mb-0">&copy; 2024 Clinic Click. All rights reserved.</p>
                </div>
            </div>





        </div>


        <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script src="homestyle/eye.js" defer></script>
        <script src="homestyle/alert.js" defer></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
</body>

</html>