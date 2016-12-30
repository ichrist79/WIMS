<?php
session_start();
include("header.php");
?>
			         <h2> Schedule an Event </h2>		
         <form class="form-horizontal" action="meetingschedule.php" method="post">
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
						<div class="form-group col-sm-6" id="dates">
               <!-- <label for="Day" class="control-label col-xs-3">Day</label>
                            <div class="col-xs-9">
                <input type="date" name="imerominia" />
				 <span id="onselectTarget4" style="margin-left: 30px;"></span>-->
				 
		<!--	<button type="submit" id="addScnt" name="add" value="Add Dates">add dates</button>-->
					<h2><a href="#" id="addScnt">add dates</a></h2>
<div id="p_scents">
    <p name="">
	<?php
	$x = 1;
	$z = 1;
	
	
       // echo '<label for="p_scnts"><input type="date" id="p_scnt" size="120" name="datepar" value="" placeholder="Input Value"/></label>';
	   		echo '<label for="p_scnts"><input type="date" id="p_scnt" size="20" name="$x" value="" placeholder="Input Value" /></label>';

		echo '<label for="p_scnts"><input type="time" id="p_scnt" size="20" name="'.$z.'" value="" placeholder="Input Value" /></label>';
	//echo '<label for="p_scnts"><input type="time" id="p_scnt" size="20" name="$z" value="" placeholder="Input Value" /></label>';
			?>			
							
							<input id="datecounter" type="text" name="count" value="1"/>
							<?php 
							//style="display:none"
						//	$y = 1;
					//		$x = 1;
						//	while(isset($_POST['add'])){
					//		if (isset($_POST['add'])){
								
								
					//			echo '<label for="p_scnts"><input type="date" id="p_scnt" size="20" name="'.$x.'" value="" placeholder="Input Value"/></label>
					//					<label for="p_scnts"><input type="time" id="p_scnt" size="20" name="'.$y.'" value="" placeholder="Input Value" /></label>';
					//			$x++;
					//			$y++;
					//			echo $x;
					//			echo $y;
					//		}
							//}
							?>
	
	</p>
</div>
                    
                </div>
            </div>
			
</div>
			
			<!--			<div class="form-group col-sm-6" >
                <label for="Time" class="control-label col-xs-3">Time</label>
                            <div class="col-xs-9">
                
                    <input type="time" class="time" name="wra1"/>
                    <span id="onselectTarget" style="margin-left: 30px;"></span>
                </div>
			
			<div  class="form-group col-sm-6" >
                            <label for="desription" class="control-label col-xs-3">Participants</label>
                            <div class="col-xs-9">
							<textarea rows="5" cols="60" class="form-control" id="participants">
                                
							</textarea>
                            </div>
							
                        </div>
	-->
	
			<input type="submit" name="event" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7">
                    </div>
				
    </form>
</div>
<?php
try{
	if (isset($_POST['event'])){
		
	$userid = ($_SESSION['uid']);
	$title = ($_POST['title']);
	$location = ($_POST['location']);
	$perigrafi = ($_POST['perigrafi']);
	//$day = strtotime($_POST[$x]);
	//$day = date('Y-m-d', $day);
	//$time = strtotime($_POST[$y]);
	//$time = date('H:i:s', $time);
	//$dayx = strtotime($_POST[$x]);
	//$dayx = date('Y-m-d', $dayx);
	//$timey = strtotime($_POST[$y]);
	//$timey = date('H:i:s', $timey);

	 //
	
	
if($title == "" || $location == "" || $perigrafi == ""){
		echo '<script>window.alert("simplirwse ola ta pedia");</script>';
	}else{
		try{
		$stmt = $conn->prepare("SELECT title FROM events WHERE title=:title AND user_id=:user_id");
		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
		}
catch(PDOException $e) {
			echo '{"error1":{"text":'. $e->getMessage() .'}}';
		}
		$stmt->execute();
		$register=$stmt->rowCount();

			if($register > 0){
				echo '<script>window.alert("title already exists!");</script>';
				}else{
					
				$conn->exec("INSERT INTO events (user_id,title,perigrafi,location) VALUES ('".$userid."','".$title."','".$perigrafi."','".$location."')");

				//$conn->exec("INSERT INTO event_day_time (id_event,day,time,vote) VALUES ('".$userid."','".$day."','".$time."','0')");
				//$insert = $conn->exec("INSERT INTO event_day_time (id_event,day,time,vote) VALUES ('".$userid."','".$dayx."','".$timey."','0')");
					//	}  //trexei
		//try{
			//	$stmt1 = $conn->prepare("SELECT id_event FROM events WHERE title=:title AND user_id=:user_id");
			//	$stmt1->bindParam("id_event", $id_event,PDO::PARAM_STR);
			//	$stmt1->bindParam("title", $title,PDO::PARAM_STR);
			//	$stmt1->bindParam("user_id", $user_id,PDO::PARAM_STR);
			//	$stmt1->execute();
			//	$register1=$stmt1->rowCount();
				//	$check = $conn->query("SELECT id_event FROM events WHERE title=:title AND user_id=:user_id");
				//	$evid = $check->fetch(PDO::FETCH_ASSOC);
				//if($register1 > 0){
					
					//$get_id = $stmt1->fetch(PDO::FETCH_ASSOC);
		//}}
//catch(PDOException $e) {
		//	echo '{"error3":{"text":'. $e->getMessage() .'}}';
		//}
					$count = ($_POST['count']);
					$i=1;
				while($i<=$count){
					
		   
					// $dayz = strtotime($_POST['datepar']);
					  $dayz = strtotime($_POST['$x']);
					$dayz = date('Y-m-d', $dayz); 
					echo $dayz;
					//$dayz = date('Y-m-d', $dayz);
					echo $dayz;
					$timey = strtotime($_POST[$z]);
					//$timey = strtotime($_POST['$z']);
					$timey = date('H:i:s', $timey);
					echo $timey;
					$x++;
					$z++;
					$i++;
					$conn->exec("INSERT INTO event_day_time (id_event,day,time,vote) VALUES ('".$userid."','$dayz','".$timey."','0')");
				}
				
				}	
				echo '<script>window.alert("to event apothikeftike");</script>';
				}
	}
	//}
	
	
	

}catch(PDOException $e) {
			echo '{"error2":{"text":'. $e->getMessage() .'}}';
			print $_SESSION['uid'];
			//echo $evid['id_event'];
			
		}
	
	

?>
</body>
</html>