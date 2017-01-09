<?php

class MeetingDate {

    private $id, $id_event, $day, $time, $vote;

    public function __construct($dbRow) {
        $this->id = $dbRow['id'];
        $this->id_event = $dbRow['id_event'];
        $this->day = $dbRow['day'];
        $this->time = $dbRow['time'];
        $this->vote = $dbRow['vote'];
    }

    public function getMeetingDateId() {
        return $this->id;
    }

    public function getMeetingDateIdEvent() {
        return $this->id_event;
    }

    public function getMeetingDateDay() {
        return $this->day;
    }

    public function getMeetingDateTime() {
        return $this->time;
    }

    public function getMeetingDateVote() {
        return $this->vote;
    }

}
