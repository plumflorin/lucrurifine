
<?php include "includes/head.php"; ?>
<?php
if (empty($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}
?>
<body>

<!-- ##### Checkout Area Start ##### -->
<div class="checkout_area section-padding-80">
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-6">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-page-heading mb-30">
                        <h5>Adresa de Livrare</h5>
                    </div>

                    <form action="final_comanda.php" method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">Nume <span>*</span></label>
                                <input name="nume" type="text" class="form-control" id="first_name" value="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name">Prenume <span>*</span></label>
                                <input name="prenume" type="text" class="form-control" id="last_name" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="street_address">Adresa Livrare <span>*</span></label>
                                <input name="adresa" type="text" class="form-control mb-3" id="street_address" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="city">Localitate <span>*</span></label>
                                <input name="localitate" type="text" class="form-control" id="city" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="state">Judet <span>*</span></label>
                                <input name="judet" type="text" class="form-control" id="state" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone_number">Numar Telefon <span>*</span></label>
                                <input name="telefon" type="number" class="form-control" id="phone_number" min="0" value="" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="email_address">Email <span>*</span></label>
                                <input name="email" type="email" class="form-control" id="email_address" value="" required>
                            </div>




                            <!-- <div class="col-12">
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Terms and conditions</label>
                                </div>
                                <div class="custom-control custom-checkbox d-block mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">Create an accout</label>
                                </div>
                            </div> -->
                        </div>

                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                <div class="order-details-confirmation">

                    <div class="cart-page-heading">
                        <h5>Comanda Dumneavoastra</h5>

                    </div>


                    <ul class="order-details-form mb-4">
                        <li><span>Produse</span> <span>Total</span></li>
                        <?php
                        $subtotal = 0;
                        $livrare = 17;
                        $subtotal_modif = 0 . " Lei";
                        $object = new Produs();

                        $cartItems = $_SESSION['cart'];

                        foreach ($cartItems as $item):
                          $rows = $object->getRows("SELECT * FROM produs");

                          foreach ($rows as $row) {
                            //$subtotal += $row['pret_produs'];

                          if ($item['id'] == $row['id_produs']) {
                            $imagini = $object->getRows("SELECT * FROM imagini WHERE id_produs_imagine = ? LIMIT 1", [$row['id_produs']]);

                            $pret = $row['pret_produs'];
                            $pret_modif = str_replace('.', ',', $row['pret_produs']) . " LEI";
                            $pret_vechi = $row['pret_vechi_produs'];
                            $pret_redus_modif = str_replace('.', ',', $row['pret_vechi_produs']) . " LEI";


                            $subtotal = $subtotal + ($pret * $item['cantitate']);
                            $subtotal_modif = str_replace('.', ',', $subtotal) . " LEI";



                        echo "<li style='background:  #ffe6f2 '><span>" . $row['nume_produs'] . " (cantitate: " . $item['cantitate'] . ")</span> <span>" . $row['pret_produs'] * $item['cantitate'] . " LEI</span></li>";
                        }
                        }
                        endforeach;
                        ?>
                        <li><span>Subtotal</span> <span><?php echo $subtotal_modif; ?></span></li>
                        <li><span>Livrare</span> <span>
                          <?php
                          if ($subtotal_modif > 0) {
                            if ($subtotal_modif < 200) {
                              echo $livrare . " Lei";
                            } else {
                              echo $livrare ='GRATUITA';
                            }
                          } else {
                            echo 0 . " Lei";
                          }
                          ?>
                        </span></li>
                        <li><span>Total</span> <span>
                          <?php
                          if ($subtotal > 0) {
                            if (is_numeric($livrare)) {
                              echo $total_comanda = $subtotal + $livrare . " Lei";
                            } else {
                              echo $total_comanda = $subtotal_modif;
                            }
                          } else {
                            echo $total_comanda = 0 . " Lei";
                          }
                          ?>
                        </span></li>
                    </ul>

                    <input type="hidden" name="total_comanda" value="<?php echo $total_comanda; ?>">

                    <p><strong>Metoda de plata:    plata la livrare.</strong></p>

                    <!-- <div id="accordion" role="tablist" class="mb-4">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h6 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-circle-o mr-3"></i>cash on delievery</a>
                                </h6>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Metoda de plata: plata la livrare.</p>
                                </div>
                            </div>
                        </div>
                    </div> -->


                </div>
            </div>
            <div class="col-12 mb-4">
                <button type="submit" name="comanda" class="btn btn-info">Plaseaza comanda</button>
            </div>
          </form>
        </div>
    </div>
</div>
<!-- ##### Checkout Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <?php include "includes/footer.php"; ?>
</body>

</html>
