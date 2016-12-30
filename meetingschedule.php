<?php
session_start();
include("header.php");

?>
<h2> Schedule an Event </h2>
	<form class="form-horizontal" name="add_me1" id="add_me1" method="POST" action="meetingschedule.php">
         <p></p>
		 <div class="form-group">
                        <div class="form-group col-sm-6" >
                            <label for="title" class="control-label col-xs-3">Title</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" id="title" name="title"/>
                            </div>
                        </div>
						<br> 
						</br>
						<div  class="form-group col-sm-6" >
                            <label for="location" class="control-label col-xs-3">Location</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" id="txtautocomplete" name="location"/>
								<label id="lblResult"> </label>
                            </div>
                        </div>
						<br> </br>
						<div  class="form-group col-sm-6" >
                            <label for="desription" class="control-label col-xs-3">Description</label>
                            <div class="col-xs-9">
							<textarea rows="5" cols="60" class="form-control" id="description" name="perigrafi">
                                
							</textarea>
                            </div>
                        </div>
						<div class="form-group col-sm-6" >
                <label for="Day" class="control-label col-xs-3">Day</label>
                            <div class="col-xs-9">
							<form name="add_me" id="add_me">
							<table id="date">
							<input type="date" name="date[]" />
							<input type="time" name="time[]" />
							<button type="button" name="add" id="add_input">Add</button>
							</table>
							</form>
                </div>
            </div>
			<!--			<div class="form-group col-sm-6" >
                <label for="Time" class="control-label col-xs-3">Time</label>
                            <div class="col-xs-9">
							<form name="add_me2" id="add_me2">
							<table id="time">
							<input type="time" name="time[]" />
							<button type="button" name="add2" id="add_input2">Add</button>
							</table>
							</form>
                </div>
            </div>-->
			
		<!--	<div  class="form-group col-sm-6" >
                            <label for="desription" class="control-label col-xs-3">Participants</label>
                            <div class="col-xs-9">
							<textarea rows="5" cols="60" class="form-control" id="participants">
							</textarea>
                            </div>
                        </div>-->
						<input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7">
                    </div>
					
    </form>
</div>
   
<?php

	if (isset ($_POST['submit'])){
	$datecount = count($_POST["date"]);	
	$userid = $_SESSION['uid'];
	$title = $_POST['title'];
	$location = $_POST['location'];
	$perigrafi = $_POST['perigrafi'];






if($title == "" || $location == "" || $perigrafi == ""){
		echo '<script>window.alert("simplirwse ola ta pedia");</script>';
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
							if(trim($_POST["date"][$i] != '')){	
									
									//theloume na paroume to event_id gia tin parallili eggrafi sto event_day_time
									$conn->exec("INSERT INTO event_day_time (id_event,day,time,vote) VALUES ('".$eventid."','".$_POST["date"][$i]."','".$_POST["time"][$i]."','0')");
						}else{
							echo "dwse kati";
							}	
													}
									}
   
		}
	}
   ?>
   
   
   
   
   
   

</body>
</html>
