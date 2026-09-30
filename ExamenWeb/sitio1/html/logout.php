<?php
session_name("StarWarsCookie");
session_start();
session_destroy();
header("Location: index.php");
exit();
?>