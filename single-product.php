
<?php include "includes/head.php"; ?>
<body>
  <?php
if (isset($_GET['p_id'])) {

$id = $_GET['p_id'];

$object = new Produs();
$row = $object->getRow("SELECT * FROM produs WHERE id_produs = ?", [$id]);
$id_produs = $row['id_produs'];
$nume_produs = $row['nume_produs'];
$pret_produs = $row['pret_produs'];
$pret_redus_produs = $row['pret_redus_produs'];
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
            <span>mango</span>
            <a href="cart.html">
                <h2><?php echo $nume_produs; ?></h2>
            </a>
            <?php  if ($pret_redus_produs == 0) {
              echo '<p class="product-price">'.$pret_produs.'</p>';
            } elseif ($pret_redus_produs > 0) {
              echo '<p class="product-price"><span class="old-price">'.$pret_produs.'</span>'. $pret_redus_produs.'</p>';
            }

            ?>
            <p class="product-desc"><?php echo $descriere_produs; ?></p>

            <!-- Form -->
            <form class="cart-form clearfix" method="post">
                <!-- Select Box -->
                <div class="select-box d-flex mt-50 mb-30">
                    <select name="select" id="productSize" class="mr-5">
                        <option value="value">Size: XL</option>
                        <option value="value">Size: X</option>
                        <option value="value">Size: M</option>
                        <option value="value">Size: S</option>
                    </select>
                    <select name="select" id="productColor">
                        <option value="value">Color: Black</option>
                        <option value="value">Color: White</option>
                        <option value="value">Color: Red</option>
                        <option value="value">Color: Purple</option>
                    </select>
                </div>
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->
                    <button type="submit" name="addtocart" value="5" class="btn essence-btn">Add to cart</button>
                </div>
            </form>
        </div>
    </section>
    <!-- ##### Single Product Details Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <?php include "includes/footer.php"; ?>
</body>

</html>
