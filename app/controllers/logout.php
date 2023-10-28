<?php
session_start();
session_destroy(); // Destroy the session
header("Location: ../views/auth/login.php");
exit();
