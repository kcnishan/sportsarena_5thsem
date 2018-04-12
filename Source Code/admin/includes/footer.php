</div> <br> <br> 
        
         <footer class="text-center" id="footer"> &copy; Copyright 2016-2017 Sports Arena</footer>
        <!-- <div class="col-md-12" text-center">&copy; Copyright 2016-2017 Sports Arena </div> -->   

        
        
        <script>
           
            
            function updateSizes(){
                var sizeString = '';
                for(var i=1;i<=12;i++){
                    if(jQuery('#size'+i).val()!= ''){
                        sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+',';
                    }
                }
                jQuery('#sizes').val(sizeString);
                header ('Location:/SportsArena/admin/products.php?add=1 ');
                //window.open("/SportsArena/admin/products?add=1/");
            }
            function get_child_options(selected){
                if(typeof selected == 'undefined'){
                    var selected = '';
                }
                var parentID = jQuery('#parent').val();
                jQuery.ajax({
                   url:'/SportsArena/admin/parsers/child_categories.php',
                   type: 'POST',
                   data: {parentID : parentID, selected: selected},
                   success: function(data){
                       jQuery('#child').html(data);
                   },
                   error: function(){alert("Something went wrong with the child options.")},
                });
            }
            
            function sizesModal(id){
               
                //alert(id); //ajax = asynchronous(page need not be reloaded) javascript and xml //json used for xml
                var data = {"id" : id};
                jQuery.ajax({
                    url : '/SportsArena/admin/includes/sizesModal.php',
                    method : "post",
                    data : data,
                    success : function(data){
                        jQuery('body').append(data);
                        jQuery('#sizesModal').modal('toggle');
                    },
                    error : function(){
                        alert("Sth went Wrong!");
                    }                    
                });
            }
            
           
            
            jQuery('select[name="parent"]').change(function(){
                get_child_options();
            });
        </script>
     
        
</body>
</html>