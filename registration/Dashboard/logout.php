<?php
// Redirect to login page.
setcookie("login", "", time() - 3600, "/");
setcookie("email_", "", time() - 3600, "/");

header("Location: ../registration.php");
exit;
?>