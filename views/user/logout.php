<?php
session_start();
unset($_SESSION['user']['username']);
header("Refresh: 0.5; /book/index.php", true, 303);
?>