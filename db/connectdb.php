<?php
require_once('../config/db.php');
function connectdb() {
    global $dbserver, $dbuser, $dbpass, $dbname;
    $conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>