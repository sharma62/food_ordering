<?php
include ('top.php'); 
// prx(PATH_IMAGE);
 if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){
    $type= $_GET['type'];
	$id= $_GET['id'];
    if($type=='delete'){
		mysqli_query($con,"delete from dish where id='$id'");
		redirect('dish.php');
	}
    // for active or deactive the data .
    // if type is mached 
	if($type=='active' || $type=='deactive'){
        // Execute this logic
		$status=1;
		if($type=='deactive'){
			$status=0;
		}
		mysqli_query($con,"update dish set status='$status' where id='$id'");
		redirect('dish.php');
        // and after Executing the code check status is 1 or 0 . on line no 63
	}
}
$sql = "select dish.*,category.category from dish ,category where dish.category_id = category.id";
// $sql="select d.*,c.category from dish d,category c where d.category_id = c.id";
$res=mysqli_query($con,$sql);



?>
<div class="card">
    <div class="card-body">
        <h1 class="grid_title">Dish</h1>
        <a href="manage_dish.php" class="add_link">Add Dish</a>
         <div class="row grid_box">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th width="">S.No #</th>
                                <th width="">category</th>
                                <th width="">image</th>
                                <th width="">Dish</th>
                                <th width="">Added on.</th>                                
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
                                <td><?php echo $row['category']?></td>
                                <td>
                                   <a href ="<?php echo SITE_DISH_IMAGE.$row['image']?> " target="_blank">  <img src="<?php echo SITE_DISH_IMAGE.$row['image']?>" alt="" style= "width:50px; height:50px"></a>
                                </td>
                                <td><?php echo $row['dish']?></td>
                                <td><?php echo $row['added_on']?></td>
                                <td>
                                    <a href="manage_dish.php?id=<?php echo $row['id']?>"><label
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