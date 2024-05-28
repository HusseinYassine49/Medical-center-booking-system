
<?php

session_start();

require "connection.php";

   if(isset($_POST['login'])) // check whether user submits the form
   {
        $email_b = $_POST['login-email'];
        $password_b = $_POST['login-password'];

        $email = mysqli_real_escape_string($con,$email_b); // escaping special characters
        $password = mysqli_real_escape_string($con,$password_b);

        $query = "SELECT isAdmin FROM user WHERE ( username, pass, Fullname) VALUES ('$name','$password','$fname') LIMIT 1 ";
        $result = mysqli_query($con, $query);

        if($result)
        {
          $row = mysqli_fetch_assoc($result);

        $user_type = $row['isAdmin']; // you get user type here whether he's admin or login

        if ($user_type == 1) { 

             // this use is admin
            // do stuff here or redirect to admin panel or wherever you want
            header ("location: admin.php");
        }

        elseif ($user_type == 0) {
            // this user is member
            // do stuff here or redirect wherever you want
            header ("location: view.php");
        }

        else
        {
            // if there's some other value, simplyredirect to login page again
        }
      } // close of if($result)
     else
     {
        echo "query failed"; // redirect to login page again
      }

    }

    else
    {
        // redirect to login page again         
    }
$_SESSION['username']=$name;
$_SESSION['pass']=$password;
$_SESSION['Fullname']=$fname;


 ?>
