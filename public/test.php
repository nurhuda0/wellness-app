<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=wellness_app', 'root', '');
    echo "Database connection successful!";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
