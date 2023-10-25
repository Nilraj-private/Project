<?php 

if (!isset($_SESSION['user_id'])) {
    header("Location: app/views/auth/login.php");
}else{
    header("Location: app/views/dashboard.php");
}
