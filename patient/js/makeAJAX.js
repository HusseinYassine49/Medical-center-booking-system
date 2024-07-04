document.getElementById('form_create_appointment').addEventListener('submit', function(event) {
    // Prevent default form submission
    event.preventDefault();

    // Gather form data
    var userID = document.getElementById('userID').value;
    var date = document.getElementById('selected_date_display').value;
    var description = document.getElementById('description').value;
    var clinic = document.getElementById('clinic').value;
    var doctor = document.getElementById('doctor').value;
    var startTime = document.getElementById('selected_time_display').value;

    var formData = new FormData();
    formData.append('userID', userID);
    formData.append('date_', date);
    formData.append('description', description);
    formData.append('clinic', clinic);
    formData.append('doctor', doctor);
    formData.append('start_time', startTime);

    Swal.fire({
        icon: 'info',
        title: 'Are you sure?',
        text: 'Confirm appointment creation.',
        showCancelButton: true,
        confirmButtonText: 'Yes, create appointment',
        cancelButtonText: 'Cancel'
    }).then(function(result) {
        if (result.isConfirmed) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'save_appointment.php', true);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            allowOutsideClick: false,
                            confirmButtonText: 'OK'
                        }).then(function() {
                            location.reload();
                        });
                    } else if (response.status === 'suggest') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Time Slot Unavailable',
                            text: response.message,
                            showCancelButton: true,
                            confirmButtonText: 'Yes, use suggested time',
                            cancelButtonText: 'Cancel'
                        }).then(function(result) {
                            if (result.isConfirmed) {
                                formData.set('start_time', response.suggested_time);
                                // Resend the form data with the suggested time
                                xhr.open('POST', 'save_appointment.php', true);
                                xhr.onload = function() {
                                    if (xhr.status >= 200 && xhr.status < 400) {
                                        var newResponse = JSON.parse(xhr.responseText);
                                        if (newResponse.status === 'success') {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success!',
                                                text: newResponse.message,
                                                allowOutsideClick: false,
                                                confirmButtonText: 'OK'
                                            }).then(function() {
                                                location.reload();
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error!',
                                                text: newResponse.message
                                            });
                                        }
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: 'HTTP error occurred: ' + xhr.status
                                        });
                                    }
                                };
                                xhr.onerror = function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'Connection error. Please try again later.'
                                    });
                                };
                                xhr.send(formData);
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'HTTP error occurred: ' + xhr.status
                    });
                }
            };
            xhr.onerror = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Connection error. Please try again later.'
                });
            };
            xhr.send(formData);
        }
    });
});







