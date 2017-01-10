

<?php

session_start();
include 'functions.php';
$db = new Database("localhost", "root", "", "wimsfinal");
$user_id = $_SESSION['uid'];
$dataSet = $db->getMeetings("SELECT * FROM `events` WHERE user_id = " . $user_id);




if ($dataSet) {
    echo '<table cellpadding="0" cellspacing="0" class="table table-hover">';
    echo '<tr><th>Τίτλος</th><th>Περιγραφή</th><th>Τοποθεσία</th><th colspan="2" style="text-align:center;" >Επιλογές<th></tr>';
    foreach ($dataSet as $data) {

        echo '<tr>';
        echo '<td>', $data->getActiveTitle(), '</td>';
        echo '<td>', $data->getActivePerigrafi(), '</td>';
        echo '<td>', $data->getActiveLocation(), '</td>';
        if ($data->getActiveActive() == 1) {
            echo '<td><button class="btn btn-success" type="button" onClick="getFinal(' . $data->getActiveId() . ');" >Αποτελέσματα Ψηφοφορίας</button>
                  <button class="btn btn-warning" type="button" disabled" >Η ψηφοφορία ολοκληρώθηκε</button></td>';
        } else {
            echo '<td><button class="btn btn-success" type="button" onClick="getFinal(' . $data->getActiveId() . ');" >Αποτελέσματα Ψηφοφορίας</button>
                  <button class="btn btn-danger" type="button" onClick="stopVote(' . $data->getActiveId() . ');" >Ολοκλήρωση Ψηφοφορίας</button></td>';
        }
        echo '</tr>';
    }
    echo '</table>';
} else {
    ?>
    <p class="text-center">Δεν έχετε δημιουργήσει κανένα meeting εως τώρα</p>
<?php }
?>

