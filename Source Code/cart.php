<?php
  require_once 'core/init.php';
  include 'includes/head.php';
  include 'includes/navigation.php';
  //include 'payments.php';
  //include 'includes/headerpartial.php';
  //$cart_id = '';
  /*
  $confirm = 'not confirmed';
  $user = "root"; 
  $password = ""; 
  $host = "localhost"; 
  $dbase = "sports"; 

  $conn= mysqli_connect($host, $user, $password, $dbase);
  //$new_id = $fetch['id'];
  $query = "SELECT description FROM $cust_table_name";
  //$result = mysqli_query($dbc, $query);
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
   */
  /*
  $query = "SELECT COUNT(*) FROM $cust_table_name";
  $result = mysql_query($query);
  //$rows = mysql_result(mysql_query($query), 0);
  $rows = mysql_fetch_array(mysql_query($query));
  */
  $row = $db->query("SELECT COUNT(*) AS numm FROM $cust_table_name");
  $count = mysqli_fetch_assoc($row);
  $rows = $count['numm'];
  //echo (int)$rows;
  //$rows = $rowss->num_rows;
  //echo $rows;
  //echo $numm;
  //if(!empty($row['description'])){
  //if($cart_id != ''){
  //if($new_id != ''){
  if ($rows != 0) {
      //$cartQ = $db->query("SELECT * FROM $cust_table_name  WHERE id = '{$cart_id}'");
      $cartQ = $db->query("SELECT * FROM $cust_table_name");
      //while($result = mysqli_fetch_assoc($cartQ)){
      //$items = json_decode($result['items'],true); //force to decode as an associative array rather than returning any sort of object
      //}
      $i = 1;
      $sub_total = 0;
      $item_count = 0;
      }
  
      
?>



