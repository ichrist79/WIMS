<?php

class Participants {

    private $id, $user_id, $email, $id_event;

    public function __construct($dbRow) {
        $this->id = $dbRow['id'];
        $this->user_id = $dbRow['user_id'];
        $this->email = $dbRow['email'];
        $this->id_event = $dbRow['id_event'];
    }

    public function getParticipantsId() {
        return $this->id;
    }

    public function getParticipantCreatorId() {
        return $this->user_id;
    }

    public function getParticipantEmail() {
        return $this->email;
    }

    public function getParticipantIdEvent() {
        return $this->id_event;
    }

}
?>

