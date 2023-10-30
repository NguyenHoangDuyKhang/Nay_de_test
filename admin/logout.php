<?php
    session_start();
    unset($_SESSION['admin']);
    unset($_SESSION['user']);
    unset($_SESSION['pass']);
    header('location: http://asm/admin/login_admin.php');
?>