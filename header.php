<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    <link rel="stylesheet" type="text/css" href="myStyles.css">
    <!-- <script src="app.js"></script> -->
    <script type="text/javascript">
        $(document).ready(function(){
            $(".register-submit").click(function(event){
                event.preventDefault();
                if($("#reg-pass").val()===$("#reg-confirm-pass").val()){
                    $("#reg-form").submit();
                }else{
                    $("#pass-match-error").text("Password doesn't match");
                }
            });
        });
    </script>
    
</head>
<body>
    <h1 id="leftpadding"><a href="home.php" style="text-decoration:none; color:black;">VeySur</a></h1>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <ul class="navbar-nav" id="leftpadding">
            <li class="nav-item mr-auto">
            <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="create.php">CreateForm</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto" id="rightpadding">
            <?php if (isset($_SESSION["Name"])) {   
                echo '
                    <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                    </li> ';
             }
             else { 
                echo '
                    <li class="nav-item">
                        <a class="nav-link trigger-btn" href="#myLoginModal" id="login-trigger" data-toggle="modal">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link trigger-btn" href="#myRegisterModal" id="reg-trigger" data-toggle="modal">Register</a>
                    </li> ';
             }   ?>
            
        </ul>
    </nav>

    <div id="myLoginModal" class="modal fade">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <form action="<?php echo htmlspecialchars("login.php");?>" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Login</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">				
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="myRegisterModal" class="modal fade">
        <div class="modal-dialog modal-login">
            <div class="modal-content">
                <form id="reg-form" action="<?php echo htmlspecialchars("register.php");?>" method="post">
                    <div class="modal-header">				
                        <h4 class="modal-title">Register</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">	
                    <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required="required">
                        </div>			
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="reg-pass" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm-password" id="reg-confirm-pass" class="form-control" required="required">
                            <div id="pass-match-error" style="color:red;"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="submit" class="btn btn-primary register-submit" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </div>

    