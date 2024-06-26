<<<<<<< HEAD
=======

>>>>>>> 5da5aa01e2ca472cb437f460d32d3d5932b80ff1
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Page</title>
    <link rel="stylesheet" href="../css/adminpage.css">
    <link rel="stylesheet" href="../css/adminsummary.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="feedback.css" rel="stylesheet">
<<<<<<< HEAD


</head>

<body>
    <div class="toggle"></div>



    <?php
    require "navbar/navbar.php"; ?>
=======
    <link href="nav.css" rel="stylesheet">
        
</head>

<body>
      <div class="toggle"></div>

    <div class="navigation">
        <ul>
            <div class="logo" style="--bg:#333;">
                <a href="#">
                </a>
            </div>
            <li class="list active" style="--bg:#2262b1;">
                <a href="#">
                    <span class="h-icon"><ion-icon name="home-outline"></ion-icon> </span>
                    <span class="h-title">Home</span>
                </a>
            </li>
            <li class="list" style="--bg:#2262b1;">
                <a href="#">
                    <span class="h-icon"><ion-icon name="person-outline"></ion-icon></span>
                    <span class="h-title">Profile</span>
                </a>
            </li>
            <li class="list" style="--bg:#2262b1;">
                <a href="#">
                    <span class="h-icon"><ion-icon name="chatbubble-outline"></ion-icon></span>
                    <span class="h-title">Message</span>
                </a>
            </li>
            <li class="list" style="--bg:#2262b1;">
                <a href="#">
                    <span class="h-icon"><ion-icon name="search-outline"></ion-icon></span>
                    <span class="h-title">Search</span>
                </a>
            </li>
            <li class="list" style="--bg:#2262b1;">
                <a href="#">
                    <span class="h-icon"><ion-icon name="exit-outline"></ion-icon></span>
                    <span class="h-title">Exit</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="h-navigation">
        <ul>
            <div class="h-logo" style="--bg:#333;">
                <a href="#">
                </a>
            </div>
            <li class="list h-active" style="--bg:#2262b1;">
                <a href="#">
                    <span class="h-icon"><i class="fa-solid fa-house"></i></span>
                    <span class="h-title">Home</span>
                </a>
            </li>
            <li class="list" style="--bg:#2262b1;">
                <a href="#">
                    <span class="h-icon"><i class="fa-solid fa-user-doctor"></i></span>
                    <span class="h-title">Doctor</span>
                </a>
            </li>
            <li class="list" style="--bg:#2262b1;">
                <a href="#">
                    <span class="h-icon"><i class="fa-solid fa-user"></i></span>
                    <span class="h-title">User</span>
                </a>
            </li>
            <li class="list" style="--bg:#2262b1;">
                <a href="#">
                    <span class="h-icon"><i class="fa-solid fa-comment"></i></span>
                    <span class="h-title">Feedback</span>
                </a>
            </li>
            <li class="list" style="--bg:#2262b1;">
                <a href="#">
                    <span class="h-icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                    <span class="h-title">Exit</span>
                </a>
            </li>
        </ul>
    </div>
>>>>>>> 5da5aa01e2ca472cb437f460d32d3d5932b80ff1

    <div class="main-page">
        <h1>Feedback Management</h1>
        <table class="feedback-table" id="feedbackTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Feedback</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
<<<<<<< HEAD

=======
              
>>>>>>> 5da5aa01e2ca472cb437f460d32d3d5932b80ff1
            </tbody>
        </table>
        <button class="button" onclick="showForm('add')">Add Feedback</button>

        <!-- Add/Edit Feedback Form -->
        <div class="form-container" id="feedbackForm">
            <input type="hidden" id="feedbackId">
            <input type="text" id="doctorName" placeholder="Doctor's Name">
            <input type="date" id="feedbackDate" placeholder="Date">
            <textarea id="feedbackText" placeholder="Feedback"></textarea>
            <button class="button" onclick="submitFeedback()">Submit</button>
            <button class="button" onclick="hideForm()">Cancel</button>
        </div>
    </div>

    <script src="../java/include.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../java/chart.js"></script>
    <script src="feedback.js"></script>
<<<<<<< HEAD

</body>

</html>
=======
   
</body>

</html>
>>>>>>> 5da5aa01e2ca472cb437f460d32d3d5932b80ff1
