$(document).ready(function() {
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#filter tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
   
    function fetchPatientHistory(patientId) {
        $.ajax({
            url: 'fetch_patient_history.php',
            type: 'GET',
            data: { id: patientId },
            dataType: 'json',
            success: function(response) {
                if (response) {
                    $('#patient-name').text(response.name);
                    $('#patient-gender').text(response.gender);
                    $('#patient-birthday').text(response.birthday);
                    $('#patient-blood-group').text(response.blood_group);
                    $('#last-appointment-date').text(response.last_appointment_date);
                    $('#past-appointments').text(response.past_appointments);
                    $('#upcoming-appointments').text(response.upcoming_appointments);
                    
                    var historyHtml = '';
                    if (response.appointment_history.length > 0) {
                        response.appointment_history.forEach(function(appointment) {
                            historyHtml += '<tr>';
                            historyHtml += '<td>' + appointment.date_ + '</td>';
                            historyHtml += '<td>' + appointment.time + '</td>';
                            historyHtml += '<td>' + appointment.dr_notes + '</td>';
                            historyHtml += '</tr>';
                        });
                    } else {
                        historyHtml += '<tr>';
                        historyHtml += '<td colspan="3">No previous appointments found.</td>';
                        historyHtml += '</tr>';
                    }
                    $('#appointment-history').html(historyHtml);
                    $('#patient-history-container').css('display', 'block');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching patient history:', error);
            }
        });
    }
    
    var urlParams = new URLSearchParams(window.location.search);
    var patientId = urlParams.get('id');
    
    if (patientId) {
        $('.table-content').css('display', 'none');
        $('#patient-history-container').addClass('full-width').css('display', 'block').css('margin-left', '0%');
        fetchPatientHistory(patientId);
    } else {
        $('.table-content').css('display', 'block');
        $('.tbl tbody').empty(); 

       
        $.ajax({
            url: 'fetch_all_patients.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response && response.length > 0) {
                    response.forEach(function(patient) {
                        var row = '<tr>';
                        row += '<td>' + patient.Fname + '</td>';
                        row += '<td>' + patient.Email + '</td>';
                        row += '<td>' + patient.DOB + '</td>';
                        row += '<td><button class="btn-check-history btn-edit" data-id="' + patient.id + '"><i class="fas fa-clipboard"></i></button></td>';
                        row += '</tr>';
                        $('.tbl tbody').append(row);
                    });
                } else {
                    var row = '<tr><td colspan="4">No patients found.</td></tr>';
                    $('.tbl tbody').append(row);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching patients:', error);
            }
        });
    }

    
    $(document).on('click', '.btn-check-history', function() {
        var id = $(this).data('id');
        $('.table-content').css('display', 'none');
        $('#patient-history-container').addClass('full-width').css('display', 'block').css('margin-left', '0%');
    
        // Check if the button already exists
        if ($('#return-to-table-btn').length === 0) {
            // Append close button functionality
            $('#patient-history-container').append('<button id="return-to-table-btn">Back to see all Patients</button>');
        }
    
        fetchPatientHistory(id);
    });
    
    // Functionality for closing the patient history container
    $(document).on('click', '#return-to-table-btn', function() {
        $('#patient-history-container').removeClass('full-width').css('display', 'none').css('margin-left', '0%');
        $('.table-content').css('display', 'block');
    });
    
});
