<?php   
 //index.php  
 $connect = mysqli_connect("localhost", "root", "", "zzz"); 
  
 function fill_brand($take_connection)  
 {  
      $output = '';  
      $sql = "SELECT * FROM brand";  
      $result = mysqli_query($take_connection, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row["brand_id"].'">'.$row["brand_name"].'</option>';  
      }  
      return $output;  
 }  
 function fill_product($take_connection)  
 {  
      $output = '';  
      $sql = "SELECT * FROM product";  
      $result = mysqli_query($take_connection, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
        ?>
        <div class="col-md-3">
          <div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">
            <p class="text-info"><?php echo $row['product_name'];?></p>
          </div>
        </div>
          <?php  
      }  
     
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Load Records</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container">  
                <h3>  
                     <select name="brand" id="brand">  
                          <option value="">Show All Product</option>  
                          <?php echo fill_brand($connect); ?>  
                     </select>  
                     <br /><br />  
                     <div class="row" id="show_product">  
                          <?php echo fill_product($connect);?>  
                     </div>  
                </h3>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function()
 {  
      $('#brand').change(function()
      {  
           var brand_id = $(this).val();  
           $.ajax({  
                url:"load_data.php",  
                method:"POST",  
                data:{brand_id:brand_id},  
                success:function(data)
                {  
                     $('#show_product').html(data);  
                }  
           });  
      });  
 });  
 </script>  