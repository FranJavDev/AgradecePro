<?php
session_start();
session_destroy();
header("Location: login.html");
exit();
?>
// AVISO!!!! Logout de ejemplo, falta desarrollo