</div>
        
        <footer class="text-center" id="footer"> &copy; Copyright 2016-2017 Sports Arena</footer>
        
        
     
        <script>
            jQuery(window).scroll(function(){
                var vscroll = jQuery(this).scrollTop();
                 jQuery('#logotext').css({
                     "transform" : "translate(0px,"+vscroll/2+"px"
                 });
            });
            
            function detailsmodal(id){
                //alert(id); //ajax = asynchronous(page need not be reloaded) javascript and xml //json used for xml
                var data = {"id" : id};
                jQuery.ajax({
                    url : '/SportsArena/includes/detailsmodal.php',
                    method : "post",
                    data : data,
                    success : function(data){
                        jQuery('body').append(data);
                        jQuery('#details-modal').modal('toggle');
                    },
                    error : function(){
                        alert("Sth went Wrong!");
                    }                    
                });
            }
            
            function update_cart(mode,edit_id,edit_size){
                var data = {"mode" : mode, "edit_id" : edit_id, "edit_size" : edit_size};
                jQuery.ajax({
                   url : '/SportsArena/admin/parsers/update_cart.php',
                   method : "post",
                   data : data,
                   success : function(){location.reload();},
                   error : function(){alert("Something went wrong.");},
                });
            }
            
            function add_to_cart(){
                //alert("works! ");
                jQuery('#modal_errors').html("");
                var size = jQuery('#size').val();
                var quantity = jQuery('#quantity').val();
                var available = jQuery('#available').val();
                var error = '';
                var data = jQuery('#add_product_form').serialize(); //take the values of the form and serialize into get parameters
                if(size == '' || quantity == '' || quantity == 0){
                    error += '<p class="text-danger text-center">You must choose a size and quantity.</p>';
                    jQuery('#modal_errors').html(error);
                    return;
                }else if(quantity > available){
                    error += '<p class="text-danger text-center">There are only  '+available+' available.</p>';
                    jQuery('#modal_errors').html(error);
                    return;
                }else{
                    
                    jQuery.ajax({
                       url : '/SportsArena/admin/parsers/add_cart.php',
                       method : 'post',
                       data : data,
                       success : function(){
                           location.reload();
                       },
                       error : function(){alert("Something went wrong ");}
                    });
                }
                
            }
         </script>
</body>
</html>