<?php 
include('top.php');

$coupon_code ="";
$coupon_type ="";
$coupon_value="";
$cart_min_value="";
$msg="";
$id="";
  
$added_on=date('Y-m-d h:i:s');
$expired_on=date('Y-m-d h:i:s');
 
 if(isset($_POST['submit'])){
     $coupon_code =$_POST['coupon_code'];
     $coupon_type = $_POST['coupon_type'];
     $coupon_value= $_POST['coupon_value'];
     $cart_min_value= $_POST['cart_min_value'];
     $expired_on = $_POST['expired_on'];
  }

            $sql="select * from coupon_code where coupon_code ='$coupon_code'";	 
            $res =mysqli_query($con,$sql);
            $copy_row = mysqli_num_rows($res);
        if($copy_row){
            $msg = " Data is already added " ;
        }else{
               $hit =   mysqli_query($con,"insert into coupon_code(coupon_code,coupon_type,coupon_value,cart_min_value,expired_on,status,added_on) values('$coupon_code','$coupon_type','$coupon_value','$cart_min_value','$expired_on,1,'$added_on')");  
      
                   redirect('coupon_code.php');
              
        }
     ?>
<div class="row">
    <h1 class="grid_title ml10 ml15">Manage Coupon</h1>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" method="post">
                    <div class="form-group">
                        <label for="exampleInputName1">code</label>
                        <input type="text" class="form-control" placeholder="coupon_code" name="coupon_code" required
                            value="<?php echo $coupon_code?>">
                        <div class="error mt8"><?php echo $msg?></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3" >type</label>
                        <input type="textbox" class="form-control" placeholder="coupon_type." name="coupon_type"
                            value="<?php echo $coupon_type?>">
                        <div class="error mt8"><?php echo $msg?></div>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3" >value</label>
                        <input type="text" class="form-control" name="coupon_value" value="<?php echo $coupon_value?>">
                        <div class="error mt8"><?php echo $msg?></div>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3" >Min - value</label>
                        <input type="textbox" class="form-control" placeholder="Min - value" name="cart_min_value"
                            value="<?php echo $cart_min_value?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3" >Expired on.</label>
                        <input type="date" class="form-control" placeholder="Expired_on" name="expired_on"
                            value="<?php echo $expired_on?>">
                    </div>


                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

</div>

<?php include('footer.php');?>