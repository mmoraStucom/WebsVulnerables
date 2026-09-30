<?php
//$conn = new mysqli("localhost", "root", "", "mordor");
$conn = new mysqli("db2", "root", "root_pass_examen2", "mordor");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
