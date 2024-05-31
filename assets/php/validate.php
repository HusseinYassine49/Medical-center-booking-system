<?php
// Validate Username
function validateUsername($username) {
    if (preg_match('/^[a-zA-Z0-9_-]{3,20}$/', $username)) {
        return true;
    } else {
        return "Username must be 3-20 characters long and can only contain letters, numbers, underscores, and dashes.";
    }
}

// Validate Password
function validatePassword($password) {
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return "Password must include at least one uppercase letter.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        return "Password must include at least one lowercase letter.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        return "Password must include at least one number.";
    }
    if (!preg_match('/[\W]/', $password)) {
        return "Password must include at least one special character.";
    }
    return true;
}



// Validate Email
function validateEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return "Invalid email format.";
    }
}

// Example Usage
$username = "user_name";
$password = "Password1!";
$age = 25;
$email = "example@example.com";

$usernameValidation = validateUsername($username);
$passwordValidation = validatePassword($password);
$emailValidation = validateEmail($email);

if ($usernameValidation === true && $passwordValidation === true && $ageValidation === true && $emailValidation === true) {
    echo "All inputs are valid.";
} else {
    echo $usernameValidation !== true ? $usernameValidation . "<br>" : "";
    echo $passwordValidation !== true ? $passwordValidation . "<br>" : "";
    echo $ageValidation !== true ? $ageValidation . "<br>" : "";
    echo $emailValidation !== true ? $emailValidation . "<br>" : "";
}
?>



<?php
// Start a session
session_start();

// Assuming your database connection is established in connection.php
require "connection.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the JSON data sent from the client
    $json_data = file_get_contents("php://input");

    // Decode the JSON data into an associative array
    $data = json_decode($json_data, true);

    // Extract email and password from the data
    $email = mysqli_real_escape_string($con, $data['email']);
    $password = mysqli_real_escape_string($con, $data['password']);

    // Perform basic validation
    if (empty($email) || empty($password)) {
        echo json_encode(array("error" => "Email and password are required."));
        exit();
    }

    // Query the database to check if the user exists with the given email and password
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $query);

    // Check if a matching user is found
    if (mysqli_num_rows($result) == 1) {
        // User is authenticated
        $user = mysqli_fetch_assoc($result);

        // Store user data in session or perform any other necessary actions
        $_SESSION['user_id'] = $user['id'];

        // Respond with a success message
        echo json_encode(array("success" => "User authenticated successfully."));
    } else {
        // User authentication failed
        echo json_encode(array("error" => "Invalid email or password."));
    }
} else {
    // If the request method is not POST, respond with an error
    echo json_encode(array("error" => "Invalid request method."));
}
?>
