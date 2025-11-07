<?php
session_start();

// Hapus Semua Session
$_SESSION = [];
session_unset();
session_destroy();


Header("Location: index.php");
exit;

?>