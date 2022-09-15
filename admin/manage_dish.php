<?php
include('top.php');

$dish_details = "";
$category_id = "";
$image = "";
$dish = "";
$msg = "";
$id = "";
$image_condition = "required";
$type = " ";
$type_error = "";
$image_temp = '';


if (isset($_GET['id']) &&  $_GET['id'] > 0) {
    $id = $_GET['id'];
    $row = mysqli_fetch_assoc(mysqli_query($con, " select * from dish where id ='$id'"));
    $dish = $row['dish'];
    $dish_details = $row['dish_detail'];
    $category_id = $row['category_id'];
    $image = $row['image'];
    $image_condition = '';
}
// insert the data 
if (isset($_POST['submit'])) {
    $dish = $_POST['dish'];
    $dish_detail = $_POST['dish_detail'];
    $category_id = $_POST['category_id'];
    $added_on = date('Y-m-d h:i:s');
    // for duplication data 
    if ($id == '') {
        $sql = "select * from dish where dish='$dish'";
    } else {
        $sql = "select * from dish where  dish ='$dish' id!='$id'";
    }
    
    if (mysqli_num_rows(mysqli_query($con, $sql)) > 0) {
        $msg = " Data is already added ";
    } else {
        $type = $_FILES['image']['type'];
        if ($id == '') {
            if ($type != 'image/jpeg' && $type != 'image/png') {
                $type_error = 'Invalid image';
            } else {
                $image = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], SERVER_DISH_IMAGE . $_FILES['image']['name']);
                mysqli_query($con, "insert into dish(dish,dish_detail,category_id,status,added_on,image)
                       values('$dish','$dish_detail','$category_id',1,'$added_on','$image')");
                redirect('dish.php');
            }
        } else {
            $image_temp = '';
            if ($_FILES['image']['name'] != '') {
                if ($type != 'image/jpeg' && $type != 'image/png') {
                    $type_error = 'Invalid image format';
                } else {
                    // prx($_FILES['image']['name']);  
                    $image = $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], SERVER_DISH_IMAGE . $_FILES['image']['name']);
                    $image_temp = ",image = '$image'";
                }
            }
            if ($type_error == '') {

                $sql = "update dish set dish='$dish', category_id='$category_id', dish_detail= '$dish_detail'  $image_temp  where id='$id'";
                mysqli_query($con, $sql);
                redirect('dish.php');
            }
        }
    }
}
$res_category = mysqli_query($con, "select * from category where status ='1'");
?>
<div class="row">
    <h1 class="grid_title ml10 ml15">Manage Dish</h1>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Category">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">Select category</option>
                            <?php
                            while ($row_category = mysqli_fetch_assoc($res_category)) {
                                if ($row_category['id'] == $category_id) {

                                    echo "<option value = '" . $row_category['id'] . "' selected>" . $row_category['category'] . "</option>";
                                } else {
                                    echo "<option value = '" . $row_category['id'] . "' >" . $row_category['category'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Dish">Dish</label>
                        <input type="text" class="form-control" placeholder="Dish Name" name="dish" required value="<?php echo $dish ?>">
                        <div class="error mt8"><?php echo $msg ?></div>
                    </div>
                    <div class="form-group">
                        <label for="image">image</label>
                        <input type="file" class="form-control" name="image" <?php echo $image_condition ?>>
                        <div class="error mt8"><?php echo $type_error ?></div>
                    </div>
                    <div class="form-group">
                        <label for="Dish_detail">Dish detail</label>
                        <textarea name="dish_detail" class="form-control" cols="30" rows="5" value=""><?php echo $dish_details ?></textarea>

                    </div>

                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>