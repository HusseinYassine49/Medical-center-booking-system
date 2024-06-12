<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/login.css" rel="stylesheet">
    <link href="css/info.css" rel="stylesheet">
    <script src="js/eye.js" defer></script>
    <script src="js/sendlogin.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
</head>
<body>
    <input class="invisible" type="checkbox" id="checkbox-cover">
    <input class="invisible" type="checkbox" id="checkbox-page1">
    <input class="invisible" type="checkbox" id="checkbox-page2">
    <input class="invisible" type="checkbox" id="checkbox-page3">

    <div class="container">
        <div class="cover">
            <label for="checkbox-cover"></label>
            <img id="cover-img" src="images/84faa72131d5b8a51247c1937238e1a9.png">
        </div>


        <div class="page" id="page1"> 
            <div class="front-page">

                <div class="outer">
                    <div class="content">
                        <div class="form-wrapper">
                            <h1 class="heading">Welcome Back</h1>
                            <p class="login-link">
                                Need a account
                                <label class="next" for="checkbox-page1">Register</label>
                                                   
                            </p>
                            <div class="social-logins">
                                <a href="" class="social-login facebook">
                                    <img src="f.png" alt="">
                                    <span>Login with Facebook</span>
                                </a>
                                <a href="" class="social-login google">
                                    <img src="g.png" alt="">
                                    <span>Login with Google</span>
                                </a>
                            </div>
                            <div class="or"></div>


                            <!--THE START OF THE FORM INSIDE OF PAGE 1 LOGIN PAGE -->
                            <form action="login-verification.php" method="post" id="login-form" >
                                <div class="item">
                                    <label for="login-email">Email address</label>
                                    <div class="input">
                                        <ion-icon name="mail-outline"></ion-icon>
                                        <input type="text" id="login-email" name="login-email" placeholder="example@gmail.com">
                                    </div>
                                    <p class="error-msg">
                                        Please enter a valid email address
                                    </p>
                                </div>

                                <div class="item">
                                    <label for="login-password">Password</label>
                                    <div class="input">
                                        <ion-icon name="lock-closed-outline"></ion-icon>
                                        <input type="password" id="login-password" name="login-password" placeholder="............">
                                        <ion-icon class="eye" name="eye-off-outline"></ion-icon>
                                    </div>
                                    <p class="error-msg">
                                        Password or Email is incorrect
                                    </p>
                                </div>
                                
                                <div class="item terms">
                                    <div class="input checkbox">
                                        <input type="checkbox" name="" id="remember">
                                    <label for="remember">
                                       Remember me
                                    </label>
                                    </div>  
                                </div>
                                
                                <div class="item">
                                    <button type="submit" name="enter" class="btn">Login</button>
                                </div>

                                <div class="frgt-pass">
                                <label>
                                    <a href="Reset-Password/forget-password.php">Forgot you Password</a>
                                    
                                </label>
                                </div>
                                
                            </form>

                            <!--HERE THE END OF THE FORM-->
                        </div>
                    </div>
            </div>

            </div>
            <!--HERE THE BACK PAGE WHERE U FIND THE PING IN PAGE 2-->
            <div class="back-page">
                <img src="images/Hospital bed-cuate.png">
            </div>
        </div>

        <div class="page" id="page2"> 
            <div class="front-page">

                <div class="outer">
                    <div class="content">
                        <div class="form-wrapper">
                            <h1 class="heading">Get's Started</h1>

                             <p class="login-link">Already have an account<label  class="prev" for="checkbox-page1">Sign in</label></p>
                            <p class="login-link">Doctor trying to <label class="next" for="checkbox-page2">Register?</label></p>

                            <div class="or"></div>

                         <!--THE START OF THE FORM INSIDE OF PAGE 2 REGISTRATION PAGE -->
                            <form action="reg-valid.php" id="register" method="POST">
                                
                                <div class="row-item">
                                <div class="item">
                                    <label for="register-Fname">First Name</label>
                                    <div class="input"><input type="text"  name="fname" placeholder="John"></div>
                                    <p class="error-msg">Please enter The info required</p>
                                </div>
                                
                                <div class="item">
                                    <label for="register-Lname">Last Name</label>
                                    <div class="input"><input type="text"  name="lname" placeholder="Doe"></div>
                                    <p class="error-msg">Please enter The info required </p>
                                </div>
                            </div>


                            <div class="row-item">
                            <div class="item">
                                <label for="register-date">Date of Birth</label>
                                <div class="input"><input type="date"  name="dob"></div>
                                <p class="error-msg">Enter Your Birth Date</p>
                            </div>
                            <div class="item">
                                <label for="register-gender" >Gender</label>     
                                        <select class="select" name="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="others">Others</option>
                                        </select>
                                <p class="error-msg">Select your gender</p>
                            </div>
                            </div>


                            <div class="item">
                                <label for="register-email">Email address</label>
                                <div class="input">
                                    <ion-icon name="mail-outline"></ion-icon>
                                    <input type="mail" name="email" placeholder="example@gmail.com">
                                </div>
                                <p class="error-msg">Please enter a valid email address</p>
                            </div>

                            <div class="item">
                                <label for="register-password">Password</label>
                                <div class="input">
                                    <ion-icon name="lock-closed-outline"></ion-icon>
                                    <input type="password" name="password" placeholder="............">
                                    <ion-icon class="eye" name="eye-off-outline"></ion-icon>
                                </div>
                                <p class="error-msg">Password or Email is incorrect</p>
                            </div>
                        
                            <div class="item">
                                <label>Confirm Password</label>
                                <div class="input">
                                    <ion-icon name="lock-closed-outline"></ion-icon>
                                    <input type="password" name="confirm-password" placeholder="............">
                                    <ion-icon class="eye" name="eye-off-outline"></ion-icon>
                                </div>
                                <p class="error-msg">Password or Email is incorrect</p>
                            </div>
                           
                                <div class="item terms">
                                    <div class="input checkbox">
                                        <input type="checkbox" name="" id="accept1">
                                    <label for="accept">
                                        I accept the <a href="#">terms of service</a> and <a href="#">privacy policy</a>
                                    </label>
                                    </div>
                                    <p class="error-msg">
                                        You must accept the terms and conditions
                                    </p>
                                </div>
                                <div class="item">
                                    <button type="submit" name="login" class="btn">REGISTER</button>
                                </div>
                            </form>
                            <!--HERE THE END OF THE FORM PAGE 2-->


                        </div>
                    </div>
            </div>

            </div>
            <!--HERE THE BACK PAGE WHERE U FIND THE PING IN PAGE 2-->
            <div class="back-page">
                <img src="images/Online Doctor-cuate.png">
            </div>
        </div>

        <div class="page" id="page3"> 
            <div class="front-page">

                <div class="outer">
                    <div class="content">
                        <div class="form-wrapper">
                            <h1 class="heading">Welcome Back</h1>
                            <p class="login-link">
                                Already have an account
                                <label class="prev" for="checkbox-page2">Back to Login
                                </label>
                            </p>
                            <div class="or"></div>

                            <!--THE START OF THE FORM INSIDE OF PAGE 3 DOCTOR REGISTRATION PAGE -->
                            <form id="doctor-register" action="doc-reg-valid.php" method="POST">
                                <div class="row-item">
                                <div class="item">
                                    <label for="doctor-Fname">First Name</label>
                                    <div class="input"><input type="text" name="doctor-Fname" placeholder="First Name" required></div>
                                    <p class="error-msg">
                                        Please enter The info required
                                    </p>
                                </div>

                                <div class="item">
                                    <label for="doctor-Lname">Last Name</label>
                                    <div class="input"> <input type="text" name="doctor-Lname" placeholder="Last Name" required></div>
                                    <p class="error-msg">
                                        Please enter The info required
                                    </p>
                                    
                                </div>
                            </div>


                            <div class="row-item">
                            <div class="item">
                                <label for="doctor-date">Date of Birth</label>
                                <div class="input">
                                <input type="date" name="doctor-dob" placeholder="Date of Birth" required>
                                </div>
                                <p class="error-msg">
                                    Enter Your Birth Date
                                </p>
                                
                            </div>
                            <div class="item">
                                <label for="doctor-gender" >Gender</label>     
                                    <select class="select" name="doctor-gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
                                    </select>
                                <p class="error-msg">
                                    Select your gender
                                </p>
                            </div>
                        </div>


                            
                                <div class="item">
                                    <label for="doctor-email">Email address</label>
                                    <div class="input"><ion-icon name="mail-outline"></ion-icon>
                                        <input type="email" name="doctor-email" placeholder="Email" required></div>
                                    <p class="error-msg">
                                        Please enter a valid email address
                                    </p>
                                </div>


                                
                                <div class="item">
                                    <label for="doctor-password">Password</label>
                                    <div class="input">
                                        <ion-icon name="lock-closed-outline"></ion-icon>
                                        <input type="password" name="doctor-password" placeholder="............" required>
                                        <ion-icon class="eye" name="eye-off-outline"></ion-icon>
                                    </div>
                                    <p class="error-msg">
                                        Password or Email is incorrect
                                    </p>
                                </div>
                            
                                <div class="item">
                                    <label>Confirm Password</label>
                                    <div class="input">
                                        <ion-icon name="lock-closed-outline"></ion-icon>
                                        <input type="password" name="doctor-confirm-password" placeholder="............" required>
                                        <ion-icon class="eye" name="eye-off-outline"></ion-icon>
                                    </div>
                                    <p class="error-msg">
                                        Password or Email is incorrect
                                    </p>
                                </div>
                            


                                <div class="item terms">
                                    <div class="input checkbox">
                                        <input type="checkbox" name="" id="accept2">
                                    <label for="accept">
                                        I accept the <a href="#">terms of service</a> and <a href="#">privacy policy</a>
                                    </label>
                                    </div>
                                    <p class="error-msg">
                                        You must accept the terms and conditions
                                    </p>
                                </div>
                                <div class="item">
                                    <button type="submit" name="doctor-reg" class="btn">Register as a Doctor</button>
                                </div>
                            </form>
                            <!--THE END OF THE FORM OF DOCTOR REGISTERATION -->
                           
                        </div>
                    </div>
            </div>

            </div>
            <div class="back-page">
                
            </div>
        </div>
        


        <div class="back-cover">
            
        </div>
        <div class="trapezoid"></div>
    </div>
</body>
</html>
