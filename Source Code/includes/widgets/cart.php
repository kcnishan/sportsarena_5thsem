<h3 class="text-center">Shopping Cart</h3>
<div>
    <?php //if(empty($cart_id)):
    $i = 1;
    if(customer_permission('customer')):
    $row = $db->query("SELECT COUNT(*) AS numm FROM $cust_table_name");
    $count = mysqli_fetch_assoc($row);
    $rows = $count['numm'];
    if ($rows == 0):
    ?>
        <p>Your Shopping Cart is Empty</p>
    <?php else: 
        $cartQ = $db->query("SELECT * FROM $cust_table_name");
        
    ?>
        <table class="table table-bordered table-condensed table-striped">
            <thead><th>#</th><th>Item</th><th>Size</th><th>Quantity</th></thead>
        <tbody>
            <tr>
            <?php
            $cartQ = $db->query("SELECT * FROM $cust_table_name");
            
            //$productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
            while($result = mysqli_fetch_assoc($cartQ)){
              $product_id = $result['item_id'];
              $productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
              $product = mysqli_fetch_assoc($productQ);
            ?>
                
                <td><?=$i;?></td>
                <td><?=$product['title']; ?></td>
                <td><?=$result['size']; ?></td>
                <td><?=$result['quantity']; ?></td>

            <tr></tr>
           
            </tr>                
            
            <?php 
                $i++;
                //$item_count += $result['quantity'];
            }
            ?>           
            
        </tbody>
        </table>
        <?php endif; ?>
    
    <?php else: ?>
        <p>Your Shopping Cart is Empty</p>
    <?php endif; ?>
</div>

