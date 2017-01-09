

<?php
session_start();
include 'functions.php';
$db = new Database("localhost", "root", "", "wimsfinal");
$id_event = $_POST['id_event'];
$user_id = $_SESSION['uid'];


$dataSet = $db->getMeetingsDate("SELECT * FROM `event_day_time` WHERE id_event = " . $id_event);
$dataSet1 = $db->getMeetingsVote("SELECT * FROM `event_vote` WHERE user_id = '" . $user_id . "' AND id_event = '" . $id_event . "' ");
if ($dataSet1) { // εάν υπάρχουν εγγραφές στον πίνακα event_vote (εάν έχει δηλαδή ψηφίσει ο χρήστης uid) 
    foreach ($dataSet1 as $data) { //τότε
        $dataSet11[] = $data->getMeetingVoteIdEventDay(); //γεμίζω τον dataSet11 με το id_event_day από τον event_vote
    }
} else {
    $dataSet11[] = []; // αλλιώς θα μείνει κενός
}
if ($dataSet) {
    ?>
    <form id="frm" action="saveVote.php" method="post">
        <?php
        echo '<table cellpadding="0" cellspacing="0" class="table table-hover">';
        echo '<tr><th>Ημερομηνία</th><th>Ώρα</th><th>Ψήφος</th></tr>';
        foreach ($dataSet as $data) {
            echo '<tr>';
            echo '<td>', $data->getMeetingDateDay(), '</td>';
            echo '<td>', $data->getMeetingDateTime(), '</td>';
            $data1 = $data->getMeetingDateId();
            if (!(in_array("$data1", $dataSet11))) { // εάν το id του πίνακα event_day_time είναι μέσα στον πίνακα dataSet11 
                echo '<td><input type="checkbox" name="voteArray[]" value="' . $data->getMeetingDateId() . '">';
            } else { //αλλιώς το κρύβει
                echo '<td>Το έχεις ψηφίσει</td>';
            }

            echo '<td><input type="hidden" name="idEvent[]" value="' . $data->getMeetingDateIdEvent() . '">';

            echo '</tr>';
        }
        echo '</table>';
        ?>
        <button class="btn btn-success" type="submit" name="formSubmit" id="frmSubmit" >Save</button>
    </form>
    <?php
} else
    echo 'lathos';
?>