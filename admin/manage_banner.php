<?php
include('top.php');

$msg = "";
$image       = "";
$heading     = "";
$sub_heading = "";
$link        = "";
$link_txt    = "";
$order_number = "";
$id = "";
$type_error ="";
$image_condition = "required";

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $id = get_safe_value($_GET['id']);
    $row = mysqli_fetch_assoc(mysqli_query($con, "select * from banner where id='$id'"));
    $image = $row['image'];
    $heading  = $row['heading'];
    $sub_heading = $row['sub_heading'];
    $link     = $row['link'];
    $link_txt  = $row['link_txt'];
    $order_number = $row['order_number'];
    $image_condition =" ";
}
if (isset($_POST['submit'])) {
    $heading = get_safe_value($_POST['heading']);
    $sub_heading = get_safe_value($_POST['sub_heading']);
    $link = get_safe_value($_POST['link']);
    $link_txt = get_safe_value($_POST['link_txt']);
    $order_number = get_safe_value($_POST['order_number']);
    $added_on = date('Y-m-d h:i:s');
    
        if ($id == '') {
            $type = $_FILES['image']['type'];          
              if ($type!= 'image/jpeg' && $type!='image/png') {
                  $type_error = " Invalid image";
              }
              else{
 
                  mysqli_query($con, "INSERT INTO `banner`(`image`,`heading`, `sub_heading`, `link`, `link_txt`, `added_on`, `status`, `  `)
                       VALUES ('$image','$heading','$sub_heading','$link','$link_txt','$added_on',1,'$order_number')");
                }
        } else {
            mysqli_query($con, "update banner set heading ='$heading',sub_heading ='$sub_heading',link ='$link' , link_txt = '$link_txt', order_number='$order_number' where id='$id'");
        }
        redirect('banner.php');



}

?>
<div class="row">
    <h1 class="grid_title ml10 ml15">Manage Banner</h1>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputName1">Heading</label>
                                <input type="text" class="form-control" placeholder="Heading" name="heading" required value="<?php echo $heading ?>">
                                <div class="error mt8"><?php echo $msg ?></div>
                            </div>

                        </div>
                        <div class="col">


                            <div class="form-group">
                                <label for="exampleInputName1">Sub Heading</label>
                                <input type="text" class="form-control" placeholder="Sub_Heading" name="sub_heading" required value="<?php echo $sub_heading ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">Link</label>
                        <input type="text" class="form-control" placeholder="Link" name="link" required value="<?php echo $link ?>">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputName1">Link text</label>
                                <input type="text" class="form-control" placeholder="Link text" name="link_txt" required value="<?php echo $link_txt ?>">
                            </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                                <label for="exampleInputName1" >image</label>
                                <input type="file" placeholder="Upload_image" class="form-control" name="image" <?php echo $image_condition?> >
                                <div class="error mt8"><?php echo $type_error ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3" required>Order Number</label>
                        <input type="textbox" class="form-control" placeholder="Order Number" name="order_number" value="<?php echo $order_number ?>">
                    </div>


                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

</div>

<?php include('footer.php'); ?>