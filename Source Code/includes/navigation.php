<?php 
//require_once '../core/init.php';
$sql = "SELECT * FROM categories WHERE parent = 0";
$pquery = $db->query($sql);

?> 

<script>
    $(function()
    {
     $(".dropdown").hover(
             function()
     {
         $('.dropdown-menu',this).stop(true,true).fadeIn("fast");
            $(this).toggleClass('open');
            $('b',this).toggleClass("caret caret-up");
        },
        function()
        {
            $('.dropdown-menu',this).stop(true,true).fadeOut("fast");
            $(this).toggleClass('open');
            $('b',this).toggleClass("caret caret-up");
     });    
    });

</script>

<!-- Top Nav bar --> 
        
        <nav class="navbar-default navbar-fixed-top">
            <div class="container">
                <a href="index.php" class="navbar-brand"> Sports Arena </a>
                <ul class="nav navbar-nav"> 
                    <?php while($parent = mysqli_fetch_assoc($pquery)) : ?>
                    <?php
                        $parent_id = $parent['id'];
                        $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
                        $cquery = $db->query($sql2);
                    ?>
                    
                    
                    <!-- Menu Items -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category']; ?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php while($child = mysqli_fetch_assoc($cquery)): ?>
                            <li><a href="category.php?cat=<?=$child['id'];?>"><?php echo $child['category'];?></a></li>
                            <?php endwhile; ?>
                        </ul>
                    </li>
                    <?php endwhile; ?>
                    
                    <?php if(is_logged_in()): ?>
                        <?php if(customer_permission('customer')): ?>
                            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>My Cart</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if(is_logged_in()): ?>
                       <?php if(customer_permission('customer')): ?> 
                            <li class="dropdown">
                               <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><span class="glyphicon glyphicon-user"></span><?=$user_data['first']; ?></a>
                               <ul class="dropdown-menu" role="menu">
                                   <!--<li><a href="#">Edit Profile</a></li>
                                   <li class="divider"></li>-->
                                   <li><a href="/SportsArena/account/customer_logout.php">Log Out</a></li>
                               </ul>
                           </li>
                       <?php else: ?>
                           <li class="dropdown">
                               <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><span class="glyphicon glyphicon-user"></span><?=$user_data['first']; ?></a>
                               <ul class="dropdown-menu" role="menu">
                                   <li><a href="/SportsArena/admin/index.php">Admin Page</a></li>
                                   <li class="divider"></li>
                                   <li><a href="/SportsArena/admin/logout.php">Log Out</a></li>
                               </ul>
                           </li>
                       <?php endif; ?>
                    <?php else: ?>  
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span>Account</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/SportsArena/admin/login.php">Login</a></li>
                            <li><a href="/SportsArena/account/signup.php">Sign Up</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                
                </div>
        </nav>


                <!--    <a href="#" class="navbar-text"> Boots </a>
                    <a href="#" class="navbar-text"> Ball </a>
                    <a href="#" class="navbar-text"> Hoodies </a>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Keeper<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Gloves</a></li>
                            <li><a href="#">Kits</a></li>
                        </ul>
                    </li>
                    
                    <a href="#" class="navbar-text"> Jacket </a>
                    <a href="#" class="navbar-text"> Training Kits </a>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Accessories<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Tea Cups</a></li>
                            <li><a href="#">Keyrings</a></li>
                        </ul>
                    </li> --> 
                    
                
                
                
                        
            