<?php
/**
 * Connects to the database using PDO
 */

try {
    $connection = new PDO("mysql:host=your_host_name.com;dbname=your_db_name", "admin_user", "admin_password");
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $pdoe) {
    echo "<p>Connection failed: ".$pdoe->getMessage()."</p>";
}