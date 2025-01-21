<?php
session_start();
session_unset();
session_destroy();
header('Location: /'); // Arahkan kembali ke halaman login setelah logout
exit;
?>
