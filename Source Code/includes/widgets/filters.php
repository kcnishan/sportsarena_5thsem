<?php
    $cat_id = ((isset($_REQUEST['cat']))?sanitize($_REQUEST['cat']):'');
    $price_sort = ((isset($_REQUEST['price_sort']))?sanitize($_REQUEST['price_sort']):'');
    $min_price = ((isset($_REQUEST['min_price']))?sanitize($_REQUEST['min_price']):'');
    $max_price = ((isset($_REQUEST['max_price']))?sanitize($_REQUEST['max_price']):'');
    $b = ((isset($_REQUEST['brand']))?sanitize($_REQUEST['brand']):'');
    $brandQ = $db->query("SELECT * FROM brand ORDER BY brand");
    //$c = ((isset($_REQUEST['category']))?sanitize($_REQUEST['category']):'');
    //$catQ = $db->query("SELECT * FROM categories WHERE parent = '0' ORDER BY category");
    
?>
<h3 class="text-center">Search By:</h3>
<h4 class="text-center">Price</h4>
<form action="search.php" method="post">
    <input type="hidden" name="cat" value="<?=$cat_id;?>">
    <input type="hidden" name="price_sort" value="0">
    <input type="radio" name="price_sort" value="low"<?=(($price_sort =='low')?' checked':''); ?>>Low to High<br>
    <input type="radio" name="price_sort" value="high"<?=(($price_sort =='high')?' checked':''); ?>>High to Low<br>
    <input type="text" name="min_price" class="price-range" placeholder="Min NRs." value="<?=$min_price; ?>">to
    <input type="text" name="max_price" class="price-range" placeholder="Max NRs." value="<?=$max_price; ?>"><br><br>
    
    <h4 class="text-center">Brand</h4>
    <input type="radio" name="brand" value=""<?=(($b =='')?' checked':''); ?>>All<br>
    <?=$cat_id; ?>
    <?php while($brand = mysqli_fetch_assoc($brandQ)):  ?>
    <input type="radio" name="brand" value="<?=$brand['id'];?>"<?=(($b == $brand['id'])?' checked':'');?>><?=$brand['brand']; ?><br>
    <?php endwhile; ?>
    
   <!-- <h4 class="text-center">Category</h4>
    <input type="radio" name="category" value=""<?=(($c =='')?' checked':''); ?>>All<br>
    <?php while($category = mysqli_fetch_assoc($catQ)):  ?>
    <input type="radio" name="category" value="<?=$category['id'];?>"<?=(($c == $category['id'])?' checked':'');?>><?=$category['category']; ?><br>
    <?php endwhile; ?> -->
    
    <input type="submit" value="Search" class="btn btn-xs btn-primary">
</form>

    
