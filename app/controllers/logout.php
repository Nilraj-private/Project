<?php
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header("Location: ../views/auth/login.php");
exit();
