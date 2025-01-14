<?php
session_start();
session_unset();
session_destroy();
header('Location: /sdbpkad/'); // Arahkan kembali ke halaman login setelah logout
exit;
?>
