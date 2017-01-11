<?php
session_start();
include("header.php");
?>
<h2> Προγραμμάτισε Ένα Meeting </h2>

<br></br>

<form class="form-horizontal" name="add_me1" id="add_me1" method="POST" action="meetingschedule.php">

    <div class="form-group">

        <div class="form-group">
            <div class="form-group col-sm-6" >
                <label for="title" class="control-label col-xs-3">Τίτλος</label>
                <div class="col-xs-9">
                    <input type="text" class="form-control" id="title" name="title"/>
                </div>
            </div>
            <div class="form-group col-sm-6" >
                <label for="location" class="control-label col-xs-3">Τοποθεσία</label>
                <div class="col-xs-9">
                    <input type="text" class="form-control" id="txtautocomplete" name="location"/>
                    <label id="lblResult"> </label>
                </div>
            </div>
        </div>    

        <div class="form-group">
            <div class="form-group col-sm-6">
                <label for="desription" class="control-label col-xs-3">Περιγραφή</label>
                <div class="col-xs-9">
                    <textarea rows="5" cols="60" class="form-control" id="description" name="perigrafi"></textarea>
                </div>
            </div>
        </div>

        <br/>

        <div class="form-group">
            <div class="form-group col-sm-6" >
                <label for="Day" class="control-label col-xs-3">Ημέρα & Ώρα</label>
                <div class="col-xs-6">
                    <table id="date">
                        <tr>
                            <td><input type="date" name="date[]" class="form-control" min="<?php echo date('Y-m-d', strtotime("+2 day")); ?>"/></td>
                            <td><input type="time" name="time[]" class="form-control"/></td>
                        </tr>
                        <!--<button class="btn btn-info" type="button" name="add" id="add_input">Πρόσθεσε Ημέρα & Ώρα</button>-->
                    </table>
                    <button class="btn btn-info" type="button" name="add" id="add_input">Πρόσθεσε Ημέρα & Ώρα</button>
                </div>
            </div>	
            <div  class="form-group col-sm-6" >
                <label for="Participants" class="control-label col-xs-3">Συμμετέχοντες</label>
                <div class="col-xs-6">
                    <table id="email">
                        <tr>
                            <td><input class="form-control" placeholder="Contact's email" name="email[]" id="contact_email" type="text" 
                                       title="Contact's email (format: xxx@xxx.xxx)" 
                                       pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)"></td>
                        </tr>
                        <!--<button class="btn btn-info" type="button" name="add_inputm" id="add_inputm">Πρόσθεσε Συμμετέχοντες</button>-->
                    </table>
                    <button class="btn btn-info" type="button" name="add_inputm" id="add_inputm">Πρόσθεσε Συμμετέχοντες</button>
                </div>
            </div>
        </div>

        <br/>

        <div class="form-group">
            <div class="form-group col-sm-6">
                <input type="submit" name="submit" id="submit" value="Register" class="btn btn-primary btn-lg col-sm-offset-1" tabindex="7">
            </div>
        </div>

    </div>


</form>

</div>

<?php
try {
    if (isset($_POST['submit'])) {
        $datecount = count($_POST["date"]);
        $mailcount = count($_POST["email"]);
        $userid = $_SESSION['uid'];
        $title = $_POST['title'];
        $location = $_POST['location'];
        $perigrafi = $_POST['perigrafi'];

        if ($title == "" || $location == "" || $perigrafi == "") {
            echo '<script>window.alert("Συμπλήρωσε όλα τα πεδία");</script>';
        } else {
            $stmt = $conn->prepare("SELECT title FROM events WHERE title=:title AND user_id=:user_id");
            $stmt->bindParam(":title", $title, PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
            $stmt->execute();
            $register = $stmt->rowCount();
            if ($register > 0) {
                echo '<script>window.alert("Ο συγκεκριμένος τίτλος υπάρχει ήδη!");</script>';
            } else {
                $conn->exec("INSERT INTO events (user_id,title,perigrafi,location) VALUES ('" . $userid . "','" . $title . "','" . $perigrafi . "','" . $location . "')");
                $q = $conn->query("SELECT id_event FROM events ORDER BY id_event DESC LIMIT 1");
                $eventid = $q->fetchColumn();
            }
            if ($datecount > 0) {
                for ($i = 0; $i < $datecount; $i++) {
                    if (trim($_POST["date"][$i] != '')) {
                        $conn->exec("INSERT INTO event_day_time (id_event,day,time,vote) VALUES ('" . $eventid . "','" . $_POST["date"][$i] . "','" . $_POST["time"][$i] . "','0')");
                    } else {
                        echo '<script>window.alert("Συμπλήρωσε όλα τα πεδία!")</script>';
                    }
                }
            }
            if ($mailcount > 0) {
                for ($m = 0; $m < $mailcount; $m++) {
                    if (trim($_POST["email"][$m] != '')) {
                        $conn->exec("INSERT INTO participants (user_id,email,id_event) VALUES ('" . $userid . "','" . $_POST["email"][$m] . "','" . $eventid . "')");
                        $to = ($_POST["email"][$m]);
                        $subject = 'Πρόσκληση σε νέο meeting';
                        $message = '<div><p>Έχετε πρόσκληση για συμμετοχή σε καινούριο meeting</p>
                                         <p>Πατήστε <a href="https://wwwwimsgr.000webhostapp.com">εδώ</a> για να μεταβείτε στο Wims</p>
                                    </div></body></html>';
                        $headers = 'MIME-Version:1.0' . "r\n" .
                                'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
                                'From: wimsmeetings@gmail.com' . "\r\n" .
                                'Reply-To: webmaster@example.com' . "\r\n" .
                                'X-Mailer: PHP/' . phpversion();
                        mail($to, $subject, $message, $headers);
                        
                    } else {
                        echo '<script>window.alert("Δώσε το Email!")</script>';
                    }
                } echo '<script>window.alert("Το Email εστάλη!")</script>';
            }
        }
    } else {
        
    }
} catch (PDOException $e) {
    echo '{"error1":{"text":' . $e->getMessage() . '}}';
}
?>

</body>
</html>

<?php
include("footer.php");
?>
