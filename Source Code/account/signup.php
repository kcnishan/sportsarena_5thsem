<?php
    require_once '../core/init.php';

    include 'includes/head.php';
    //include 'includes/navigation1.php';
    //echo $_SESSION['SBUser'];
       
    //if(isset($_GET['add'])){
        $name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
        $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
        $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
        $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
        $address = ((isset($_POST['address']))?sanitize($_POST['address']):'');
        $phone = ((isset($_POST['phone']))?sanitize($_POST['phone']):'');
        $permissions = 'customer';
        
      //$permissions = ((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');
        $errors = array();
        if($_POST){
            $emailQuery = $db->query("SELECT * FROM users WHERE email = '$email'");
            $emailCount = mysqli_num_rows($emailQuery);
            
            if($emailCount != 0){
                $errors[] = 'That email already exists in our database.';
            }
            
            $required = array('name','email','password','confirm','address','phone');
            foreach($required as $f){
                if(empty($_POST[$f])){
                    $errors[] = 'You must fill out all fields.';
                    break;
                }
            }
            if(strlen($password) < 6){
                $errors[] = 'Your password must be at least 6 characters.';
            }
            
             if($password != $confirm){
                $errors[] = 'Your password does not match';
            }
            
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errors[] = 'You must enter a valid email';
            }
            
            
            
            if(!empty($errors)){
                echo display_errors($errors);
            }else{
                //add user to database
                $db->query("INSERT INTO users (full_name,email,password,address,phone,permissions) VALUES ('$name','$email','$password','$address','$phone','$permissions')");
                $_SESSION['success_flash'] = 'Customer has been added!';
                header('Location: /SportsArena/index.php');
            }
            
           
        }
        ?>
        <!-- Sign Up Form -->
<h2 class="text-center">Sign Up</h2><hr>
    <form action ="signup.php" method="post">
        <div class="form-group col-md-6">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" class="form-control" value="<?=$email;?>">
        </div>
        <div class="form-group col-md-6">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
        </div>
        <div class="form-group col-md-6">
            <label for="confirm">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
        </div>
        <div class="form-group col-md-6">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" class="form-control" value="<?=$address;?>">
        </div>
        <div class="form-group col-md-6">
            <label for="phone">Phone Number:</label>
            <input type="text"  pattern="^[0-9]+$" name="phone" id="phone" class="form-control" value="<?=$phone;?>">
        </div>
 
        <div class="form-group col-md-6 text-right" style="margin-top:25px;">
            <a href="/SportsArena/index.php" class="btn btn-default">Back</a>
            <input type="submit" value="Sign Up" class="btn btn-primary">
        </div>
    </form>

      <?php  include 'includes/footer.php'; ?>


