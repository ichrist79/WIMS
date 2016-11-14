<?php
session_start();
include ("functions.php");

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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

                    <form class="navbar-form navbar-right" role="form" method="POST" action="index.php">
                        <div class="form-group" >
                            <input type="text" placeholder="Email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" name="password">
                        </div>
                        <!--<a href="profile.html" class="btn btn-primary">Sign In</a>-->
                        <input type="submit" class="btn btn-success" name="login" value="Sign in">
                    </form>

                </div>
            </div>
        </nav>
<?php

if (isset($_POST['login'])){
	if (isset($_SESSION['uid'])){
		echo '<script>window.alert("You are already logged in!");</script>';
	}else{
		$email = ($_POST['email']);
		$password = md5($_POST['password']);
		$stmt = $conn->prepare("SELECT id FROM users WHERE email = '".$email."'  AND password = '".$password."'"); 
		$stmt->bindParam("email", $email,PDO::PARAM_STR) ;
		$stmt->bindParam("password", $password,PDO::PARAM_STR) ;
		$stmt->execute();
		$count=$stmt->rowCount();
			if($count == 1){
				$get_id = $stmt->fetch(PDO::FETCH_ASSOC);
				$_SESSION['uid'] = $get_id['id'];
				header("Location: profile.html");
			}else{
				echo '<script>window.alert("Invalid Username/Password Combination!");</script>';
			}
	}
}else{
	echo '<script>window.alert("You have visited this page incorrectly!");</script>';
}

?>
        <div class="container-fluid">
            <div id="img_button">
                <img src="https://www.opusmeetingrooms.com/wp-content/themes/office/images/bg/meeting_room_bkg-3.jpg" class="img-responsive">
                <div id="button">
                    <p>Welcome to the most sophisticated Meeting Scheduler of the entire Web</p>
                    <a href="signup.php" class="btn btn-primary btn-lg">Sign Up</a>
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
