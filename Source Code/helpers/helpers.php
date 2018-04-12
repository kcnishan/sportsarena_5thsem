<?php
    //echo 'helpers';
    ini_set('max_execution_time', 30);
    require_once $_SERVER['DOCUMENT_ROOT'].'/SportsArena/core/init.php';
    global $db;
    global $email_user;

function display_errors($errors){
        $display = '<ul class = "bg-danger">';
        foreach ($errors as $error){
            $display .= '<li class="text-primary">'.$error.'</li>';
        }
        $display .= '</ul>';
        return $display;
    }
    
    function sanitize($dirty){
        return htmlentities($dirty,ENT_QUOTES,"UTF-8");
    }
    
    function money($number){
        return 'NRs.'.number_format($number,2);
    }
    
    function login($user_id,$_permissions,$user_email,$msg){
        //echo $_permissions;
        $_SESSION['SBUser'] = $user_id;
        global $db;
        $date = date("Y-m-d H:i:s");
        $user_status = 'logged in';
        $db->query("UPDATE users SET last_login = '$date', status = '$user_status' WHERE id = '$user_id'");        
       
        if($_permissions == 'customer'){
        $email_user = $user_email;
        $name_extract = explode('@', $user_email);
        $cust_table_name = $name_extract[0];
        $cart_user_status = 'logged in';
        //$db->query("UPDATE $cust_table_name SET status = '$cart_user_status'");
        
        //creating table
        $user = "root"; 
        $password = ""; 
        $host = "localhost"; 
        $dbase = "sports"; 

        $connection= mysql_connect($host, $user, $password);
        if (!$connection)
        {
        die ('Could not connect:' . mysql_error());
        }
        mysql_select_db($dbase, $connection);
        $conn = mysqli_connect($host, $user, $password, $dbase);
        //Code to see if Table Exists
        $exists = mysql_query("select 1 from $cust_table_name");

        if($exists == FALSE)
        {
            
            $sql = "CREATE TABLE $cust_table_name (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            customer_name VARCHAR(255) NOT NULL,
            status VARCHAR(255) NULL,
            item_id INT(11),
            size VARCHAR(255),
            quantity INT(11),
            expire_date DATETIME,
            paid TINYINT(11) default 0,
            grand_total FLOAT(20) default NULL
            )";
            
            

            if (mysqli_query($conn, $sql)) {
                $msg = "Table ".$cust_table_name." created successfully";
               
            } else {
                $msg = "Table MyGuests not created ";
               // echo "Error creating table: " . mysqli_error($conn);
            }
            
           //echo("This table exists");
        }else{
            $msg = "Table ".$cust_table_name." exists";
            /*$q = $db->query("SELECT * FROM $cust_table_name");
            $fetch = mysqli_fetch_assoc($q);
            $cart_id = $fetch['id'];*/
           
        }
        
        } 
        //echo $user['status'];
        //echo $user_id;
        $_SESSION['success_flash'] = 'You are now logged in! '.$msg;
        //$_SESSION['success_flash'] = $msg;
        if($_permissions == 'customer'){
        header('Location: /SportsArena/index.php');
        }
        else{
            header('Location: /SportsArena/admin/index.php');
        }
    }
    
    function is_logged_in(){
        if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0){
            return true;
        }
        return false;
    }
    
    function login_error_redirect($url = 'login.php'){
        $_SESSION['error_flash'] = 'You must be logged in to access this page';
        header('Location: '.$url);
    }
    
    function permission_error_redirect($url = 'login.php'){
        $_SESSION['error_flash'] = 'You don not have permission  to access this page';
        header('Location: '.$url);
    }

    function has_permission($permission = 'admin'){
        global $user_data;
        $permissions = explode(',', $user_data['permissions']);
        if(in_array($permission,$permissions,true)){
            return true;           
        }
        return false;
    }
    
    function customer_permission($permission = 'customer'){
        global $user_data;
        $permissions = explode(',',$user_data['permissions']);
        if(in_array($permission,$permissions,true)){
            return true;
        }
        return false;
    }
    
    function pretty_date($date){
        return date("M d, Y h:i A",  strtotime($date));
    }
    
    function get_category($child_id){
        global $db;
        $id = sanitize($child_id);
        $sql = "SELECT p.id AS 'pid',p.category AS 'parent',c.id AS 'cid',c.category AS 'child'
                FROM categories c
                INNER JOIN categories p
                ON c.parent = p.id
                WHERE c.id = '$id'";
        $query = $db->query($sql);
        $category = mysqli_fetch_assoc($query);
        return $category;
    }