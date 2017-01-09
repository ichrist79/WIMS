<?php

class Meeting {

    private $id_event, $user_id, $title, $perigrafi, $location, $active;

    public function __construct($dbRow) {
        $this->id_event = $dbRow['id_event'];
        $this->user_id = $dbRow['user_id'];
        $this->title = $dbRow['title'];
        $this->perigrafi = $dbRow['perigrafi'];
        $this->location = $dbRow['location'];
        $this->active = $dbRow['active'];
    }

    public function getActiveId() {
        return $this->id_event;
    }

    public function getActiveUserId() {
        return $this->user_id;
    }

    public function getActiveTitle() {
        return $this->title;
    }

    public function getActivePerigrafi() {
        return $this->perigrafi;
    }

    public function getActiveLocation() {
        return $this->location;
    }

    public function getActiveActive() {
        return $this->active;
    }

}

?>