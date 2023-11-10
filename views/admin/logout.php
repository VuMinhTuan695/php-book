<?php
session_start();
unset($_SESSION['admin']['username']);
header("Refresh: 0.1; /book/views/admin/login.php", true, 303);
?>