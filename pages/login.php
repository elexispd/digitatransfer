<?php include_once '../handlers/captcha.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">  
    <link rel="stylesheet" href="../assets/css/templatemo-finance-business.css">

</head>
<body id="log">

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="login" action="../handlers/login.php" class="signup-form">
                        <div class="logo" style="max-width: 100px; margin:auto;">
                            <img src="../assets/images/logotrust.jpg" style="width: 100px;">
                        </div>
                        <div class="form-group">
                            <label>Username or e-mail <span class="text-danger">*</span> :</label>
                            <input type="text" class="form-input form-control" name="username" id="name"/>
                        </div>
                       
                        <div class="form-group">
                            <label>Password  <span class="text-danger">*</span> :</label>
                            <input type="password" class="form-input form-control" name="password" id="password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                       
                        <div class="form-group my-2">
                            <span>Enter Your Answer</span><br>
                            <div class="diagonal-stripes">
                                <h1 class="num1"><?php echo $num1; ?></h1>
                                <input type="number" name="num1" value="<?php echo $num1; ?>" hidden>
                            </div>
                            <span class="sign">+</span>
                            <div class="diagonal-stripe">
                                <h1 class="num2"><?php echo $num2; ?></h1>
                                <input type="number" name="num2" value="<?php echo $num2; ?>" hidden>
                            </div>
                            <span class="sign">=</span>
                            <input type="text" class="form-control" name="ans">
                            <i class="fa fa-refresh mx-4"></i>
                        </div>
                       
                         <div class="form-group">
                            <button class="btn btn-info text-light" name="login">TO COME IN</button>
                        </div>

                        <div class="form-group my-3">
                            <a href="registration.php" class="reg">Registration</a>
                            <span class="divide"> | </span>
                            <a href="forgot.php" class="forgot">Forgot your password? </a> 
                        </div>
                    </form>

                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/log.js"></script>
    <script src="../assets/js/app.js"></script>
     <script type="text/javascript">
      new WOW().init();
    </script>

    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
</body>
</html>