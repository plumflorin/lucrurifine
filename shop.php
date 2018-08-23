<?php include "includes/head.php"; ?>

<body>
<?php

  $object = new Produs();
  $cat = $object->getRows("SELECT * FROM categorie");
  $photoPath = $object->photoPath();
if (!isset($_GET['categorie'])) {
  if (isset($_GET['page'])) {
      $page = $_GET['page'];
  } else {
      $page = "";
  }
  $no_of_records_per_page = 9;
  if ($page == "" || $page == 1) {
    $page_1 = 0;
    } else {
    $page_1 = ($page * $no_of_records_per_page) - $no_of_records_per_page;
    }
  $total_records_sql = $object->getRows("SELECT * FROM produs");
  $total_records = count($total_records_sql);




  $total_pages = ceil($total_records / $no_of_records_per_page);

  $rows = $object->getRows("SELECT * FROM produs LIMIT $page_1, $no_of_records_per_page");
} else {

  foreach ($cat as $categ) {
      if ($categ['nume_categorie'] == $_GET['categorie']) {

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = "";
        }

        $no_of_records_per_page = 9;
        if ($page == "" || $page == 1) {
          $page_1 = 0;
          } else {
          $page_1 = ($page * $no_of_records_per_page) - $no_of_records_per_page;
          }

        $total_records_sql = $object->getRows("SELECT * FROM produs WHERE id_categorie_produs = ?", [$categ['id_categorie']]);
        $total_records = count($total_records_sql);


        $total_pages = ceil($total_records / $no_of_records_per_page);

        $rows = $object->getRows("SELECT * FROM produs WHERE id_categorie_produs = ? LIMIT $page_1, $no_of_records_per_page", [$categ['id_categorie']]);
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
                                    <!-- <div class="product-sorting d-flex">
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
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                          <?php
                          foreach ($rows as $row) {
                            $id_produs = $row['id_produs'];
                            $nume_produs = $row['nume_produs'];

                            $pret = $row['pret_produs'];
                            $pret_modif = str_replace('.', ',', $row['pret_produs']) . " LEI";
                            $pret_vechi = $row['pret_vechi_produs'];
                            $pret_vechi_modif = str_replace('.', ',', $row['pret_vechi_produs']) . " LEI";

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
                                        if ($pret_vechi > 0) {
                                          $percent = ($pret_vechi - $pret) / $pret_vechi * 100;
                                            echo '<div class="product-badge offer-badge">';
                                                echo "<span>-".round($percent)."% </span>";
                                            echo "</div>";
                                          }
                                            ?>
                                    </div>

                                    <!-- Product Description -->
                                    <div class="product-description">
                                        <span><?php echo $nume_produs; ?></span>
                                            <h6><?php echo $descriere_produs; ?></h6>
                                        <?php
                                        if ($pret_vechi < 1) {
                                          echo '<p class="product-price">'.$pret_modif.'</p>';
                                        } elseif ($pret_vechi > 0) {
                                          echo '<p class="product-price"><span class="old-price">'.$pret_vechi_modif.'</span>'. $pret_modif.'</p>';
                                        }

                                        ?>
                                        <!-- Hover Content -->
                                        <div class="hover-content">
                                            <!-- Add to Cart -->

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
                          <?php

                          if (isset($_GET['page'])) {
                            $pagenr = $_GET['page'];
                          } else {
                            $pagenr = 1;
                          }
                        if ($pagenr > 1) {


                          if (isset($_GET['categorie'])) {
                            if (isset($_GET['page'])) {
                              echo '<li class="page-item"><a class="page-link" href="shop.php?categorie=' . $_GET['categorie'] . '&page=' . ($pagenr -1) .'"><i class="fa fa-angle-left"></i></a></li>';
                            }
                          } elseif (isset($_GET['page'])) {
                              echo '<li class="page-item"><a class="page-link" href="shop.php?page=' . ($pagenr - 1) . '"><i class="fa fa-angle-left"></i></a></li>';
                          }
                          }
                              //print_r($total_pages_sql);
                              for ($i=1; $i<=$total_pages ; $i++) {
                                if (isset($_GET['categorie'])) {

                                  echo '<li class="page-item"><a class="page-link" href="shop.php?categorie=' . $_GET['categorie'] . '&page=' . $i .'">' . $i . '</a></li>';
                                } else {
                                  echo '<li class="page-item"><a class="page-link" href="shop.php?page=' . $i .'">' . $i . '</a></li>';
                                }
                              }


                            if ($pagenr <$total_pages) {

                              if (isset($_GET['categorie'])) {
                                if (isset($_GET['page'])) {
                                  echo '<li class="page-item"><a class="page-link" href="shop.php?categorie=' . $_GET['categorie'] . '&page=' . ($_GET['page'] + 1) .'"><i class="fa fa-angle-right"></i></a></li>';
                                } else {
                                  echo '<li class="page-item"><a class="page-link" href="shop.php?categorie=' . $_GET['categorie'] . '&page=2"><i class="fa fa-angle-right"></i></a></li>';
                                }
                              } elseif (isset($_GET['page'])) {
                                  echo '<li class="page-item"><a class="page-link" href="shop.php?page=' . ($_GET['page'] + 1) . '"><i class="fa fa-angle-right"></i></a></li>';
                              } else {
                                echo '<li class="page-item"><a class="page-link" href="shop.php?page=2"><i class="fa fa-angle-right"></i></a></li>';
                              }
                            }
                            ?>
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
