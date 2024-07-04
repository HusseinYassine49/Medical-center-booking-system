
function updateFeedbackStatus(id, status) {
    $.ajax({
        url: 'update_feedback.php',
        type: 'POST',
        data: { id: id, status: status },
        success: function(response) {
            location.reload();
        },
        error: function(error) {
            console.error("Error updating feedback status: ", error);
        }
    });
}


