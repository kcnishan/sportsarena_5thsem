
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/SportsArena/core/init.php';
    
    include 'includes/head.php';
    //include 'includes/navigation1.php';
?>

<div class="modal-body">
        <div class="container-fluid">
        <?php for($i=1;$i <= 12;$i++): ?>
          <div class="form-group col-md-4">
              <label for="sizes<?=$i;?>">Size:</label>
              <input type="text" name="sizes<?=$i?>;" id="sizes<?=$i?>;" value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>" class="form-control">
          </div>
          <div class="form-group col-md-2">
              <label for="quantity<?=$i;?>">Quantity:</label>
              <input type="number" name="quantity<?=$i?>;" id="sizes<?=$i?>;" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>" min="0" class="form-control">
          </div>
        <?php endfor; ?>
        </div>
</div>

<div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Save changes</button>
</div>

