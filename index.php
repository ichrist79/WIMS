<?php

    session_start();
    require_once 'connection.php';

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Web Intelligence Meeting Scheduler</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/edit.css"/>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Web Intelligence Meeting Scheduler</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <form class="navbar-form navbar-right" action="index.php" method="POST">
                            <div class="form-group">
                                <input type="text" placeholder="Email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Password" name="password" class="form-control" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="login" value="Sign in" >
                            <!--<button type="submit" class="btn btn-success">Sign in</button>-->
                        </form>
                    </div>
                </div>
            </nav>
            
            <?php
                
                if(isset($_POST["login"])) {
                    if(empty($_POST["email"]) || empty($_POST["password"])) {
                        $message ="All fields are required";
                    }
                    else {
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        $query = "SELECT * FROM user WHERE email = :email AND password = :password";
                        $stmt = $db -> prepare($query);
                        $stmt -> bindParam(":email", $email) ;
                        $stmt -> bindParam(":password", $password);
                        $stmt -> execute();
                        $count = $stmt -> rowCount();
                        if($count > 0) {
                            $_SESSION["email"] = $_POST["email"];
                            header("location:user_homepage.php");
                        }
                        else {
                            echo "<script>alert('Invalid Email or Password')</script>";
                        }
                    }
                }
            
            ?>

            <div class="container-fluid">
                <div id="img_button">
                    <img src="https://www.opusmeetingrooms.com/wp-content/themes/office/images/bg/meeting_room_bkg-3.jpg" class="img-responsive">
                    <div id="button">
                        <p>Welcome to the most sophisticated Meeting Scheduler of the entire Web</p>
                        <a href="register.php" class="btn btn-primary btn-lg">Sign Up</a>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <footer class="panel-footer">
                    Copyright 2016
                </footer>
            </div>
        </div>     

    </body>
</html>