$(document).ready(function() {
    var time;
    var day;
    var month;
    var year;
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var center;

    function todayEqualActive() {
        setTimeout(function() {
            if ($(".ui-datepicker-current-day").hasClass("ui-datepicker-today")) {
                $(".ui-datepicker-today").children(".ui-state-default").css("border-bottom", "0");
            } else {
                $(".ui-datepicker-today").children(".ui-state-default").css("border-bottom", "2px solid rgba(53,60,66,0.5)");
            }
        }, 20);
    }

    todayEqualActive();

    $('#calendar').datepicker({
        inline: true,
        firstDay: 1,
        showOtherMonths: true,
        onChangeMonthYear: function() {
            todayEqualActive();
        },
        onSelect: function(dateText, inst) {
            var date = $(this).datepicker('getDate'),
                day = date.getDate(),
                month = date.getMonth() + 1,
                year = date.getFullYear();

            var monthName = months[month - 1];
            $(".request .day").text(monthName + " " + day);
            $("#selected_date_display").val(dateText);  // Display selected date in the form

            todayEqualActive();

            $(".request").removeClass("disabled");

            var index;
            setTimeout(function() {
                $(".ui-datepicker-calendar tbody tr").each(function() {
                    if ($(this).find(".ui-datepicker-current-day").length) {
                        index = $(this).index() + 1;
                    }
                });

                $("<tr class='timepicker-cf'></tr>").insertAfter($(".ui-datepicker-calendar tr").eq(index));

                var top = $(".timepicker-cf").offset().top - 2;
                if ($(".timepicker").css('height') == '60px') {
                    $(".timepicker-cf").animate({'height': '0px'}, {duration: 200, queue: false});
                    $(".timepicker").animate({'top': top}, 200);
                    $(".timepicker-cf").animate({'height': '60px'}, 200);
                } else {
                    $(".timepicker").css('top', top);
                    $(".timepicker, .timepicker-cf").animate({'height': '60px'}, 200);
                }
            }, 0);

            time = $(".owl-stage .center").text();
            $(".request .time").text(time);
            $("#selected_time_display").val(time);  // Display selected time in the form

            $(".owl-item").removeClass("center-n");
            center = $(".owl-stage").find(".center");
            center.prev("div").addClass("center-n");
            center.next("div").addClass("center-n");
        }
    });

    $(".form-name input").each(function() {
        $(this).keyup(function() {
            if (this.value) {
                $(this).siblings("label").css({
                    'font-size': '0.8em',
                    'left': '.15rem',
                    'top': '0%'
                });
            } else {
                $(this).siblings("label").removeAttr("style");
            }
        });
    });

    $(".timepicker").on('click', '.owl-next', function() {
        time = $(".owl-stage .center").text();
        $(".request .time").text(time);
        $("#selected_time_display").val(time);  // Display selected time in the form

        $(".owl-item").removeClass("center-n");
        center = $(".owl-stage").find(".center");
        center.prev("div").addClass("center-n");
        center.next("div").addClass("center-n");
    });

    $(".timepicker").on('click', '.owl-prev', function() {
        time = $(".owl-stage .center").text();
        $(".request .time").text(time);
        $("#selected_time_display").val(time);  // Display selected time in the form

        $(".owl-item").removeClass("center-n");
        center = $(".owl-stage").find(".center");
        center.prev("div").addClass("center-n");
        center.next("div").addClass("center-n");
    });

    $('.owl').owlCarousel({
        center: true,
        loop: true,
        items: 5,
        dots: false,
        nav: true,
        navText: " ",
        mouseDrag: false,
        touchDrag: true,
        responsive: {
            0: {
                items: 3
            },
            700: {
                items: 5
            },
            1200: {
                items: 7
            }
        }
    });

    $(document).on('click', '.ui-datepicker-next', function(e) {
        $(".timepicker-cf").hide(0);
        $(".timepicker").css({'height': '0'});
        e.preventDefault();
        $(".ui-datepicker").animate({"-webkit-transform": "translate(100%,0)"}, 200);
    });

    $(document).on('click', '.ui-datepicker-prev', function() {
        $(".timepicker-cf").hide(0);
        $(".timepicker").css({'height': '0'});
        $(".ui-datepicker").animate({'transform': 'translateX(-100%)'}, 200);
    });

    $(window).on('resize', function() {
        $(".timepicker").css('top', $(".timepicker-cf").offset().top - 2);
    });
});


const userID = '<?php echo $userID; ?>';

function updateDoctors() {
    var departmentId = $('#clinic').val();

    $.ajax({
        type: 'POST',
        url: 'get_doctors.php',
        data: {
            department_id: departmentId
        },
        dataType: 'json',
        success: function (response) {
            var doctorSelect = $('#doctor');
            doctorSelect.empty();
            doctorSelect.append('<option value="" disabled selected>Select Doctor</option>');

            response.forEach(function (doctor) {
                doctorSelect.append('<option value="' + doctor.DoctorID + '">' + doctor.Fname + ' ' + doctor.Lname + '</option>');
            });
        }
    });
}

function fetchDoctorAvailability() {
    var doctorId = $('#doctor').val();
    var selectedDate = $('#date').val();

    $.ajax({
        type: 'POST',
        url: 'get_doctor_availability.php',
        data: {
            doctor_id: doctorId,
            selected_date: selectedDate
        },
        dataType: 'json',
        success: function (response) {
            if (response.length === 0) {
                alert('Doctor Not Available');
                clearCalendar(); 
            } else {
                updateCalendar(response); 
            }
        },
        error: function (xhr, status, error) {
            console.error('Error fetching availability:', error);
        }
    });
}

function clear_input() {
    $('#form_create_appointment')[0].reset();
}

// Example using Animate.css library
$(window).scroll(function() {
    $('.animated').each(function(){
        var pos = $(this).offset().top;

        var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
            $(this).addClass("fadeIn"); // Replace with desired animation class
        }
    });
});

function openModal() {
    $('#myModal').fadeIn();
}
function closeModal() {
    $('#myModal').fadeOut();
}

$('.carousel').owlCarousel({
    animateOut: 'fadeOut', // Example animation
    animateIn: 'fadeIn', // Example animation
    items: 1,
    loop: true,
    autoplay: true
});