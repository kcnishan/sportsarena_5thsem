<?php 

//echo $user_data['id'];
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

<nav class="navbar-default navbar-fixed-top">
            <div class="container">
                <a href="/SportsArena/admin/index.php" class="navbar-brand"> Sports Arena Admin</a>
                <ul class="nav navbar-nav">
                   
                    <!-- Menu Items -->
                    
                    <li><a href="/SportsArena/index.php">Home</a></li> 
                    <li><a href="brands.php">Brands</a></li>                   
                    <li><a href="categories.php">Categories</a></li>
                    <li><a href="products.php">Products</a></li>
                    <?php if(has_permission('admin')): ?>
                    <li><a href="users.php">Users</a></li>
                    <?php endif; ?>
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-user"></span>                       
                            <?=$user_data['first']; ?>!
                            
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="change_password.php">Change Password</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                    <!--
                    <li style="float:right"><a href="#"><span class="glyphicon glyphicon-user"></span> <?=$user_data['first']; ?> </a></li>
                    <li><a href="change_password.php">Change Password</a></li>
                    <li><a href="logout.php">Logout</a></li>-->
                    <!--
                    <li>
                        <a href="/SportsArena/admin/includes/usersmodal.php" role="button" class="btn" data-toggle="modal">Launch modal</a>
                        
                    </li>
                    <li><a href="#" onclick="usersmodal(<?= $user_data['id'];?>)"><?=$user_data['first'] ; ?><span class="glyphicon glyphicon-user"></span></a></li>
                    <div>
                    <button type="button" class="btn btn-sm btn-success" onclick="usersmodal(<?= $user_data['id']; ?>)">Details</button>
                    </div>
                    -->
                
                   <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category']; ?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            
                        </ul>
                    </li> -->
                
            </div>
</nav>




