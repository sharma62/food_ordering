<?php 
include ('top.php');
// check id & type  
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
    // for delete the data 
	$type=get_safe_value($_GET['type']);
	$id=get_safe_value($_GET['id']);
    
    if($type=='delete'){
		mysqli_query($con,"delete from coupon_code where id='$id'");
		redirect('coupon_code.php');
	}
    
    // for active or deactive the data .
    // if type is mached 
	if($type=='active' || $type=='deactive'){
        // Execute this logic
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update coupon_code set status='$status' where id='$id'");
		redirect('coupon_code.php');
        // and after Executing the code check status is 1 or 0 . on line no 63
	}
    

}

$sql="SELECT * FROM `coupon_code` ORDER BY `coupon_code`.`coupon_value` ASC";
$res=mysqli_query($con,$sql);

?>
<div class="card">
    <div class="card-body">
        <h1 class="grid_title">Coupon Code Master</h1>
        <a href="manage_coupon.php" class="add_link">Add Coupon Code</a>
        <div class="row grid_box">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th width="">S.No #</th>
                                <th width="">Code</th>
                                <th width="">Type</th>
                                <th width="">Value</th>
                                <th width="">Min-value</th>
                                <th width="">Expire on.</th>
                                <th width="">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php if(mysqli_num_rows($res)>0){
						$i=1;
						while($row=mysqli_fetch_assoc($res)){
						?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $row['coupon_code']?></td>
                                <td><?php echo $row['coupon_type']?></td>
                                <td><?php echo $row['coupon_value']?> Rs</td>
                                <td><?php echo $row['cart_min_value']?> Rs</td>
                                <td><?php echo $row['expired_on']?></td>
                                <td>
                                    <?php
                                    // after checking the active or deactive button wap each other 
								if($row['status']){
								?>
                                    <!-- code working flow  -->
                                    <!-- click the botton and go to isset function line no 4 
                                    sand the data id & type 
                                -->
                                    <a href="?id=<?php echo $row['id']?>&type=deactive"><label
                                            class="badge badge-success hand_cursor ">Active</label></a>
                                    <?php
								}else{
								?>
                                    <a href="?id=<?php echo $row['id']?>&type=active"><label
                                            class="badge badge-info hand_cursor ">Deactive</label></a>
                                    <?php
								}
								
								?>
                                    &nbsp;
                                    <a href="?id=<?php echo $row['id']?>&type=delete"><label
                                            class="badge badge-danger delete_red hand_cursor ">Delete</label></a>
                                </td>

                            </tr>
                            <?php 
						$i++;
						} } else { ?>
                            <tr>
                                <td colspan="5" style = "text-align:center" >No data found</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php');?>