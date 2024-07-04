<?php
require "navbar/navbar.php";

require_once "../include/connection.php";

// Fetch all appointments with delete_ = 0 and status = 0
$appointmentsQuery = "
    SELECT id, doctorID, userID, details, delete_, date_, status, time_, dr_notes
    FROM appointment
    WHERE delete_ = 0 AND status = 0";
$stmt = $con->prepare($appointmentsQuery);
$stmt->execute();
$appointmentsResult = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css'>
    <link rel='stylesheet' href='css/feedback.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Feedback for Completed Appointments</title>
</head>
<style>
    .col {
        margin-left: 10%;
        margin-right: auto;
    }

    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }

    body {
        font-family: 'Helvetica';
    }

    @font-face {
        font-family: 'Helvetica';
        src: url(../fonts/Helvetica.ttf);
        font-style: normal;
        font-weight: 400;
    }

    @font-face {
        font-family: 'HelveticaBold';
        src: url(../fonts/Helvetica-Bold.ttf);
        font-style: normal;
        font-weight: 400;
    }

    .clickStyle h2 {
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 50px;
    }

    .clickStyle svg {
        width: 200px
    }

    .chatBox {
        border-radius: 3px 3px 0px 0px;
        position: relative;
        top: 20%;
        padding: 5px 10px 5px 10px;
        width: 111px;
        height: 40px;
        background-color: #0D122B;
        cursor: pointer;
    }

    .chatBox:hover {
        -webkit-box-shadow: 0 0 35px 2px rgba(0, 0, 0, .24);
        -moz-box-shadow: 0 0 35px 2px rgba(0, 0, 0, .24);
        box-shadow: 0 0 35px 2px rgba(0, 0, 0, .24);
    }

    .chatBox span svg {
        width: 21px;
    }

    .chatBox span {
        display: inline-block;
        position: relative;
        top: 4.8px;
    }

    .chatBox p {
        color: #fff;
        font-size: 13px;
        display: inline-block;
        position: relative;
        top: -2px;
    }

    .MainChatBox {
        width: 320px;
        background-color: #fff;
        -webkit-box-shadow: 0 6px 100px 0 rgba(0, 0, 0, .35) !important;
        -moz-box-shadow: 0 6px 100px 0 rgba(0, 0, 0, .35) !important;
        box-shadow: 0 6px 100px 0 rgba(0, 0, 0, .35) !important;
        position: absolute;
        right: 3%;
        top: 15%;
        border-radius: 3px;
    }

    .chatIco {
        position: relative;
        padding: 15px 12px;
    }

    .closeIcon {
        background: #202020;
        padding: 4.3px;
        height: 27px;
        width: 27px;
        border-radius: 20px;
        text-align: center;
        cursor: pointer;
        position: absolute;
        right: -10px;
        top: -10px;
    }

    .closeIcon svg {
        width: 13px;
    }

    .chatTxt {
        text-align: center;
    }

    .chatTxt p {
        font-size: 17px;
        color: #000;
        margin-bottom: 25px;
        margin-top: 25px;
    }

    .IconsChat {
        text-align: center;
        margin-bottom: 20px;
    }

    .IconsChat a {
        display: inline-block;
        text-decoration: none;
        padding: 0px 9px;
        position: relative;
    }

    .IconsChat a:hover span {
        visibility: visible;
        opacity: 1;
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -ms-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
    }

    .IconsChat a span {
        position: absolute;
        text-align: center;
        left: 0;
        right: 0;
        bottom: -18px;
        font-size: 13px;
        color: gray;
        visibility: hidden;
        opacity: 0;
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -ms-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
    }

    .IconsChat a svg {
        height: 35px;
    }

    .IconsChat a svg path {
        fill: #FFD902;
    }

    .txtAreaBox {
        position: relative;
        display: none;
    }

    .txtAreaBox textarea {
        border: 0 !important;
        background: #eaeaeb !important;
        color: #454A55 !important;
        padding: 12px 20px !important;
        max-width: 320px;
        min-width: 320px;
        margin-left: -12px;
        max-height: 145px;
        min-height: 145px;
        font-family: 'Helvetica';
        position: relative;
        padding-bottom: 37px !important;
        resize: none;
    }

    .txtAreaBox textarea:focus {
        outline: none;
    }

    .selectIcon {
        position: absolute;
        bottom: 52px;
        left: 10px;
    }

    .selectIcon svg {
        width: 13px;
        cursor: pointer;
    }

    .selectIcon svg path {
        fill: #454A55;
    }

    .sndBtn {
        text-align: right;
        margin-top: 10px;
    }

    .sndBtn input {
        text-decoration: none;
        font-size: 13px;
        padding: 7px 10px;
        background: #000;
        color: #fff;
        border-radius: 3px;
        border: none;
        cursor: pointer;
    }

    .sndBtn input:disabled {
        background: #cccccc !important;
        color: #333333 !important;
        cursor: not-allowed;
    }
    .IconsChat a.active svg path {
        fill: #FFD902;
    }

    .IconsChat a:hover svg path {
        fill: #FFD902;
    }

    .IconsChat a::after {
        content: "";
        position: absolute;
        width: 10px;
        height: 10px;
        background: #eaeaeb;
        top: 53px;
        left: 20px;
        display: none;
        transform: rotate(45deg);
    }

    .IconsChat a.active::after {
        display: block;
    }

    a.activesibling svg path {
        fill: #c2c2c2;
    }

    @media(max-width: 1024px) {
        .iconBtn span {
            display: none !important;
        }
    }

    @media(max-width: 991px) {
        .iconBtn span {
            display: none !important;
        }
    }

    @media(max-width: 767px) {
        .iconBtn span {
            display: none !important;
        }
    }

    @media(max-width: 320px) {
        .iconBtn span {
            display: none !important;
        }

        .MainChatBox {
            width: 100%;
            right: 0%;
        }

        .closeIcon {
            right: 5px;
        }
    }
