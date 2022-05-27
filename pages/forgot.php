<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
    <script src="../assets/js/wow.min.js"></script>

    <style type="text/css">
        body::before{
            position: absolute;
            content: '';
            background: rgba(21,15,130,0.2);
            top: 0;
            left:0 ;
            width: 100%;
            height: 100%;
        }
        .fo{
            text-align: center;
            margin-bottom: 1.8em;
        }
       .fo h2, .fo p {
        color: white;
        text-align: center !important;
       }
       .fo h2 {
        margin-bottom: 0;
        font-size: 1.5rem;
       }
       #submit, #cancel {
            width: 200px !important;
        }
       @media (max-width: 992px) {
          .signup-content {
            padding: 0 10px 10px 10px;
          }
            .fo{
                margin-bottom: 1.0em;
            }
            .fo h2{
               font-size: 1.2em; 
            }
            .fo p {
                font-size: 0.8em;
            }
            #submit, #cancel {
                width: 100px !important;
                padding:10px;
            }
        }
    </style>
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <div class="logo" style="max-width: 100px; margin:auto;">
                            <img src="../assets/images/logotrust.jpg" style="width: 100px;">
                        </div>
                        <div class="fo">
                            <h2> I forgot my password </h2>
                            <p>Enter your email to reset your password:</p>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="email" id="name" placeholder="E-mail"/>
                        </div>
                       
                        <div class="form-group">
                            <input type="text" class="form-input" name="username" id="password" placeholder="Username"/>
                        </div>
                        <div class="form-group" style="display: flex; justify-content: space-around;">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Send"/>
                            <input type="submit" name="cancel" id="cancel" class="form-submit" value="cancel"/>
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
     <script type="text/javascript">
      new WOW().init();
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>