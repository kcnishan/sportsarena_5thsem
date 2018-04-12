<?php

$db = mysqli_connect('127.0.0.1','root','','sports');

if(mysqli_connect_errno())
{
    echo 'Database connection failed with following errors :'. mysqli_connect_error();
    die();
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/SportsArena/config.php';
require_once BASEURL.'helpers/helpers.php';
//require_once '/SportsArena/helpers/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/SportsArena/helpers/helpers.php';

$cart_id = '';
if(isset($_COOKIE[CART_COOKIE])){
    $cart_id = sanitize($_COOKIE[CART_COOKIE]);
    //$cart_id = 1;
    //$cart_id = $db->query("SELECT id FROM $cust_table_name");
}

$new_id = '';
function getID($cust_id){
$new_id = $cust_id;
}

if(isset($_SESSION['SBUser'])){
    $user_id = $_SESSION['SBUser'];
    $query = $db->query("SELECT * FROM users WHERE id = '$user_id'");
    $user_data = mysqli_fetch_assoc($query);
    $fn = explode(' ',$user_data['full_name']);
    //$_permissions = $user_data['permissions'];
    $user_data['first'] = $fn[0];
    $user_data['last'] = $fn[1];
    
    $name_extract = explode('@', $user_data['email']);
    $cust_table_name = $name_extract[0];
    //$cart_id = $db->query("SELECT id FROM $cust_table_name");
}

if(isset($_SESSION['success_flash'])){
    echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
    unset($_SESSION['success_flash']);
}

if(isset($_SESSION['error_flash'])){
    echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['error_flash'].'</p></div>';
    unset($_SESSION['error_flash']);
}

//session_destroy();



