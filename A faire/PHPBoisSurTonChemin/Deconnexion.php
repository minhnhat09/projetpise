<?php
session_start();
session_unset();
session_destroy();

$URL = $_GET['source'];
header('Location: '.$URL.'');
exit();
?>