<?php
$host = 'db.pxxl.pro'; // or 127.0.0.1
$db   = 'db_60f15c91';
$user = 'user_1c8dc49b';
$pass = 'e37313a8feb1ce82901db17c38f6e2c1'; // replace this with your actual password
$port = '10953'; // default PostgreSQL port

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    // Set error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optional: set default fetch mode to associative array
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
