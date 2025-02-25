<?php 
session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie("id", $row["id"], time()+3600);
setcookie("key", hash("sha256", $row["username"]), time()+3600);

header("Location: login.php");
exit;
?>