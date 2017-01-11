<?php

session_start();
include 'functions.php';
$db = new Database("localhost", "root", "", "wimsfinaldatabase");
$id_event = $_POST['id_event'];
$user_id = $_SESSION['uid'];

$stmt = $conn->prepare("SELECT MAX(vote) AS MaxVote FROM `event_day_time` WHERE id_event = '" . $id_event . "'");
$stmt->execute();
$vote = $stmt->fetchColumn();

$stmt1 = $conn->prepare("SELECT title FROM `events` WHERE id_event = '" . $id_event . "' ");
$stmt1->execute();
$title = $stmt1->fetchColumn();

$dataSet = $db->getMeetingsDate("SELECT * FROM `event_day_time` WHERE vote= '" . $vote . "' AND id_event= '" . $id_event . "' ");
echo '<table cellpadding="0" cellspacing="0" class="table table-hover table-responsive">';
echo '<tr class="success"><th><span class="glyphicon glyphicon-pushpin"></span>&nbsp;Τίτλος Meeting</th><th><span class="glyphicon glyphicon-calendar"></span>&nbsp;Ημερομηνία</th><th><span class="glyphicon glyphicon-time"></span>&nbsp;Ώρα</th><th><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;Σύνολο Ψήφων</th></tr>';
foreach ($dataSet as $data) {
    echo '<tr class="info">';
    echo '<td>', $title, '</td>';
    echo '<td>', $data->getMeetingDateDay(), '</td>';
    echo '<td>', $data->getMeetingDateTime(), '</td>';
    echo '<td>', $data->getMeetingDateVote(), '</td>';
    echo '</tr>';
}
?>
