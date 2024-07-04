<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi Item Carousel Cards</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/carousel/">
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- 
    <link rel="stylesheet" href="../css/navbar.css"> -->
    <!-- <link rel="stylesheet" href="../css/doctorDashboard.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<style>
.row {
    margin-left: 5%;
    margin-right: 10%;
}

@media screen and (min-width: 567px) {
    .carousel-inner {
        display: flex;
    }

    .carousel-item {
        display: block;
        margin-right: 0;
        flex: 0 0 calc(100% / 3);
    }
}

ol,
ul {
    padding-left: 0;
}

.carousel-inner {
    padding: 1em;
    margin-left: 30px;
}

.card {
    margin: 0 .5em;
    border-radius: 0;
    box-shadow: 2px 6px 8px 0;
}

.carousel-control-prev,
.carousel-control-next {
    width: 6vh;
    height: 6vh;
    background-color: #e1e1e1;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    opacity: .5;
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
    opacity: 1;
}

.subcategories {
    visibility: hidden;
    padding: 20px 0;
    border-top: 1px solid #ccc;
}

.subcategories.show {
    visibility: visible;
}

.icon {
    margin: 0 auto;
    width: 64px;
    height: 64px;
    background: #1977cc;
    border-radius: 5px;
    transition: all 0.3s ease-out 0s;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
    transform-style: preserve-3d;
    position: relative;
    z-index: 2;
}

.icon i {
    color: #fff;
    font-size: 28px;
    transition: ease-in-out 0.3s;
}

.icon::before {
    position: absolute;
    content: "";
    left: -8px;
    top: -8px;
    height: 100%;
    width: 100%;
    background: rgba(25, 119, 204, 0.2);
    border-radius: 5px;
    transition: all 0.3s ease-out 0s;
    transform: translateZ(-1px);
    z-index: -1;
}
</style>

<body>

<?php include 'navbar/navbar.php'; ?>

<div class="main-page">



    <div class="row col1">
        <div class="row col1">
            <div id="carouselExampleControls" class="carousel " data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $query = 'SELECT `Id`, `Department_name`, `Description` FROM `department` WHERE 1';
                    $result = mysqli_query($con, $query);

                    // Fetch all results into an array
                    $departments = array();
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $departments[] = $row;
                        }
                    }

                    $counter = 0; // Initialize a counter to mark the first item as active
                    foreach ($departments as $row) {
                        echo '<div class="carousel-item' . ($counter == 0 ? ' active' : '') . '">
                        <div class="card" id="clinic' . $row['Id'] . '">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <div class="icon"><i class="fas fa-heartbeat"></i></div><br>' . $row['Department_name'] . '
                                </h5>
                                <p class="card-text">' . $row['Description'] . '.</p>
                            </div>
                        </div>
                    </div>';
                        $counter++; // Increment the counter
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="container">
                <div class="categories">
                    <?php
                    foreach ($departments as $row) {
                        echo '<div class="subcategories" id="cat' . $row['Id'] . '">
                    <div class="subcategory">
                      <div class="row">';

                        // Query to fetch doctors for the current department
                        $queryd = 'SELECT `DoctorID`, `UserID`, `verified`, `DepartmentID`, `CV`, `Description` FROM `doctors` WHERE `DepartmentID`=' . $row['Id'];
                        $resultd = mysqli_query($con, $queryd);

                        if ($resultd) {
                            while ($rowd = mysqli_fetch_assoc($resultd)) {
                                // Query to fetch user details for the current doctor
                                $queryf = 'SELECT `Fname`, `Lname` FROM `users` WHERE `id`=' . $rowd['UserID'];
                                $resultf = mysqli_query($con, $queryf);

                                if ($resultf) {
                                    $rowf = mysqli_fetch_assoc($resultf); // Fetch user details
                                    echo ' <div class="col-lg-6 mt-4 mt-lg-0">
                                <div class="member d-flex align-items-start">
                                    <div class="pic"><img src="../assets/img/doctors/doctors-2.jpg" class="img-fluid" alt=""></div>
                                    <div class="member-info">
                                        <h4>' . $rowf['Fname'] . ' ' . $rowf['Lname'] . '</h4>
                                        <span>' . $rowd['Description'] . '</span>
                                        <p></p>
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
                        }

                        echo '      </div>
                    </div>
                </div>';
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>


    </div>



    <!-- Icon SCRIPT-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!--SCRIPT FOR PIE CHART-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- JavaScript dependencies -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

    <script src="navbar/include.js"></script>




    <script>
    $(document).ready(function() {
        const multipleItemcarousel = document.querySelector('#carouselExampleControls');

        if (window.matchMedia("(min-width:576px)").matches) {
            const carousel = new bootstrap.Carousel(multipleItemcarousel, {
                interval: false
            });

            var carouselWidth = $('.carousel-inner').prop('scrollWidth');
            var cardWidth = $('.carousel-item').width();
            var scrollPosition = 0;

            $('.carousel-control-next').on('click', function() {
                if (scrollPosition < (carouselWidth - (cardWidth * 4))) {
                    console.log('next');
                    scrollPosition = scrollPosition + cardWidth;
                    $('.carousel-inner').animate({
                        scrollLeft: scrollPosition
                    }, 600);
                }
            });

            $('.carousel-control-prev').on('click', function() {
                if (scrollPosition > 0) {
                    console.log('prev');
                    scrollPosition = scrollPosition - cardWidth;
                    $('.carousel-inner').animate({
                        scrollLeft: scrollPosition
                    }, 600);
                }
            });
        } else {
            $(multipleItemcarousel).addClass('slide');
        }

        $('#clinic1').on('click', function() {
            showSubcategories('cat1');
        });
        $('#clinic2').on('click', function() {
            showSubcategories('cat2');
        });
        $('#clinic3').on('click', function() {
            showSubcategories('cat3');
        });
        $('#clinic4').on('click', function() {
            showSubcategories('cat4');
        });
        $('#clinic5').on('click', function() {
            showSubcategories('cat5');
        });


    });

    function showSubcategories(categoryId) {
        var subcategories = document.querySelectorAll('.subcategories');
        subcategories.forEach(function(subcategory) {
            subcategory.classList.remove('show');
        });

        var selectedSubcategories = document.getElementById(categoryId);
        if (selectedSubcategories) {
            selectedSubcategories.classList.add('show');
        }
    }
    </script>
</body>

</html>