<?php

session_start();
include 'functions.php';
$db = new Database("localhost", "root", "", "wimsfinal");
$id_event = $_POST['id_event'];
$user_id = $_SESSION['uid'];

$dataSet = $db->getParticipants("SELECT * FROM `participants` WHERE id_event = " . $id_event);
foreach ($dataSet as $data) {
    $emailParticipants[] = $data->getParticipantEmail();
}

if ($dataSet) {
    echo '<table cellpadding="0" cellspacing="0" class="table table-hover">';
    echo '<tr><th>Συμμετέχοντες</th></tr>';
    for ($i = 0; $i < count($emailParticipants); $i++) {
        $dataSet1 = $db->getUser("SELECT * FROM `user` WHERE email ='" . $emailParticipants[$i] . "' ");
        foreach ($dataSet1 as $data1) {
            echo '<tr>';
            echo '<td class="text-info">', $data1->getUserDisplayName(), '</td>';
            echo '</tr>';
        }
    }
    echo '</table>';
}
?>