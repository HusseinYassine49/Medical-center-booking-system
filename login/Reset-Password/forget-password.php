<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="../css/ForgetPassword.css">
</head>
<body>

<div class="container">
    <h1>Password Reset</h1>
    
    <form class="password-reset-form" action="send-password-reset.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit" name="send">Send</button>
    </form>
</div>

</body>
</html>
