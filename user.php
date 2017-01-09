<?php

class User {

    private $user_id, $first_name, $last_name, $display_name, $email;

    public function __construct($dbRow) {
        $this->user_id = $dbRow['user_id'];
        $this->first_name = $dbRow['first_name'];
        $this->last_name = $dbRow['last_name'];
        $this->display_name = $dbRow['display_name'];
        $this->email = $dbRow['email'];
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getUserFirstName() {
        return $this->first_name;
    }

    public function getUserLastName() {
        return $this->last_name;
    }

    public function getUserDisplayName() {
        return $this->display_name;
    }

    public function getUserEmail() {
        return $this->email;
    }

}
?>

