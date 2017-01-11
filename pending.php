<?php

session_start();
include 'functions.php';
$db = new Database("localhost", "root", "", "wimsfinaldatabase");
$user_id = $_SESSION['uid'];
$stmt = $conn->prepare("SELECT email FROM user WHERE user_id = '" . $user_id . "'");
$stmt->bindParam("user_id", $user_id, PDO::PARAM_STR);
$stmt->execute();
$count = $stmt->rowCount();
if ($count == 1) {
    $get_mail = $stmt->fetch(PDO::FETCH_ASSOC);
    $email = $get_mail['email'];
}
$stmt = $conn->prepare("SELECT id_event,user_id FROM participants WHERE email = '" . $email . "'");
$stmt->bindParam("email", $email, PDO::PARAM_STR);
$stmt->execute();
$count1 = $stmt->rowCount();

if ($count1 > 0) {
    echo '<table cellpadding="0" cellspacing="0" class="table table-hover table-responsive">';
    echo '<tr class="success"><th><span class="glyphicon glyphicon-user"></span>&nbsp; Meeting του χρήστη...</th><th><span class="glyphicon glyphicon-pushpin"></span>&nbsp; Τίτλος</th><th><span class="glyphicon glyphicon-comment"></span>&nbsp; Περιγραφή</th><th><span class="glyphicon glyphicon-map-marker"></span>&nbsp; Τοποθεσία</th><th><span class="glyphicon glyphicon-wrench"></span>&nbsp; Options<th><span class="glyphicon glyphicon-asterisk"></span>&nbsp; Extra</th></tr>';
    for ($i = 0; $i < $count1; $i++) {
        $get_id_event = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_event = $get_id_event['id_event'];
        $user_id_creator = $get_id_event['user_id'];
        $stmt1 = $conn->prepare("SELECT display_name FROM user WHERE user_id = '" . $user_id_creator . "'");
        $stmt1->bindParam("user_id", $user_id_creator, PDO::PARAM_STR);
        $stmt1->execute();
        $get_display_name = $stmt1->fetch(PDO::FETCH_ASSOC);
        $display_name = $get_display_name['display_name'];
        $dataSet = $db->getMeetings("SELECT * FROM `events` WHERE id_event = '" . $id_event . "'");

        if ($dataSet) {

            foreach ($dataSet as $data) {
                echo '<tr class="info">';
                echo '<td>', $display_name, '</td>';
                echo '<td>', $data->getActiveTitle(), '</td>';
                echo '<td>', $data->getActivePerigrafi(), '</td>';
                echo '<td>', $data->getActiveLocation(), '</td>';
                if ($data->getActiveActive() == 0) {
                    echo '<td><button class="btn btn-success" type="button" onClick="vote(' . $data->getActiveId() . ');" >Ψήφισε</button>';
                    echo '<td><button class="btn btn-info" type="button" onClick="participate(' . $data->getActiveId() . ');" >Συμμετέχοντες</button>';
                } else if ($data->getActiveActive () == 1){
                    echo '<td><button class="btn btn-warning" type="button" disabled >Έχει ολοκληρωθεί</button>';
                    echo '<td><button class="btn btn-info" type="button" onClick="participate(' . $data->getActiveId() . ');" >Συμμετέχοντες</button>';
                }
                echo '</tr>';
            }
        }
    }
    echo '</table>';
} else {
    ?>
    <p class="text-center">Δεν έχετε κανένα meeting προς ψήφιση έως τώρα</p>
<?php }
?>
