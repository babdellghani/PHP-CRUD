<?php
    $dsn = 'mysql:host=localhost;dbname=project1';
    $user = 'root';
    $pass = '';
    $options = [
        PDO::MYSQL_ATTR_COMPRESS => "SET NAMES utf8"
    ];

    try {
        $db = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        die();
    }
?>
