<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/SportsArena/core/init.php';
    //require_once '/SportsArena/helpers/helpers.php';
    //include '/SportsArena/admin/products.php';
    $product_id = sanitize($_POST['product_id']);
    //$product_id = $product['id'];
    //echo $product['id'];
    $item_id = $product_id;
    $size = sanitize($_POST['size']);
    $available = sanitize($_POST['available']);
    $quantity = sanitize($_POST['quantity']);
    /*
    $item = array();
    $item[] = array(
        'id' => $product_id,
        'size' => $size,
        'quantity' => $quantity,
       );
     */
    
    $domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
/* @var $query type */
    $cquery = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
    $product = mysqli_fetch_assoc($cquery);
    //echo $product['title'];
    //$_SESSION['success_flash'] = $product_id. ' was added to your cart.';
    $_SESSION['success_flash'] = $product['title'].$user_data['email'].$cust_table_name. ' was added to your cart.';
    
    //check to see if the cart cookie exists
    //$new_id = $fetch['id'];
    /*
    if($cart_id != ''){
    //if($new_id != ''){
        //$cartQ = $db->query("SELECT * FROM $cust_table_name WHERE id = '{$cart_id}'");
        $cartQ = $db->query("SELECT * FROM $cust_table_name");
        while($cart = mysqli_fetch_assoc($cartQ)){     
        $previous_items = json_decode($cart['items'],true);
        $item_match = 0;      
        $new_items = array();
        foreach($previous_items as $pitem){
            if($item[0]['id'] == $pitem['id'] && $item[0]['size'] == $pitem['size']){
                $pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
                if($pitem['quantity'] > $available){
                    $pitem['quantity'] = $available;
                }
                $item_match = 1;
            }
            $new_items[] = $pitem;
        }
        if($item_match != 1){
            $new_items = array_merge($item,$previous_items);
        }
        
        $items_json = json_encode($new_items);
        $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
        //$cart_user_status = 'logged in';
        $db->query("UPDATE $cust_table_name SET items = '{$items_json}',expire_date = '{$cart_expire}'");
        //setcookie(CART_COOKIE,'',1,"/",$domain,false);
        setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
        }
    }else{
        //add the cart to the database and set cookie
        /*$items_json = json_encode($item);
        $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
        $cart_user_status = 'logged in';
        $db->query("INSERT INTO $cust_table_name (customer_name,status,items,expire_date) VALUES ('{$user_data['email']}','{$cart_user_status}','{$items_json}','{$cart_expire}')");
        //$db->query("UPDATE $cust_table_name SET customer_name = '{$user_data['email']}', status = '{$cart_user_status}', items = '{$items_json}',expire_date = '{$cart_expire}' WHERE id = '2'");
        $cart_id = $db->insert_id;
      
        setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
        //setcookie(CART_COOKIE,'',1,"/",$domain,false); */
              
     /*   
    } */
    
    $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
    $cart_user_status = 'logged in';
    $db->query("INSERT INTO $cust_table_name (customer_name,status,item_id,size,quantity,expire_date) VALUES ('{$user_data['email']}','{$cart_user_status}','{$item_id}','{$size}','{$quantity}','{$cart_expire}')");
    $cart_id = $db->insert_id;
    
    ?>
    

