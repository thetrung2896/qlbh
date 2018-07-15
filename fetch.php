<?php

$connect = mysqli_connect("localhost", "root", "", "ntt_bil");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	
	$query = "
	SELECT * FROM orders INNER JOIN emp ON orders.emp_id = emp.emp_id 
	WHERE orders_total LIKE '%".$search."%'
	OR orders_id LIKE '%".$search."%'
	OR orders_action LIKE '%".$search."%'
	OR orders_date LIKE '%".$search."%'
	|| emp_name LIKE '%".$search."%'
	";
}
else
{
	$query = "
	SELECT * FROM orders INNER JOIN emp ON orders.emp_id = emp.emp_id ORDER BY orders_id DESC";
}
$result = mysqli_query($connect, $query);
echo '<form action="" method="POST">';
if(mysqli_num_rows($result) > 0)
{
	?>
				<div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle; width: 4%">date</th>
                                <th style="vertical-align: middle; width: 5%">employee</th>
                                <th style="vertical-align: middle;width: 5%">Order code</th>
                                <th style="vertical-align: middle;width: 55%">Name products</th>
                                <th style="vertical-align: middle;width: 20%">status</th>
                                <th style="vertical-align: middle; width: 5%" class="text-left">Total</th>
                                
                            </tr>
                        </thead>
                        <tbody>
					<?php
						
						while($row = mysqli_fetch_array($result)){
						   
						$order_id = $row['orders_id'];
						$sql = mysqli_query ($connect,"SELECT * FROM order_products INNER JOIN products ON order_products.id = products.id WHERE orders_id = '$order_id'");

					?>                      
								
                            <tr>
                                <td style="vertical-align: middle;"><?php  
                                    $date = date('d/m/Y H:i:s',strtotime($row['orders_date']))   ;
                                    echo $date;
                                    ?>
                                </td>

                                <td style="vertical-align: middle;">
                                 	<div style="font-family:sans-serif; "><?php echo $row['emp_name'] ?></div>
                                </td>

                                <td style="vertical-align: middle;">
                                	<?php echo $row['orders_id'] ?>
                                	<input type="hidden" value="<?php echo $row['orders_id']; ?>" name="id" >
                                </td>

                                <td style="vertical-align: middle;">
                                    <?php
                                        while ($rows_sql = mysqli_fetch_array($sql)){
                                    ?>
                                        <div class="" >
                                            <img src="images/<?php echo $rows_sql['image']; ?>" style="width:40px;" />
                                            <?php echo $rows_sql['name'] ?>
                                            <h class="text-right" style="font-weight: bolder;">$<?php echo $rows_sql['price'].' x '. $rows_sql['order_quantity'] ?></h>
                                        </div>
                                        
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td style="vertical-align: middle">
                                    <select style="width:80%" value="<?php echo $row['orders_id']; ?>" name="stt[<?php echo $row['orders_id']; ?>]" >
                                        <option value="<?php echo $row['orders_action'] ?>"><?php echo $row['orders_action'] ?></option>
                                        <option>Processed</option>
                                        <option>Transporting</option>
                                        <option>Delivered</option>
                                    </select>

                                    <button class="btn btn-primary" value="<?php echo $row['orders_id']; ?>" name="update_stt" style="margin-top:unset; padding: 0px 5px">
                                        <i style="font-size: smaller;" class="fa fa-sync-alt"></i>
                                    </button>
                                </td>
                            
                                <td class="text-left" style="vertical-align: middle;">
                                	$<?php echo $row['orders_total'] ?>
                                </td>
                                
                                    
                                
                            
                            </tr>
	                    <?php
	                   	
	                    }
	                    ?>
	                        
	                    </tbody>
	                </table>
	            </div>  
			                               
			                           
	<?php
}
else
{
	echo 'Data Not Found';
}
echo '</form>'; 
                         ?>
