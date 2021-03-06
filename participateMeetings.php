<?php

session_start();
include 'functions.php';
$db = new Database("localhost", "root", "", "wimsfinaldatabase");
$user_id = $_SESSION['uid'];

$dataSet = $db->getUser("SELECT * FROM `user` WHERE user_id = " . $user_id);
foreach ($dataSet as $data) {
    $email = $data->getUserEmail();
}

$dataSet3 = $db->getMeetings("SELECT * FROM `events` WHERE user_id = '" . $user_id . "' AND active = '1' ");
if ($dataSet3) {
    foreach ($dataSet3 as $data3) {
        $id_event2 = $data3->getActiveId();
        $stmt4 = $conn->prepare("SELECT title,location FROM `events` WHERE id_event = '" . $id_event2 . "'");
        $stmt4->execute();
        $get_title_location = $stmt4->fetch(PDO::FETCH_ASSOC);
        $title1 = $get_title_location['title'];
        $location1 = $get_title_location['location'];
        $stmt3 = $conn->prepare("SELECT MAX(vote) AS MaxVote FROM `event_day_time` WHERE id_event = '" . $id_event2 . "' ");
        $stmt3->execute();
        $vote2 = $stmt3->fetchColumn();
        $dataSet4 = $db->getMeetingsDate("SELECT * FROM `event_day_time` WHERE vote= '" . $vote2 . "' AND id_event= '" . $id_event2 . "' LIMIT 1 ");
        foreach ($dataSet4 as $data4) {
            echo '<table cellpadding="0" cellspacing="0" class="table table-hover table-responsive">';
            echo '<tr class="success"><th><span class="glyphicon glyphicon-pushpin"></span>&nbsp;Τίτλος Meeting</th><th><span class="glyphicon glyphicon-calendar"></span>&nbsp;Ημερομηνία</th><th><span class="glyphicon glyphicon-time"></span>&nbsp;Ώρα</th><th><span class="glyphicon glyphicon-map-marker"></span>&nbsp;Τοποθεσία</th></tr>';
            echo '<tr class="info">';
            echo '<td style="width:25%">', $title1, '</td>';
            echo '<td style="width:25%">', $data4->getMeetingDateDay(), '</td>';
            echo '<td style="width:25%">', $data4->getMeetingDateTime(), '</td>';
            echo '<td style="width:25%">', $location1, '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}

$dataSet1 = $db->getParticipants("SELECT * FROM `participants` WHERE email = '" . $email . "'");
if ($dataSet1) {
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
                echo '<table cellpadding="0" cellspacing="0" class="table table-hover table-responsive">';
                echo '<tr class="success"><th><span class="glyphicon glyphicon-pushpin"></span>&nbsp;Τίτλος Meeting</th><th><span class="glyphicon glyphicon-calendar"></span>&nbsp;Ημερομηνία</th><th><span class="glyphicon glyphicon-time"></span>&nbsp;Ώρα</th><th><span class="glyphicon glyphicon-map-marker"></span>&nbsp;Τοποθεσία</th></tr>';
                echo '<tr class="info">';
                echo '<td style="width:25%">', $title, '</td>';
                echo '<td style="width:25%">', $data2->getMeetingDateDay(), '</td>';
                echo '<td style="width:25%">', $data2->getMeetingDateTime(), '</td>';
                echo '<td style="width:25%">', $location, '</td>';
                echo '</tr>';
            }
        }
        echo '</table>';
    }
} else if(!($dataSet3)){
    ?>
    <p class="text-center">Δεν υπάρχει meeting για να παρουσιαστείτε εως τώρα</p>
    <?php

}
?>