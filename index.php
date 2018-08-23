<?php include "includes/head.php"; ?>
<?php include_once "app/class.produs.php"; ?>


    <!-- ##### Welcome Area Start ##### -->
    <section class="welcome_area bg-img background-overlay" style="background-image: url(imagini/bg-img/background-header.jpg);">
        <!-- <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content">
                        <h6>asoss</h6>
                        <h2>New Collection</h2>
                        <a href="#" class="btn essence-btn">view collection</a>
                    </div>
                </div>
            </div> -->
        </div>
    </section>
    <!-- ##### Welcome Area End ##### -->

    <!-- ##### Top Catagory Area Start ##### -->


    <!-- ##### New Arrivals Area Start ##### -->
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Popular Products</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">

                      <?php
                          $object = new Produs();
                          $rows = $object->getRows("SELECT * FROM produs ORDER BY data_adaugare_produs LIMIT 6");
                          $photoPath = $object->photoPath();
                          foreach ($rows as $row) :
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
                                    <div class="add-to-cart-btn">
                                        <!-- <a href="#" class="btn essence-btn">Add to Cart</a> -->


                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php  endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### New Arrivals Area End ##### -->


    <!-- ##### Footer Area Start ##### -->
    <?php include "includes/footer.php"; ?>
</body>

</html>
