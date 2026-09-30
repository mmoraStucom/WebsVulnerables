<?php
//$conn = new mysqli("localhost", "root", "", "deathstar");
$conn = new mysqli("db1", "root", "root_pass_examen1", "deathstar");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
