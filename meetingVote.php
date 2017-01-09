<?php

class MeetingVote {

    private $id, $id_event, $id_event_day, $user_id;

    public function __construct($dbRow) {
        $this->id = $dbRow['id'];
        $this->id_event = $dbRow['id_event'];
        $this->id_event_day = $dbRow['id_event_day'];
        $this->user_id = $dbRow['user_id'];
    }

    public function getMeetingVoteId() {
        return $this->id;
    }

    public function getMeetingVoteIdEvent() {
        return $this->id_event;
    }

    public function getMeetingVoteIdEventDay() {
        return $this->id_event_day;
    }

    public function getMeetingVoteUser() {
        return $this->user_id;
    }

}
