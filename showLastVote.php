<?php

session_start();
include 'functions.php';
$db = new Database("localhost", "root", "", "wimsfinal");
$id_event = $_POST['id_event'];
$user_id = $_SESSION['uid'];

$stmt1 = $conn->prepare("UPDATE events SET active=1 WHERE id_event = '" . $id_event . "' ");
$stmt1->execute();

$dataSet = $db->getParticipants("SELECT * FROM `participants` WHERE id_event = '" . $id_event . "' ");
foreach ($dataSet as $data) {
    $email[] = $data->getParticipantEmail();
}

$dataSet1 = $db->getMeetings("SELECT * FROM `events` WHERE id_event = '" . $id_event . "' ");
foreach ($dataSet1 as $data1) {
    $title = $data1->getActiveTitle();
}

for ($i = 0; $i < count($email); $i++) {
    $to = ($email[$i]);
    $subject = 'the subject';
    $message = '<div><p>Η ψηφοφορία για το meeting με τίτλο: <strong>' . $title . '</strong> έχει ολοκληρωθεί</p>
                                         <p>Πατήστε <a href="https://wwwwimsgr.000webhostapp.com">εδώ</a> για να μεταβείτε στο Wims</p>
                                    </div></body></html>';
    $headers = 'MIME-Version:1.0' . "r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'From: wimsmeetings@gmail.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $message, $headers);
}

echo '<script>window.alert("Η ψηφοφορία ολοκληρώθηκε! Οι συμμετέχοντες έχουν ενημερωθεί");</script>';
echo "<meta http-equiv='refresh' content='0'>";
?>

