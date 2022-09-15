<?php include('header.php'); ?>
<style>
    .img {
        width: 400px;
        height: 250px;
        border-radius: 10px;
     }
    .hover-image  :hover{
        transform: scale(1.2,1.2);
        
    }
 
</style>
<div class="breadcrumb-area gray-bg">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">Shop Grid Style </li>
            </ul>
        </div>
    </div>
</div>
<div class="shop-page-area pt-100 pb-100">
    <div class="container">
        <?php
        $cat_id = 0 ;
          $product_sql =  "select * from dish where status = 1 ";
        if (isset($_GET['cat_id']) && $_GET['cat_id'] > 0) {
            $cat_id = get_safe_value($_GET['cat_id']);
            $product_sql .= " and category_id = '$cat_id' ";
        }
        $product_sql .= " order by dish asc";
        $product_list = mysqli_query($con, $product_sql);

        ?>
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <!-- <div class="banner-area pb-30">
                        <a href="product-details.html"><img alt="" src="assets/img/banner/banner-49.jpg"></a>
                    </div> -->
                <div class="grid-list-product-wrapper ">
                    <div class="product-grid product-view pb-20">
                        <?php if (mysqli_num_rows($product_list) > 0) { ?>
                            <div class="row">
                                <?php while ($product_row = mysqli_fetch_assoc($product_list)) { ?>
                                    <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product-wrapper">
                                            <div class="product-img hover-image">
                                                <a href="product-details.html">

                                                    <img class="img" src="<?php echo SITE_DISH_IMAGE . $product_row['image']; ?>" alt="">
                                                </a>
                                            </div>
                                            <div class="product-content">
                                                <h4>
                                                    <a href="product-details.html"><?php echo $product_row['dish']; ?></a>
                                                </h4>
                                                <div class="product-price-wrapper">
                                                    <span>$100.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            } else { ?>
                                <h3  class=" text-center"> No Dish Found ...</h3 >
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $cart_sql = " select * from category where status = 1";
            $cat_result = mysqli_query($con, $cart_sql);

            ?>
            <div class="col-lg-3">
                <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg ">
                    <div class="shop-widget">
                        <h4 class="shop-sidebar-title">Shop By Categories</h4>
                        <div class="shop-catigory">
                            <ul id="faq" class="category_list">

                                <?php
 
                                 while ($cat_row = mysqli_fetch_assoc($cat_result)){
                                    $class = 'selected';
                                    if($cat_id == $cat_row['id']){
                                        $class = 'active';
                                    }
                                    echo  "<li> 
                                                <a class ='$class' href='shop.php?cat_id=" . $cat_row['id'] . "'> " . $cat_row['category'] . "</a>
                                            </li>";
                                }
                                ?>
                              
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>