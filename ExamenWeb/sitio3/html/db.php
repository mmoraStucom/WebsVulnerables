<?php
$conn = new mysqli("db3", "root", "root_pass_examen3", "enterprise");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
