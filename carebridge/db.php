<?php
    session_start();

    try {
        $conn = new PDO('mysql:host=localhost;dbname=carebridge;charset=utf8mb4', 'root', '');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Hello:" . $e->getMessage();
    }

    function redirectMessage($url, $messageKey, $message) {
        header("location: $url?$messageKey=" . urlencode($message));
        exit();
    }