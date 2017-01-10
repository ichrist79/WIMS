<?php
$servername = "localhost";
$username = "root"; //"id155970_adix";
$password = ""; //"adix2016";
require ("meeting.php");
require ("meetingDate.php");
require ("user.php");
require ("meetingVote.php");
require ("participants.php");


try {
    $conn = new PDO("mysql:host=$servername;dbname=wimsfinal;charset=utf8", $username, $password); //dbname=id155970_wims
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

class Database {

    private $con;

    public function __construct($host, $username, $password, $database) {
        $this->con = new PDO("mysql:host=" . $host . ";dbname=" . $database . ";charset=utf8", $username, $password);
    }

    public function getMeetings($sql) {
        $statement = $this->con->prepare($sql);
        $statement->execute();
        while ($row = $statement->fetch()) {
            $dataset[] = new Meeting($row);
        }
        if (!empty($dataset))
            return $dataset;
        else {
            return null;
        }
    }

    public function getMeetingsDate($sql) {
        $statement = $this->con->prepare($sql);
        $statement->execute();
        while ($row = $statement->fetch()) {
            $dataset[] = new MeetingDate($row);
        }
        if (!empty($dataset))
            return $dataset;
        else {
            return null;
        }
    }

    public function getMeetingsVote($sql) {
        $statement = $this->con->prepare($sql);
        $statement->execute();
        while ($row = $statement->fetch()) {
            $dataset[] = new MeetingVote($row);
        }
        if (!empty($dataset))
            return $dataset;
        else {
            return null;
        }
    }

    public function getParticipants($sql) {
        $statement = $this->con->prepare($sql);
        $statement->execute();
        while ($row = $statement->fetch()) {
            $dataset[] = new Participants($row);
        }
        if (!empty($dataset))
            return $dataset;
        else {
            return null;
        }
    }

    public function getUser($sql) {
        $statement = $this->con->prepare($sql);
        $statement->execute();
        while ($row = $statement->fetch()) {
            $dataset[] = new User($row);
        }
        if (!empty($dataset))
            return $dataset;
        else {
            return null;
        }
    }

    public function setMeetingsVote($sql) {
        $this->con->exec($sql);
    }

    public function setMeetingsDate($sql) {
        $this->con->exec($sql);
    }

}
?>