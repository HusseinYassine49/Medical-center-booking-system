<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Appointments Display</title>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    table, th, td {
        border: 1px solid #ccc;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    form {
        margin-bottom: 20px;
    }
    form input[type=text] {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }
    form button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    form button:hover {
        background-color: #45a049;
    }
    .emoji-rating input[type="radio"] {
        display: none;
    }
    .emoji-rating label {
        display: inline-block;
        font-size: 24px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    .emoji-rating label:hover {
        transform: scale(1.2);
    }
    .emoji-rating input[type="radio"]:checked + label {
        transform: scale(1.2);
    }
</style>
</head>
<body>

<?php include 'navbar/navbar.php'; ?>

<div class="main-page">

    <h2>Appointments</h2>

    <?php
    // Include your database connection file
    require_once "../include/connection.php";

    // Function to generate static rating emojis
    function generateStaticRatingEmojis() {
        $emojis = ['😡', '😞', '😐', '😊', '😍'];

        $options = '';
        foreach ($emojis as $index => $emoji) {
            $options .= "<input type='radio' id='rating_$index' name='rating' value='$index'>
                         <label for='rating_$index'>$emoji</label>";
        }

        return $options;
    }

    // Handle form submission if ratings are posted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $appointmentId = $_POST['appointment_id'];
        $rating = $_POST['rating'];
        $additionalInfo = $_POST['additional_info'];

        // Fetch appointment details from the main appointment table
        $stmt = $con->prepare("SELECT userID, doctorID, date_, time_, details FROM appointment WHERE id = ?");
        $stmt->bind_param("i", $appointmentId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            // Assign fetched values to variables
            $userID = $row['userID'];
            $doctorID = $row['doctorID'];
            $date_ = $row['date_'];
            $time_ = $row['time_'];
            $details = $row['details'];

            // Insert feedback into the appointment_feedback table
            $feedbackQuery = "INSERT INTO appointment_feedback (User_ID, Doctor_ID, rating, comment, status)
                              VALUES (?, ?, ?, ?, 0)";
            $stmt = $con->prepare($feedbackQuery);
            $stmt->bind_param("iiis", $userID, $doctorID, $rating, $additionalInfo);

            if ($stmt->execute()) {
                echo "<p>Feedback submitted successfully!</p>";
            } else {
                echo "<p>Failed to submit feedback.</p>";
            }
            $stmt->close();
        } else {
            echo "<p>Appointment not found.</p>";
        }
    }

    // SQL query to fetch data from appointment table
    $sql = "SELECT id, doctorID, userID, details, date_, time_, status, dr_notes FROM appointment WHERE delete_ = 0"; // Assuming 'delete_' flag is used to mark deleted records

    $result = $con->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<form method='post' action='".$_SERVER["PHP_SELF"]."'>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Doctor ID</th>
                        <th>User ID</th>
                        <th>Details</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Doctor Notes</th>
                        <th>Rating</th>
                        <th>Additional Info</th>
                        <th>Action</th>
                    </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["doctorID"]."</td>
                    <td>".$row["userID"]."</td>
                    <td>".$row["details"]."</td>
                    <td>".$row["date_"]."</td>
                    <td>".$row["time_"]."</td>
                    <td>".$row["dr_notes"]."</td>
                    <td class='emoji-rating'>";
            
            // Generate static emoji ratings
            echo generateStaticRatingEmojis();
            
            // Hidden input for appointment ID
            echo "<input type='hidden' name='appointment_id' value='".$row["id"]."'>";
            
            echo "</td>
                    <td><input type='text' name='additional_info'></td>
                    <td><button type='submit' name='submit'>Submit</button></td>
                </tr>";
        }
        echo "</table>
            </form>";
    } else {
        echo "0 results";
    }

    $con->close();
    ?>

</div>

</body>
</html>