
<?php
session_start();

// Menghapus seluruh data session.
session_unset();

// Mengakhiri session.
session_destroy();

// Kembali ke halaman login.
header("Location: login.php");
exit;
?>
