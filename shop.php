<?php include "includes/head.php"; ?>

<body>
<?php

  $object = new Produs();
  $cat = $object->getRows("SELECT * FROM categorie");
  $photoPath = $object->photoPath();
if (!isset($_GET['categorie'])) {
  $rows = $object->getRows("SELECT * FROM produs");
} else {

  foreach ($cat as $categ) {
      if ($categ['nume_categorie'] == $_GET['categorie']) {
        $rows = $object->getRows("SELECT * FROM produs WHERE id_categorie_produs = ?", [$categ['id_categorie']]);
      }
}
}

?>
    <!-- ##### Breadcumb Area Start ##### -->
    <!-- <div class="breadcumb_area bg-img" style="background-image: url(imgagini/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>dresses</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <?php include "includes/leftmenu.php"; ?>
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <!-- <div class="total-products">
                                        <p><span>186</span> products found</p>
                                    </div> -->
                                    <!-- Sorting -->
                                    <div class="product-sorting d-flex">
                                        <p>Sort by:</p>
                                        <form action="#" method="get">
                                            <select name="select" id="sortByselect">
                                                <option value="value">Highest Rated</option>
                                                <option value="value">Newest</option>
                                                <option value="value">Price: $$ - $</option>
                                                <option value="value">Price: $ - $$</option>
                                            </select>
                                            <input type="submit" class="d-none" value="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                          <?php
                          foreach ($rows as $row) {
                            $id_produs = $row['id_produs'];
                            $nume_produs = $row['nume_produs'];
                            $pret_produs = $row['pret_produs'];
                            $pret_redus_produs = $row['pret_redus_produs'];
                            $descriere_produs = $row['descriere_produs'];
                            $id_categorie_produs = $row['id_categorie_produs'];
                            $data_adaugare_produs = $row['data_adaugare_produs'];

                           ?>
                            <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                      <?php
                                      $rows = $object->getRows("SELECT * FROM imagini WHERE id_produs_imagine = ? Limit 2", [$id_produs]);

                                        $imagine1 = $rows['0']['nume_imagine'];
                                        $imagine2 = $rows['1']['nume_imagine'];
                                        ?>
                                        <a href="single-product.php?p_id=<?php echo $id_produs; ?>"><img src="<?php echo $photoPath; ?><?php echo $imagine1; ?>" alt=""></a>

                                         <!-- Hover Thumb -->
                                        <a href="single-product.php?p_id=<?php echo $id_produs; ?>"><img class="hover-img" src="<?php echo $photoPath; ?><?php echo $imagine2; ?>" alt=""></a>


                                         <!-- Product Badge -->
                                        <?php
                                            if (($pret_redus_produs > 0)) {
                                              $percent = ($pret_produs - $pret_redus_produs) / $pret_produs * 100;
                                                echo '<div class="product-badge offer-badge">';
                                                    echo "<span>-".round($percent)."% </span>";
                                                echo "</div>";
                                            }
                                            ?>
                                    </div>

                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <span><?php echo $nume_produs; ?></span>
                                        <a href="single-product-details.html">
                                            <h6><?php echo $descriere_produs; ?></h6>
                                        </a>
                                        <?php  if ($pret_redus_produs == 0) {
                                          echo '<p class="product-price">'.$pret_produs.'</p>';
                                        } elseif ($pret_redus_produs > 0) {
                                          echo '<p class="product-price"><span class="old-price">'.$pret_produs.'</span>'. $pret_redus_produs.'</p>';
                                        }
                                        ?>
                                        <!-- Hover Content -->
                                        <div class="hover-content">
                                            <!-- Add to Cart -->
                                            <div class="add-to-cart-btn">
                                                <a href="" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        <ul class="pagination mt-50 mb-70">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">21</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <?php include "includes/footer.php"; ?>

</body>

</html>
