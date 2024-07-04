$(document).ready(function() { 
  $.ajax({
      url: 'get_feedback.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
          if (data.length === 0) {
              var noFeedbackCardHtml = `
                  <div class="feedback-card">
                      <p>No feedback yet</p>
                  </div>
              `;
              $('#feedback-container').append(noFeedbackCardHtml);
          } else {
              data.forEach(function(feedback) {
                  var starsHtml = '';
                  for (var i = 0; i < feedback.rating; i++) {
                      starsHtml += '<i class="fas fa-star"></i>';
                  }
                  var feedbackCardHtml = `
                      <div class="feedback-card">
                          <div class="d-flex align-items-center mb-2">
                              <div class="star-rating">
                                  <h5>${feedback.Fname} ${feedback.Lname}</h5>
                                  ${starsHtml}
                              </div>
                          </div>
                          <p>${feedback.comment}</p>
                      </div>
                  `;
                  $('#feedback-container').append(feedbackCardHtml);
              });
          }
      },
      error: function(xhr, status, error) {
          console.error('Error fetching feedback:', error);
      }
  });
});
