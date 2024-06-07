<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback Information</title>
  <link rel="stylesheet" href="css/adminfeedback.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
  <?php include 'navbar/navbar.php'; ?>

  <div class="middle-part">
    <button class="feedbackinfo-btn" onclick="viewFeedback()"><i class="fa-solid fa-chevron-left"></i></button>
    <h1 class="feedback-page-header">Feedback Information</h1>
    <button class="feedbackinfo-btn hidden" onclick=""><i class="fa-solid fa-chevron-left"></i></button>
  </div>

  <div class="accepted-feedback-container">
    <h2>Accepted Feedback</h2>

    <table id="accepted-feedback-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Feedback</th>
          <th>Patient</th>
        </tr>
      </thead>
      <tbody id="accepted-feedback-list">
        <!-- Accepted feedback items will be dynamically added here -->
      </tbody>
    </table>
  </div>


  <div class="declined-feedback-container">
    <h2>Declined Feedback</h2>
    <table id="declined-feedback-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Feedback</th>
          <th>Patient</th>
        </tr>
      </thead>
      <tbody id="declined-feedback-list">
        <!-- Declined feedback items will be dynamically added here -->
      </tbody>
    </table>
  </div>


  </div>

  <script>
    // Function to parse query parameters from URL
    function getQueryParams() {
      const queryString = window.location.search;
      const urlParams = new URLSearchParams(queryString);
      const acceptedFeedbackData = JSON.parse(decodeURIComponent(urlParams.get('accepted')));
      const declinedFeedbackData = JSON.parse(decodeURIComponent(urlParams.get('declined')));
      return {
        acceptedFeedbackData,
        declinedFeedbackData
      };
    }

    // Function to render accepted feedback items
    function renderAcceptedFeedbackItems(acceptedFeedbackData) {
      const acceptedFeedbackList = document.getElementById("accepted-feedback-list");
      acceptedFeedbackData.forEach(feedback => {
        const row = document.createElement("tr");
        row.innerHTML = `
                    <td>${feedback.id}</td>
                    <td>${feedback.text}</td>
                    <td>${feedback.patient}</td>
                `;
        acceptedFeedbackList.appendChild(row);
      });
    }

    // Function to render declined feedback items
    function renderDeclinedFeedbackItems(declinedFeedbackData) {
      const declinedFeedbackList = document.getElementById("declined-feedback-list");
      declinedFeedbackData.forEach(feedback => {
        const row = document.createElement("tr");
        row.innerHTML = `
                    <td>${feedback.id}</td>
                    <td>${feedback.text}</td>
                    <td>${feedback.patient}</td>
                `;
        declinedFeedbackList.appendChild(row);
      });
    }

    // Function to retrieve accepted and declined feedback data from session storage
    function getFeedbackDataFromStorage() {
      const acceptedFeedbackData = JSON.parse(sessionStorage.getItem('acceptedFeedback')) || [];
      const declinedFeedbackData = JSON.parse(sessionStorage.getItem('declinedFeedback')) || [];
      return {
        acceptedFeedbackData,
        declinedFeedbackData
      };
    }

    // Main function to render feedback data
    function renderFeedbackData() {
      const {
        acceptedFeedbackData,
        declinedFeedbackData
      } = getFeedbackDataFromStorage();
      renderAcceptedFeedbackItems(acceptedFeedbackData);
      renderDeclinedFeedbackItems(declinedFeedbackData);
    }

    // Initial rendering
    renderFeedbackData();

    function viewFeedback() {
      window.location.href = "adminfeedback.html";
    }
  </script>
</body>

</html>