<div class="col-md-12">
    <div class="row">
        <h2 class="text-center">My Shopping Cart</h2><hr>
        <?php //if($cart_id == ''){
        //if(empty($row['description'])){
        if($rows == 0){
        //if($new_id == ''):?>
        <div class="bg-danger">
            <p class="text-center text-danger">
                Your Shopping Cart is empty!
            </p>
        </div>
        <?php }else{
            $cartQ = $db->query("SELECT * FROM $cust_table_name");
            //while($result = mysqli_fetch_assoc($cartQ)){
            //$items = json_decode($result['items'],true);
        ?>
        <table class="table table-bordered table-condensed table-striped">
            <thead><th></th><th>#</th><th>Item</th><th>Price</th><th>Quantity</th><th>Size</th><th>Sub Total</th></thead>
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
                <td>
                    <!--<a href="products.php?delete=<?=$product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>-->
                    <button class="btn btn-xs btn-default" onclick="update_cart('removeone','<?=$result['id'];?>','<?=$result['size'];?>');"><span class="glyphicon glyphicon-remove"></span></button>
                </td>
                <td><?=$i;?></td>
                <td><?=$product['title']; ?></td>
                <td><?='NRs.'.$product['price']; ?></td>
                <td>
                  <!--  <button class="btn btn-xs btn-default" onclick="update_cart('removeone','<?=$product['id'];?>','<?=$result['size'];?>');">-</button> -->
                    
                <?=$result['quantity']; ?>
                    <!--
                    <?php if($item['quantity'] < $available){ ?>
                    <button class="btn btn-xs btn-default" onclick="update_cart('addone','<?=$product['id'];?>','<?=$result['size'];?>');">+</button>
                    <?php} else{ ?>
                    <span class="text-danger">Max</span>
                    <?php } ?>
                    -->
                </td>
                <td><?=$result['size']; ?></td>
                <td><?='NRs.'.$result['quantity'] * $product['price']; ?></td>
            <tr></tr>
           
            </tr>
                <!--foreach($items as $item){
                    $product_id = $item['id'];
                    $productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
                    $product = mysqli_fetch_assoc($productQ);
                    $sArray = explode(',',$product['sizes']);
                    foreach($sArray as $sizestring){
                        $s = explode(':',$sizestring);
                        if($s[0] == $item['size']){
                            $available = $s[1];
                            
                        }
                    }-->
            <!--
            <tr>
                <td><?=$i;?></td>
                <td><?=$product['title']; ?></td>
                <td><?='NRs.'.$product['price']; ?></td>
                <td>
                    <button class="btn btn-xs btn-default" onclick="update_cart('removeone','<?=$product['id'];?>','<?=$item['size'];?>');">-</button>
                    
                <?=$item['quantity']; ?>
                    <?php if($item['quantity'] < $available){ ?>
                    <button class="btn btn-xs btn-default" onclick="update_cart('addone','<?=$product['id'];?>','<?=$item['size'];?>');">+</button>
                    <?php} else{ ?>
                    <span class="text-danger">Max</span>
                    <?php } ?>
                </td>
                <td><?=$item['size']; ?></td>
                <td><?='NRs.'.$item['quantity'] * $product['price']; ?></td>
            </tr> -->
            <?php 
                $i++;
                $item_count += $result['quantity'];
                $sub_total += ($product['price'] * $result['quantity']);
            }
        
        
            $tax = TAXRATE * $sub_total;
            $tax = number_format($tax,2);
            $grand_total = $tax + $sub_total;
            //$GLOBALS['total'] = $GLOBALS['grand_total'];
            $db->query("UPDATE users SET total = '$grand_total' WHERE status = 'logged in'");
           
            //$_SESSION['total'] = $grand_total;   
            
            
            ?>
            
            <?php 
            /*
                $i++;
                $item_count += $item['quantity'];
                $sub_total += ($product['price'] * $item['quantity']);
            }
        
        
            $tax = TAXRATE * $sub_total;
            $tax = number_format($tax,2);
            $grand_total = $tax + $sub_total;
            */
            ?> 
            
        </tbody>
        </table>
        <table class="table table-bordered table-condensed text-right">
            <legend>Totals</legend>
            <thead class="totals-table-header"><th>Total Items</th><th>Sub Total</th><th>Tax</th><th>Grand Total</th></thead>
        <tbody>
            <tr>
                <td><?=$item_count; ?></td>
                <td><?='NRs.'.$sub_total; ?></td>
                <td><?='NRs.'.$tax;?></td>
                <td class="bg-success"><?='NRs.'.$grand_total;?></td>
                
            </tr>
        </tbody>
        </table>
<!-- Check Button New -->
<form class="paypal" action="payments.php" method="post" id="paypal_form" target="_blank">
		<input type="hidden" name="cmd" value="_xclick" />
		<input type="hidden" name="no_note" value="1" />
		<input type="hidden" name="lc" value="UK" />
		<input type="hidden" name="currency_code" value="GBP" />
		<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
		<input type="hidden" name="first_name" value="Customer's First Name" />
		<input type="hidden" name="last_name" value="Customer's Last Name" />
		<input type="hidden" name="payer_email" value="customer@example.com" />
		<input type="hidden" name="item_number" value="123456" />                
                <button type="submit" name="submit" class="btn btn-primary pull-right" >
                    <span class="glyphicon glyphicon-shopping-cart"></span>  Check Out >>
                </button>
                
	</form>
        
<!-- Check Out Button -->
<!--
<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#checkoutModal">
    <span class="glyphicon glyphicon-shopping-cart"></span>  Check Out >>
</button>
-->
<!-- Modal -->
<!--
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="checkoutModalLabel">Shipping Address</h4>
      </div>
      <div class="modal-body">
          <div class="row">
          <form action="thankYou.php" method="post" id="payment-form">
              <span class="bg-danger" id="payment-errors"></span>
              <div id="step1" style="display:block;">
                  <div class="form-group col-md-6">
                      <label for="full_name">Full Name*:</label>
                      <input class="form-control" id="full_name" name="full_name" type="text">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="email">Email*:</label>
                      <input class="form-control" id="email" name="email" type="email">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="street">Street Address*:</label>
                      <input class="form-control" id="street" name="street" type="text">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="street2">Street Address 2:</label>
                      <input class="form-control" id="street2" name="street2" type="text">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="city">City*:</label>
                      <input class="form-control" id="city" name="city" type="text">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="state">State*:</label>
                      <input class="form-control" id="state" name="state" type="text">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="zip_code">Zip Code*:</label>
                      <input class="form-control" id="zip_code" name="zip_code" type="text">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="country">Country*:</label>
                      <input class="form-control" id="country" name="country" type="text">
                  </div>
                  
                  <button type="button" class="btn btn-primary" onclick="check_address();" id="checkout_button">Check Out >></button>
                  
                  <h4 class="modal-title" id="checkoutModalLabel">Card Details</h4
                  
                  <div class="form-group col-md-6">
                      <label for="name">Name on Card:</label>
                      <input type="text" id="name" class="form-control"> 
                  </div>
                  <div class="form-group col-md-2">
                      <label for="number">Card Number:</label>
                      <input type="text" id="number" class="form-control"> 
                  </div>
                   <div class="form-group col-md-2">
                      <label for="cvc">CVC:</label>
                      <input type="text" id="cvc" class="form-control"> 
                  </div>
                  <div class="form-group col-md-2">
                      <label for="exp-month">Expire Month:</label>
                      <select id="exp-month" class="form-control">
                          <option value=""></option>
                          <?php for($i=1;$i<13;$i++): ?>
                          <option value="<?=$i; ?>"><?=$i;?></option>
                          <?php endfor; ?>
                      </select>
                  </div>
                  <div class="form-group col-md-2">
                      <label for="exp-year">Expire Year:</label>
                      <select id="exp-year" class="form-control">
                          <option value=""></option>
                          <?php $yr = date("Y"); ?>
                          <?php for($i=0;$i<11;$i++):?>
                          <option value="<?=$yr+$i; ?>"><?=$yr+$i; ?></option>
                          <?php endfor; ?>
                      </select>
                  </div>
              </div>
          -->    
         <!-- </form> -->
         <!--
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>       
        <!--<button type="button" class="btn btn-primary" onclick="check_address();" id="next_button">Next >></button>
        <button type="button" class="btn btn-primary" onclick="back_address();" id="back_button" style="display:none"><< Back</button> -->
        <!--
            <?php if($confirm == 'confirmed'):?>
        <button type="submit" class="btn btn-primary" onclick="check_address();" id="checkout_button">Check Out >></button>
        <?php endif; ?>
        </form> 
      </div>
    </div>
  </div>
    -->
</div>
        
        <?php } ?>
        
    </div>
</div>

<!--
<script>
    function check_address(){
        var data = {
                    'full_name' : jQuery('#full_name').val(),
                    'email' : jQuery('#email').val(),
                    'street' : jQuery('#street').val(),
                    'street2' : jQuery('#street2').val(),
                    'city' : jQuery('#city').val(),
                    'state' : jQuery('#state').val(),
                    'zip_code' : jQuery('#zip_code').val(),
                    'country' : jQuery('#country').val(),
            };
            jQuery.ajax({
               url : '/SportsArena/admin/parsers/check_address.php',
               method : 'POST',
               data : data,
               success : function(data){
                   if(data !== 'passed'){
                       jQuery('#payment-errors').html(data);
                       
                   }
                   if(data === 'passed'){
                       jQuery('#payment-errors'.html(""));
                       jQuery('#step1').css("display","none");
                       jQuery('#step2').css("display","block");
                       jQuery('#next_button').css("display","none");
                       jQuery('#back_button').css("display","inline-block");
                       jQuery('#checkout_button').css("display","inline-block");
                   }
               },
               error : function(){alert("Something went Wrong!");},
            });
    }
</script>
-->
<?php
    include 'includes/footer.php';
?>
