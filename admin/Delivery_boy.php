    <?php
include ('top.php'); 
if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
    $type= $_GET['type'];
	$id= $_GET['id'];
    if($type=='delete'){
		mysqli_query($con,"delete from delivery_boy where id='$id'");
		redirect('delivery_boy.php');
	}
    // for active or deactive the data .
    // if type is mached 
	if($type=='active' || $type=='deactive'){
        // Execute this logic
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update delivery_boy set status='$status' where id='$id'");
		redirect('Delivery_boy.php');
        // and after Executing the code check status is 1 or 0 . on line no 63
	}
    

}
$sql="select * from delivery_boy ";
$res=mysqli_query($con,$sql);



?>
<div class="card">
    <div class="card-body">
        <h1 class="grid_title">Delivery boy</h1>
        <a href="manage_delivery.php" class="add_link">Add Delivery boy</a>
         <div class="row grid_box">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr> 
                                <th width="10%">S.No #</th>
                                <th width="25%">Name</th>
                                <th width="18%">Mobile</th>
                                <th width="25%">Added on.</th>                                
                                <th width="22%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php if(mysqli_num_rows($res)>0){
						$i=1;
						while($row=mysqli_fetch_assoc($res)){
						?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $row['name']?></td>
                                <td><?php echo $row['mobile']?></td>
                                <td><?php echo $row['added_on']?></td>
                                <td>
                                    <a href="manage_delivery.php?id=<?php echo $row['id']?>"><label
                                            class="badge badge-secondary hand_cursor ">Edit</label></a>&nbsp;
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
<?php include ('footer.php');?>