<?php
    require_once '../core/init.php';

    if(!is_logged_in()){
        header('Location: login.php');
    }
    
    include 'includes/head.php';
    include 'includes/navigation1.php';
   // require_once '../includes/navigation.php';
    //include 'includes/footer.php';
    //echo $_SESSION['SBUser'];
    //session_destroy();
?>
<br> <br> <br>
Administrator Home


<?php include 'includes/footer.php'; ?>

