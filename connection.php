<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=wims_database;', 'root', '');
    $db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed" . $e ->getMessage());
}
?>