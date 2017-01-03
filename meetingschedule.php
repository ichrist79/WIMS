<?php
session_start();
include("header.php");

?>
<h2> Schedule an Event </h2>
	<form class="form-horizontal" name="add_me1" id="add_me1" method="POST" action="meetingschedule.php">
         <p></p>
		 <div class="form-group">
                        <div class="form-group col-sm-6" >
                            <label for="title" class="control-label col-xs-3">Τίτλος</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Εισάγεται τίτλο"/>
                            </div>
                        </div>
						<br> 
						</br>
						<div  class="form-group col-sm-6" >
                            <label for="location" class="control-label col-xs-3">Τοποθεσία</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" id="txtautocomplete" name="location" />
								<label id="lblResult"> </label>
                            </div>
                        </div>
						<br> </br>
						
							<div  class="form-group col-sm-6" >
                            <label for="desription" class="control-label col-xs-3">Περιγραφή</label>
                            <div class="col-xs-9">
							<textarea class="form-control" placeholder = "Εισάγεται περιγραφή" rows="5" cols="60"  id="description" name="perigrafi" ></textarea>
                            </div>
                        </div>
						
						
					
						<div class="form-group col-sm-6" >
							<label for="Day" class="control-label col-xs-3">Ημέρα</label>
                            <div class="col-xs-9">
							<table id="date">
							<input type="date" name="date[]" class="form-control" value="<?php echo date('Y-m-d', strtotime("+2 day")); ?>"/>
							<input type="time" name="time[]" class="form-control"/>
							<button type="button" name="add" id="add_input">Add</button>
							</table>
                </div>
            </div>			
							<div  class="form-group col-sm-6" >
                            <label for="Participants" class="control-label col-xs-3">Συμμετέχοντες</label>
                            <div class="col-xs-9">
							<table id="email">
							<!--<input type="text" name="email[]" placeholder="Enter Emails" class="form-control"/>-->
							<input class="form-control" placeholder="Contact's email" name="email[]" id="contact_email" type="text" 
								title="Contact's email (format: xxx@xxx.xxx)" 
								pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)"> 
							<button type="button" name="add_inputm" id="add_inputm">Add</button>
							</table>
                            </div>
                        </div>
						<input type="submit" name="submit" id="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7">
                    </div>
					
    </form>
	
</div>
   
<?php
try{
	if (isset ($_POST['submit'])){
	$datecount = count($_POST["date"]);	
	$mailcount = count($_POST["email"]);	
	$userid = $_SESSION['uid'];
	$title = $_POST['title'];
	$location = $_POST['location'];
	$perigrafi = $_POST['perigrafi'];
	$contractDateBegin = date('Y-m-d', strtotime("+2 day"));

	
	
if($title == "" || $location == "" || $perigrafi == ""){
		echo '<script>window.alert("simplirwse ola ta pedia");</script>';
	//}else{
	//	if($datecount > 0){
						//	for($im=0; $im<$datecount; $im++){
						//		if(trim($_POST["date"][$im] != '') && ($_POST["date"][$im] > $contractDateBegin)) {
						//			echo("swsti mera");
						//				echo '<br />';
	//	}}}//else {
							//			echo(" lathos mera");
							//	echo '<br />';
							//	}
							//	}
								
	//	}else{
			//if($mailcount > 0){
	//	for($ma=0; $ma<$mailcount; $ma++){
		//	if(trim($_POST["email"][$ma] != '') && (!filter_var($_POST["email"][$ma], FILTER_VALIDATE_EMAIL) === false)){
								//echo($_POST["email"][$ma]. " is a valid email address");
							//	echo '<br />';
								//	} else {
								//		echo($_POST["email"][$ma]." is not a valid email address");
								//		echo '<br />';
								//	}
			//}
	}else{
		$stmt = $conn->prepare("SELECT title FROM events WHERE title=:title AND user_id=:user_id");
		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
		$stmt->execute();
		$register=$stmt->rowCount();
			if($register > 0){
				echo '<script>window.alert("title already exists!");</script>';
					}else{
						$conn->exec("INSERT INTO events (user_id,title,perigrafi,location) VALUES ('".$userid."','".$title."','".$perigrafi."','".$location."')");
						$q = $conn->query("SELECT id_event FROM events ORDER BY id_event DESC LIMIT 1");
						$eventid = $q->fetchColumn();
						}
						if($datecount > 0){
							for($i=0; $i<$datecount; $i++){
								if(trim($_POST["date"][$i] != '') && ($_POST["date"][$i] > $contractDateBegin)){	
									$conn->exec("INSERT INTO event_day_time (id_event,day,time,vote) VALUES ('".$eventid."','".$_POST["date"][$i]."','".$_POST["time"][$i]."','0')");
										}else{
											$conn->exec("DELETE FROM events WHERE id_event = '".$eventid."' LIMIT 1");
											echo "dwse swsti imerominia";
												}	
													}
														}
									if($mailcount > 0){
										for($m=0; $m<$mailcount; $m++){
											if(trim($_POST["email"][$m] != '')){ //&& (!filter_var($_POST["email"][$m], FILTER_VALIDATE_EMAIL) === false)){	
												$conn->exec("INSERT INTO participants (user_id,email,event_id) VALUES ('".$userid."','".$_POST["email"][$m]."','".$eventid."')");
												$to      = ($_POST["email"][$m]);
												$subject = 'the subject';
												$message = 'hello';
												$headers = 'From: wimsmeetings@gmail.com' . "\r\n" .
												'Reply-To: webmaster@example.com' . "\r\n" .
												'X-Mailer: PHP/' . phpversion();
												mail($to, $subject, $message, $headers);
												echo 'Email Sent.';
																				}else{
																					$conn->exec("DELETE FROM events WHERE id_event = '".$eventid."'LIMIT 1");
																					$conn->exec("DELETE FROM event_day_time WHERE id_event = '".$eventid."'");
																					//$conn->exec("DELETE FROM participants WHERE event_id = '".$eventid."'");
																					echo "dwse swsta mails";
																					}	
																		}
														}
		}
	

	}else {
		echo "dwse times";
	}
}catch(PDOException $e) {
			echo '{"error1":{"text":'. $e->getMessage() .'}}';
		}

?>
</body>
</html>
