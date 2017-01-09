<?php

session_start();
include 'functions.php';

$countvote = count($_POST['voteArray']);
$idevent = $_POST['idEvent'];
$uid = $_SESSION['uid'];

$db = new Database("localhost", "root", "", "wimsfinal");

for ($i = 0; $i < $countvote; $i++) {

    $db->setMeetingsVote("INSERT into event_vote (id_event,id_event_day,user_id) VALUES ('" . $_POST['idEvent'][$i] . "','" . $_POST['voteArray'][$i] . "','" . $uid . "')");
    $db->setMeetingsDate("UPDATE event_day_time SET vote = vote + 1 WHERE id= '" . $_POST['voteArray'][$i] . "'");
}

header("Location: meetings.php");
?>

