<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/SportsArena/core/init.php';
    unset($_SESSION['SBUser']);
    $user_status = 'not logged in';
    $db->query("UPDATE users SET status = '$user_status' WHERE id = '$user_id'");
    header('Location: /SportsArena/index.php');
    
    
?>