<?php

try {
    $db = new PDO(
        'mysql:host=mysql;dbname=test_task',
        'root',
        'secret',
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "ERROR: Could not connect to the database";
    die();
}
