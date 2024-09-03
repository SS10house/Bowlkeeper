<?php
$database_file = __DIR__ . '/bkmaster.db';

try {
    $conn = new PDO('sqlite:' . $database_file);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>