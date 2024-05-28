<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../css/login.css" rel="stylesheet">
    <link href="../css/info.css" rel="stylesheet">
    <script src="../js/java.js" defer></script>
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
            <img id="cover-img" src="../img/84faa72131d5b8a51247c1937238e1a9.png">
        </div>


        <div class="page" id="page1"> 
            <div class="front-page">

                <div class="outer">
                    <div class="content">
                        <div class="form-wrapper">
                            <h1 class="heading">Welcome Back</h1>
                            <p class="login-link">
                                Need a account
                                <!--The arrow in the bottow-->
                                <label class="next" for="checkbox-page1">Register
                                                   
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
                                        <input type="password" id="login-password" name="login-pasword" placeholder="............">
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
                                    <button type="submit" name="login" class="btn">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>

            </div>
            <div class="back-page">
                <img src="../img/Hospital bed-cuate.png">
            </div>
        </div>

        <div class="page" id="page2"> 
            <div class="front-page">

                <div class="outer">
                    <div class="content">
                        <div class="form-wrapper">
                            <h1 class="heading">Get's Started</h1>

                            <p class="login-link">
                                Already have an account
                                <label  class="prev" for="checkbox-page1">Sign in
                                </label>
                            </p>
                            <p class="login-link">
                                Doctor trying to 
                                <label class="next" for="checkbox-page2">Register?
                                </label>
                            </p>


                            <div class="or"></div>


                            <form action="" id="register">
                                <div class="row-item">
                                <div class="item">
                                    <label for="login-Fname">First Name</label>
                                    <div class="input">
                                        <input type="text" id="login-email" placeholder="John">
                                    </div>
                                    <p class="error-msg">
                                        Please enter The info required
                                    </p>
                                </div>

                                <div class="item">
                                    <label for="login-Lname">Last Name</label>
                                    <div class="input">
                                        
                                        <input type="password" id="login-password" placeholder="Doe">
                                    </div>
                                    <p class="error-msg">
                                        Please enter The info required
                                    </p>
                                    
                                </div>
                            </div>


                            <div class="row-item">
                            <div class="item">
                                <label for="login-password">Date of Birth</label>
                                <div class="input">
                                    <input type="Date" id="login-date" placeholder="12-345-678">
                                </div>
                                <p class="error-msg">
                                    Enter Your Birth Date
                                </p>
                                
                            </div>
                            <div class="item">
                                <label for="login-gender" >Gender</label>     
                                    <select class="select" id="login-gender">
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
                                    <label for="login-email">Email address</label>
                                    <div class="input">
                                        <ion-icon name="mail-outline"></ion-icon>
                                        <input type="text" id="login-email" placeholder="example@gmail.com">
                                    </div>
                                    <p class="error-msg">
                                        Please enter a valid email address
                                    </p>
                                </div>


                                
                                <div class="item">
                                    <label for="login-password">Password</label>
                                    <div class="input">
                                        <ion-icon name="lock-closed-outline"></ion-icon>
                                        <input type="password" id="login-password" placeholder="............">
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
                                        <input type="text" id="login-email" placeholder="............">
                                        <ion-icon class="eye" name="eye-off-outline"></ion-icon>
                                    </div>
                                    <p class="error-msg">
                                        Password or Email is incorrect
                                    </p>
                                </div>
                           
                           

                            


                                <div class="item terms">
                                    <div class="input checkbox">
                                        <input type="checkbox" name="" id="accept">
                                    <label for="accept">
                                        I accept the <a href="#">terms of service</a> and <a href="#">privacy policy</a>
                                    </label>
                                    </div>
                                    <p class="error-msg">
                                        You must accept the terms and conditions
                                    </p>
                                </div>
                                <div class="item">
                                    <button class="btn">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>

            </div>
            <div class="back-page">
                <img src="../img/Online Doctor-cuate.png">
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

                            <form action="" id="register">
                                <div class="row-item">
                                <div class="item">
                                    <label for="login-Fname">First Name</label>
                                    <div class="input">
                                        <input type="text" id="login-email" placeholder="John">
                                    </div>
                                    <p class="error-msg">
                                        Please enter The info required
                                    </p>
                                </div>

                                <div class="item">
                                    <label for="login-Lname">Last Name</label>
                                    <div class="input">
                                        
                                        <input type="password" id="login-password" placeholder="Doe">
                                    </div>
                                    <p class="error-msg">
                                        Please enter The info required
                                    </p>
                                    
                                </div>
                            </div>


                            <div class="row-item">
                            <div class="item">
                                <label for="login-password">Date of Birth</label>
                                <div class="input">
                                    <input type="Date" id="login-date" placeholder="12-345-678">
                                </div>
                                <p class="error-msg">
                                    Enter Your Birth Date
                                </p>
                                
                            </div>
                            <div class="item">
                                <label for="login-gender" >Gender</label>     
                                    <select class="select" id="login-gender">
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
                                    <label for="login-email">Email address</label>
                                    <div class="input">
                                        <ion-icon name="mail-outline"></ion-icon>
                                        <input type="text" id="login-email" placeholder="example@gmail.com">
                                    </div>
                                    <p class="error-msg">
                                        Please enter a valid email address
                                    </p>
                                </div>


                                
                                <div class="item">
                                    <label for="login-password">Password</label>
                                    <div class="input">
                                        <ion-icon name="lock-closed-outline"></ion-icon>
                                        <input type="password" id="login-password" placeholder="............">
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
                                        <input type="text" id="login-email" placeholder="............">
                                        <ion-icon class="eye" name="eye-off-outline"></ion-icon>
                                    </div>
                                    <p class="error-msg">
                                        Password or Email is incorrect
                                    </p>
                                </div>
                            


                                <div class="item terms">
                                    <div class="input checkbox">
                                        <input type="checkbox" name="" id="accept">
                                    <label for="accept">
                                        I accept the <a href="#">terms of service</a> and <a href="#">privacy policy</a>
                                    </label>
                                    </div>
                                    <p class="error-msg">
                                        You must accept the terms and conditions
                                    </p>
                                </div>
                                <div class="item">
                                    <button class="btn">Login</button>
                                </div>
                            </form>
                           
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
