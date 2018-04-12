<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/SportsArena/core/init.php';
    //require_once '../passwordLib.php';
   // require_once '../passwordLibClass.php';
    include 'includes/head.php';  
    
    
    $email = ((isset($_POST['email']))?  sanitize($_POST['email']):'');
    $email = trim($email);
    $password = ((isset($_POST['password']))? sanitize($_POST['password']):'');
    $password = trim($password);
    //$hashed = password_hash($password,PASSWORD_DEFAULT);
    $errors = array();
?>

<style>
    body{
        background-image: url("/SportsArena/images/login_back.jpg")
        
    }
</style>



<div id ="login-form">
    <div>
        <?php
            if($_POST){
                //form validation
                if(empty($_POST['email']) || empty($_POST['password'])){
                    $errors[] = 'You must provide email and password';
                }
                //validate email
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $errors[] = 'You must enter a valid email';
                }
                
                //password is more than 6 chars
                if(strlen($password) < 6){
                    $errors[] = 'Your password must be at least 6 characters';
                }
                
                //check if email exists in the database
                $query = $db->query("SELECT * FROM users WHERE email = '$email'");
                $user = mysqli_fetch_assoc($query);
                $userCount = mysqli_num_rows($query);
                if($userCount < 1){
                   $errors[] = 'That email doesnt exist in our database';
                }
                
                //if(!password_verify($password,$user['password'])){
                if($password != $user['password']){
                    $errors[] = 'The password doesnt match our records.';
                }
                
                if(!empty($errors)){
                    echo display_errors($errors);
                }else{
                    //log user in
                    //echo 'Log user in!';  
                    $user_id = $user['id'];
                    $_permissions = $user['permissions'];
                    $user_email = $user['email'];
                    //echo $_permissions;
                    //echo $user_id;
                    /*
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
                            items TEXT,
                            expire_date DATETIME,
                            paid TINYINT(11) default 0
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
                            //$cart_id = $fetch['id'];
                            $get_id = $fetch['id'];
                            getID($get_id);*//*

                        }

                        } */
                    
                    //login($user_id,$_permissions,$user_email,$msg);
                    login($user_id,$_permissions,$user_email);
                }
            }
        //session is stored in server side
        ?> 
        
    </div>
    <h2 class="text-center">Login</h2><hr>
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name ="email" id="email" class="form-control" value="<?=$email; ?>"
        </div><br>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name ="password" id="password" class="form-control" value="<?=$password; ?>"
        </div><br>
        <div class="form-group">
            <input type="submit" value="Login" class="btn btn-primary">
        </div>
            
    </form>
    <p class="text-right"><a href="/SportsArena/index.php" alt="home">Visit Site</a></p>
</div>

<?php include 'includes/footer.php'; ?>

