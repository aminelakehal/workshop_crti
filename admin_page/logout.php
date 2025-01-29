<?php
 session_name('admin_session'); 
 session_start();
$_SESSION = [];
session_destroy();
header("Location: ./index.php");
exit();
?>
