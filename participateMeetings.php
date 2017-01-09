<?php

session_start();
include 'functions.php';
$db = new Database("localhost", "root", "", "wimsfinal");
$user_id = $_SESSION['uid'];

$dataSet = $db->getUser("SELECT * FROM `user` WHERE user_id = " . $user_id);
foreach ($dataSet as $data) {
    $email = $data->getUserEmail();
}

$dataSet1 = $db->getParticipants("SELECT * FROM `participants` WHERE email = '" . $email . "'");
foreach ($dataSet1 as $data1) {
    $id_event = $data1->getParticipantIdEvent();
    $stmt = $conn->prepare("SELECT active,location FROM `events` WHERE id_event = '" . $id_event . "'");
    $stmt->execute();
    $get_active_location = $stmt->fetch(PDO::FETCH_ASSOC);
    $active = $get_active_location['active'];
    $location = $get_active_location['location'];
    $stmt2 = $conn->prepare("SELECT MAX(vote) AS MaxVote FROM `event_day_time` WHERE id_event = '" . $id_event . "' AND '" . $active . "' = 1 ");
    $stmt2->execute();
    $vote = $stmt2->fetchColumn();
    $stmt1 = $conn->prepare("SELECT title FROM `events` WHERE id_event = '" . $id_event . "' AND '" . $active . "' = 1 ");
    $stmt1->execute();
    $title = $stmt1->fetchColumn();

    if ($active == 1) {
        $dataSet2 = $db->getMeetingsDate("SELECT * FROM `event_day_time` WHERE vote= '" . $vote . "' AND id_event= '" . $id_event . "' LIMIT 1");
        foreach ($dataSet2 as $data2) {
            echo '<table cellpadding="0" cellspacing="0" class="table table-hover">';
            echo '<tr><th>Τίτλος Meeting</th><th>Ημερομηνία</th><th>Ώρα</th><th>Τοποθεσία</th></tr>';
            echo '<tr>';
            echo '<td>', $title, '</td>';
            echo '<td>', $data2->getMeetingDateDay(), '</td>';
            echo '<td>', $data2->getMeetingDateTime(), '</td>';
            echo '<td style="width:25%">', $location, '</td>';
            echo '</tr>';
        }
    }
    echo '</table>';
}
?>