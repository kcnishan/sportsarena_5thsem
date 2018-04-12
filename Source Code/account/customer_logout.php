<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/SportsArena/core/init.php';
    unset($_SESSION['SBUser']);
    $user_status = 'not logged in';
    $db->query("UPDATE users SET status = '$user_status' WHERE id = '$user_id'");
    $cart_user_status = 'not logged in';
    $db->query("UPDATE $cust_table_name SET status = '$cart_user_status' WHERE status = 'logged in'");
    setcookie(CART_COOKIE,'',1,"/",$domain,false);
    //$cart_id = '';
    //$permissions = 'customer';
    header('Location: /SportsArena/index.php');
    
    
?>