</style>

<body>

    <div class="main-page">

        <div class="sphere top-sphere"></div>
        <div class="sphere mid-sphere-left"></div>

        <div class="col col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Feedback for Appointments</h6>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Appointment ID</th>
                                        <th>Doctor ID</th>
                                        <th>User ID</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Details</th>
                                        <th>Feedback</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $appointmentsResult->fetch_assoc()) : ?>
                                        <tr>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['doctorID'] ?></td>
                                            <td><?= $row['userID'] ?></td>
                                            <td><?= $row['date_'] ?></td>
                                            <td><?= $row['time_'] ?></td>
                                            <td><?= $row['details'] ?></td>
                                            <td>
                                                <input type="text" class="form-control mb-2" id="comment-<?= $row['id'] ?>" placeholder="Enter your comment">
                                                <div class="feedback mt-2">
                                                    <div class="chatBox">
                                                        <span><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="laugh" class="svg-inline--fa fa-laugh fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                                                <path fill="#fff" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm80 152c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32zm-160 0c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32zm88 272h-16c-73.4 0-134-55-142.9-126-1.2-9.5 6.3-18 15.9-18h270c9.6 0 17.1 8.4 15.9 18-8.9 71-69.5 126-142.9 126z">
                                                                </path>
                                                            </svg></span>
                                                        <p>CLICK ME</p>
                                                    </div>
                                                    <div class="MainChatBox" style="display: none;">
                                                        <div class="chatIco">
                                                            <div class="closeIcon">
                                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                                                                    <path fill="#fff" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="chatTxt">
                                                                <p>How would you rate your<br>experience?</p>
                                                            </div>
                                                            <div class="IconsChat">
                                                                <a href="#." class="emoji iconBtn" id="Icon1" value="1">
                                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angry" class="svg-inline--fa fa-angry fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                                                        <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zM136 240c0-9.3 4.1-17.5 10.5-23.4l-31-9.3c-8.5-2.5-13.3-11.5-10.7-19.9 2.5-8.5 11.4-13.2 19.9-10.7l80 24c8.5 2.5 13.3 11.5 10.7 19.9-2.1 6.9-8.4 11.4-15.3 11.4-.5 0-1.1-.2-1.7-.2.7 2.7 1.7 5.3 1.7 8.2 0 17.7-14.3 32-32 32S136 257.7 136 240zm168 154.2c-27.8-33.4-84.2-33.4-112.1 0-13.5 16.3-38.2-4.2-24.6-20.5 20-24 49.4-37.8 80.6-37.8s60.6 13.8 80.6 37.8c13.8 16.5-11.1 36.6-24.5 20.5zm76.6-186.9l-31 9.3c6.3 5.8 10.5 14.1 10.5 23.4 0 17.7-14.3 32-32 32s-32-14.3-32-32c0-2.9.9-5.6 1.7-8.2-.6.1-1.1.2-1.7.2-6.9 0-13.2-4.5-15.3-11.4-2.5-8.5 2.3-17.4 10.7-19.9l80-24c8.4-2.5 17.4 2.3 19.9 10.7 2.5 8.5-2.3 17.4-10.8 19.9z">
                                                                        </path>
                                                                    </svg>
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                </a>
                                                                <a href="#." class="emoji iconBtn" id="Icon2" value="2">

                                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="frown" class="svg-inline--fa fa-frown fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                                                        <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm80 168c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32zm-160 0c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32zm170.2 218.2C315.8 367.4 282.9 352 248 352s-67.8 15.4-90.2 42.2c-13.5 16.3-38.1-4.2-24.6-20.5C161.7 339.6 203.6 320 248 320s86.3 19.6 114.7 53.8c13.6 16.2-11 36.7-24.5 20.4z">
                                                                        </path>
                                                                    </svg>
                                                                    <span>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="#." class="emoji iconBtn" id="Icon3" value="3">
                                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="meh" class="svg-inline--fa fa-meh fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                                                        <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm-80 168c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32zm176 192H152c-21.2 0-21.2-32 0-32h192c21.2 0 21.2 32 0 32zm-16-128c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z">
                                                                        </path>
                                                                    </svg>
                                                                    <span>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="#." class="emoji iconBtn" id="Icon4" value="4">
                                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="laugh" class="svg-inline--fa fa-laugh fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                                                        <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm80 152c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32zm-160 0c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32zm88 272h-16c-73.4 0-134-55-142.9-126-1.2-9.5 6.3-18 15.9-18h270c9.6 0 17.1 8.4 15.9 18-8.9 71-69.5 126-142.9 126z">
                                                                        </path>
                                                                    </svg>
                                                                    <span>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    </span>
                                                                </a>
                                                                <a href="#." class="emoji iconBtn" id="Icon5" value="5">
                                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="grin-hearts" class="svg-inline--fa fa-grin-hearts fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                                                        <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zM90.4 183.6c6.7-17.6 26.7-26.7 44.9-21.9l7.1 1.9 2-7.1c5-18.1 22.8-30.9 41.5-27.9 21.4 3.4 34.4 24.2 28.8 44.5L195.3 243c-1.2 4.5-5.9 7.2-10.5 6l-70.2-18.2c-20.4-5.4-31.9-27-24.2-47.2zM248 432c-60.6 0-134.5-38.3-143.8-93.3-2-11.8 9.2-21.5 20.7-17.9C155.1 330.5 200 336 248 336s92.9-5.5 123.1-15.2c11.4-3.6 22.6 6.1 20.7 17.9-9.3 55-83.2 93.3-143.8 93.3zm133.4-201.3l-70.2 18.2c-4.5 1.2-9.2-1.5-10.5-6L281.3 173c-5.6-20.3 7.4-41.1 28.8-44.5 18.6-3 36.4 9.8 41.5 27.9l2 7.1 7.1-1.9c18.2-4.7 38.2 4.3 44.9 21.9 7.7 20.3-3.8 41.9-24.2 47.2z">
                                                                        </path>
                                                                    </svg>
                                                                    <span>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    </span>
                                                                </a>
                                                            </div>


                                                            <!-- Massage Box -->

                                                            <div class="txtAreaBox" id="txtAreaBox">
                                                                <form>
                                                                    <textarea name="massageBox" autofocus placeholder="Tell us about your experience..." name="fname" id="fname" required></textarea>
                                                                    <div class="selectIcon" data-tip="Sed ut perspiciatis unde omnis iste natus error sit voluptatem">
                                                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="mouse-pointer" class="svg-inline--fa fa-mouse-pointer fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                                                            <path fill="currentColor" d="M302.189 329.126H196.105l55.831 135.993c3.889 9.428-.555 19.999-9.444 23.999l-49.165 21.427c-9.165 4-19.443-.571-23.332-9.714l-53.053-129.136-86.664 89.138C18.729 472.71 0 463.554 0 447.977V18.299C0 1.899 19.921-6.096 30.277 5.443l284.412 292.542c11.472 11.179 3.007 31.141-12.5 31.141z"></path>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="sndBtn">
                                                                        <input type="submit" value="Send" id="register" class="link-button-blue" disabled="disabled">
                                                                    </div>
                                                                </form>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary mt-2" onclick="submitFeedback(<?= $row['id'] ?>)">Submit Feedback</button>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function submitFeedback(appointmentId) {
            var comment = document.getElementById('comment-' + appointmentId).value;
            var rating = document.querySelector('input[name="rating-' + appointmentId + '"]:checked').value;

            // AJAX request to submit feedback
            $.ajax({
                url: 'submit_feedback.php',
                type: 'POST',
                data: {
                    appointmentId: appointmentId,
                    comment: comment,
                    rating: rating
                },
                success: function(response) {
                    alert('Feedback submitted successfully!');
                }
            });
        }

        // chat box open
        $(".chatBox").click(function() {
            $('.MainChatBox').show();
            $('.chatBox').hide('500'); // chat btn
        });

        // Emjoi Textarea
        $(".iconBtn").click(function() {
            $('#txtAreaBox').show();
            $('textarea').focus();
            $('.chatTxt').hide('500');
            $(this).addClass("active").siblings().removeClass('active').siblings().addClass('activesibling');
        });


        $(".closeIcon").click(function() {
            $('.MainChatBox').hide(); // Emoji Box
            $('.chatBox').show('500'); // chat btn
            $('#txtAreaBox').hide();
            $('.chatTxt').show('500');
            $('a.emoji').removeClass('activesibling').removeClass('active'); // on Emoji remove class
        });

        $(document).ready(function() {
            $('input[type="submit"]').attr('disabled', true);

            $('textarea').on('keyup', function() {
                if ($(this).val() != '') {
                    $('input[type="submit"]').attr('disabled', false);
                } else {
                    $('input[type="submit"]').attr('disabled', true);
                }
            });
        });
    </script>

</body>

</html>