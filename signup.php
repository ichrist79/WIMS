<?php

include ("functions.php");

?>
<!DOCTYPE html>


<html>
    <head>
        <title>Sign up</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/colorgraph.css"/>
        <link rel="stylesheet" href="css/edit.css"/>
    </head>
    <body>
        
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form role="form" method="post" action="signup.php">
			<h2>Please Sign Up <small>Before continue.</small></h2>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
                        <input type="text" name="first_name" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="last_name" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2">
					</div>
				</div>
			</div>
                        
			<div class="form-group">
				<input type="text" name="display_name" id="display_name" class="form-control input-lg" placeholder="Display Name" tabindex="3">
			</div>
			<div class="form-group">
				<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4">
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4 col-sm-3 col-md-3">
					<span class="button-checkbox">
                                        <!--<button type="button" class="btn" data-color="info" tabindex="7">I Agree</button>-->
                                         <input type="checkbox" name="t_and_c" id="t_and_c" class="hidden" value="1">
					</span>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-9">
					 By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.
				</div>
			</div>
			
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6"><input type="submit" name="register" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
				<div class="col-xs-12 col-md-6"><a href="index.php" class="btn btn-success btn-block btn-lg">Sign In</a></div>
			</div>
		</form>
	</div>
</div>
<?php
try{
	if (isset($_POST['register'])){
	$fname = ($_POST['first_name']);
	$lname = ($_POST['last_name']);
	$dname = ($_POST['display_name']);
	$email = ($_POST['email']);
	$password = md5($_POST['password']);
	$passcon = md5($_POST['password_confirmation']);
	
	if($fname == "" || $lname == "" || $dname == "" || $password == "" || $email == ""){
		echo '<script>window.alert("simplirwse ola ta pedia");</script>';
	}elseif (strlen($fname) > 20){
		echo '<script>window.alert("first name must be less than 20 characters!");</script>';
	}elseif (strlen($lname) > 20){
		echo '<script>window.alert("last name must be less than 20 characters!");</script>';
	}elseif (strlen($dname) > 20){
		echo '<script>window.alert("display name must be less than 20 characters!");</script>';
	}elseif (strlen($email) > 30){
		echo '<script>window.alert("E-mail must be less than 30 characters!");</script>';
	}else{
		$stmt1 = $conn->prepare("SELECT email FROM users WHERE email=:email");
		$stmt1->bindParam("email", $email,PDO::PARAM_STR);
		$stmt1->execute();
		$register1=$stmt1->rowCount();
			if($register1 > 0){
				echo '<script>window.alert("Username already exists!");</script>';
			}elseif ($passcon == $password){
				$conn->exec("INSERT INTO users (fname,lname,password,email,display) VALUES ('".$fname."','".$lname."','".$password."','".$email."','".$dname."')");
				echo '<script>window.alert("You have registered!");</script>';
			}else{
				echo '<script>window.alert("password missmatch!");</script>';
			}
	}
	}
}
catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	 
	 ?>
<!-- Modal -->
<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
                                
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
			</div>
			<div class="modal-body">
				<p>Απαγορεύεται η ψευδής/παραπλανητική δήλωση στοιχείων προσώπου, φυσικού ή νομικού, ρητώς συμπεριλαμβανομένης της ύπαρξης συνεργασίας ή οιασδήποτε σχέσεως με οιοδήποτε φυσικό ή νομικό πρόσωπo.</p>
				<p>Απαγορεύεται η ανάρτηση, αποστολή, μετάδοση, διάθεση μέσω της ιστοσελίδας Υλικού με σκοπό την προώθηση ανεπιθύμητου περιεχομένου (spam).</p>
				<p>Απαγορεύεται η ανάρτηση, αποστολή, μετάδοση, διάθεση μέσω της ιστοσελίδας Υλικού που περιέχει κακόβουλο λογισμικό, ιούς.</p>
				<p>Οι χρήστες οφείλουν να συμμορφώνονται με όλους τους εφαρμοστέους νόμους και κανόνες, εθνικούς και διεθνείς.</p>
				<p>Η ΕΤΑΙΡΕΙΑ ΔΕ ΦΕΡΕΙ ΟΥΔΕΜΙΑ ΕΥΘΥΝΗ ΣΧΕΤΙΚΑ ΜΕ ΤΗΝ ONLINE Ή OFFLINE ΣΥΜΠΕΡΙΦΟΡΑ ΧΡΗΣΤΗ.</p>
			</div>
			<div class="modal-footer">

				<button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
                    </div>
                
            
        
    </body>
</html>
