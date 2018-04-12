<?php
require_once '../../core/init.php';
$id = $_POST['id'];
$id = (int)$id;
$sql = "SELECT * FROM products WHERE id = '$id'";
$result = $db->query($sql);
$product = mysqli_fetch_assoc($result);
$brand_id = $product['brand'];
$sql2 = "SELECT brand FROM brand WHERE id = '$brand_id'";
$brand_query = $db->query($sql2);
$brand = mysqli_fetch_assoc($brand_query);
$sizestring = $product['sizes'];
$sizestring = rtrim($sizestring,',');
$size_array = explode(',', $sizestring);
?>

<!-- details modal -->
<?php ob_start(); ?>

       <!-- Modal -->
<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="sizesModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
        <?php for($i=1;$i <= 12;$i++): ?>
          <div class="form-group col-md-4">
              <label for="sizes<?=$i;?>">Size:</label>
              <input type="text" name="sizes<?=$i?>;" id="size<?=$i?>;" value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>" class="form-control">
          </div>
          <div class="form-group col-md-2">
              <label for="quantity<?=$i;?>">Quantity:</label>
              <input type="number" name="quantity<?=$i?>;" id="size<?=$i?>;" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>" min="0" class="form-control">
          </div>
        <?php endfor; ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Save changes</button>
      </div>
    </div>
  </div>
</div>
        
<script>
    function closeModal(){
        jQuery('#users-modal').modal('hide');
        setTimeout(function(){
            jQuery('#users-modal').remove();
            //jQuery('.modal-backdrop').remove();
        },500);
    }
</script>
        
<?php echo ob_get_clean(); ?> 

