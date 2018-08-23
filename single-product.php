
<?php include "includes/head.php"; ?>
<?php
if (empty($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}
?>
<body>

<?php
if (isset($_GET['p_id'])) {

$id = $_GET['p_id'];

$object = new Produs();
$row = $object->getRow("SELECT * FROM produs WHERE id_produs = ?", [$id]);
$id_produs = $row['id_produs'];
$nume_produs = $row['nume_produs'];

$pret = $row['pret_produs'];
$pret_modif = str_replace('.', ',', $row['pret_produs']) . " LEI";
$pret_vechi = $row['pret_vechi_produs'];
$pret_vechi_modif = str_replace('.', ',', $row['pret_vechi_produs']) . " LEI";

$descriere_produs = $row['descriere_produs'];
$id_categorie_produs = $row['id_categorie_produs'];
$data_adaugare_produs = $row['data_adaugare_produs'];

$imagini = $object->getRows("SELECT * FROM imagini WHERE id_produs_imagine = ?", [$id]);

}

?>
    <!-- ##### Single Product Details Area Start ##### -->
    <section class="single_product_details_area d-flex align-items-center">

        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
              <?php foreach ($imagini as $img) {

                echo '<img src="'. $object->photoPath() . $img['nume_imagine'] .'" alt="">';

              } ?>
            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span></span>
                <h2><?php echo $nume_produs; ?></h2>
            <?php
            if ($pret_vechi < 1) {
              echo '<p class="product-price">'.$pret_modif.'</p>';
            } elseif ($pret_vechi > 0) {
              echo '<p class="product-price"><span class="old-price">'.$pret_vechi_modif.'</span>'. $pret_modif.'</p>';
            }

            ?>
            <p class="product-desc"><?php echo $descriere_produs; ?></p>

            <!-- Form -->
            <?php

              if (isset($_POST['addtocart'])) {
                $cartArray = array('id' => $_POST['p_id'], 'marime' => $_POST['size'], 'cantitate' => $_POST['cantitate']);

                array_push($_SESSION['cart'], $cartArray);
                header("Refresh: 0");
              }
              ?>

            <form action="" class="cart-form clearfix" method="post">
                <!-- Select Box -->
                <div class="row">
                  <div class="form-group">
                      <label class="mt-15 ml-15" for="title">Marime</label>
                      <div class="col-sm-2">
                        <select name="size" id="productSize" class="quantity">
                            <option value="xl">XL</option>
                            <option value="l">L</option>
                            <option value="m" selected>M</option>
                            <option value="s">S</option>
                            <option value="xs">XS</option>
                        </select>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="mt-15 ml-15" for="title">Cantitate</label>
                    <div class="col-sm-2">
                      <input type="text" value="1" name="cantitate" class="quantity">
                    </div>
                  </div>
                </div>
                <input type="hidden" name="p_id" value="<?php echo $id_produs; ?>">
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->
                    <button type="submit" name="addtocart" class="btn essence-btn">Adaugare in cos</button>
                </div>

            </form>
        </div>
    </section>
    <!-- ##### Single Product Details Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <?php include "includes/footer.php"; ?>
</body>

</html>
