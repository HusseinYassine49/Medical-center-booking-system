<?php
session_start();

require "../include/connection.php";

$user_id = $_SESSION['user_id'];

// Check if the user has already submitted an application
$query = "SELECT * FROM doctors WHERE UserID = ? LIMIT 1";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$has_submitted = false;
$verified = 'notVerified';

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $has_submitted = true;
    $verified = $row['verified'];
}

mysqli_stmt_close($stmt);

$sql = "SELECT Id, Department_name FROM department";
$result = $con->query($sql);

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Doctor Verification</title>
    <link href="css/apply.css" rel="stylesheet">
</head>

<body>
   
    <div class="container">
        <h1>You Just Registered On Our Website.</h1>

        <?php if ($has_submitted && $verified == 'notVerified'): ?>
            <div class="notification">
                <p>You have already submitted your application. Please wait for verification.</p>
                <button class="button" onclick="window.location.href='../index.html'">Continue</button>
                <lable class="backhome-label">Continue To Home Page</lable>
            </div>
            
        <?php elseif (!$has_submitted): ?>
            <h2>Please fill the form below to be verified as a Doctor. You will be contacted in a couple of days.</h2>
            <form action="process_apply.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <label for="file-upload" class="custom-file-upload">
                        Enter Your CV to Apply To Become One Of Our Doctors
                    </label>
                    <span class="file-name">No file chosen</span>
                    <input id="file-upload" type="file" name="cv" required />

                    <label for="department-select">Choose Your Preferred Major To Join Our Department Of Doctors</label>
                    <div class="custom-select">
                        <select id="department-select" name="department">
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["Id"] . '">' . $row["Department_name"] . '</option>';
                                }
                            } else {
                                echo '<option value="">No departments available</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <label>Description</label>
                    <textarea name="description" placeholder="Some text..."></textarea>

                    <input type="submit" name="insert" />
                </div>
            </form>
        <?php endif; ?>
    </div>


    <script src="js/apply.js"></script>
</body>

</html>
