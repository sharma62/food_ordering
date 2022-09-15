<?php 
include ('top.php');

if(isset($_GET['type']) && $_GET['type']!='' && isset($_GET['id'])&& $_GET['id']>0)
{
    $type = $_GET['type'];
    $id = $_GET['id'];
    if($type =='active'|| $type ==='deactive'){
        $status = 1;
        if($type =='deactive'){
            $status =0;
        }
        $sql = "update user set status ='$status' where id = '$id' ";
        mysqli_query($con,$sql);
        redirect('user.php');
    }
}

$res = mysqli_query($con,"select * from user order by id desc");

 
?>
<div class="card">
    <div class="card-body">
        <h1 class="grid_title  ">User Master</h1>
         <div class="row grid_box">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th width="15%">S.No #</th>
                                <th width="25%">Name</th>
                                <th width="">Email</th>
                                <th width="">Mobile no.</th>
                                <th width="">Added on.</th>
                                <th width="">Status</th>

                            </tr>
                        </thead>
                        <tbody>
                 <?php if(mysqli_num_rows($res)>0)
                 {
						$i=1;
						while($row=mysqli_fetch_assoc($res))
                        {
						?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $row['name']?></td>
                                <td><?php echo $row['email']?></td>
                                <td><?php echo $row['mobile']?></td>
                                <td><?php echo $row['added_on'];?></td>
                                
                                <td>
                             <?php
                                    // after checking the active or deactive button wap each other 
								if($row['status'])
                                {
								?>
                                    <!-- code working flow  -->
                                    <!-- click the botton and go to isset function line no 4 
                                    sand the data id & type 
                                -->
                                    <a href="?id=<?php echo $row['id']?>&type=deactive"><label
                                            class="badge badge-success hand_cursor Active ">Active</label></a>
                                    <?php
								}else
                                {
								?>
                                    <a href="?id=<?php echo $row['id']?>&type=active"><label
                                            class="badge badge-info hand_cursor Deactive">Deactive</label></a>
                                    <?php
								}
								
								?>
                                </td>
                            </tr>
                            <?php 
						$i++;
						} 
                   } 
                   else 
                     { ?>
                            <tr>
                                <td colspan="5" style="text-align:center">No data found</td>
                            </tr>
                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'?>