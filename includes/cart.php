<?php
if ( empty( $_SESSION['cart'] ) ) {
    $_SESSION['cart'] = [];
}

// if ( isset( $_POST['remove_item'] ) ) {
//     $itemID = $_POST['remove_item'];
//     if ( isset( $_SESSION['cart'][ $itemID ] ) ) {
//         unset( $_SESSION['cart'][ $itemID ] );
//     }
//
//     echo $itemID;
//     die();
// }

 ?>

<div class="cart-bg-overlay"></div>

<div class="right-side-cart-area">

    <!-- Cart Button -->
    <div class="cart-button">
        <a href="#" id="rightSideCart"><img src="img/core-img/shopping_cart36dp.png" alt=""> <span><?php echo count($_SESSION['cart']); ?></span></a>
    </div>

    <div class="cart-content d-flex">

        <!-- Cart List Area -->
        <div class="cart-list">

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


          ?>


            <!-- Single Cart Item -->
            <div class="single-cart-item" id="single-cart-item-<?php echo $item['id']; ?>">
                <a href="#" class="product-image">
                  <?php foreach ($imagini as $img) {

                    echo '<img src="'. $object->photoPath() . $img['nume_imagine'] .'" alt="">';

                  } ?>
                    <!-- Cart Item Desc -->
                    <div class="cart-item-desc">
                      <!-- <span class="product-remove"><i onclick="removeItem('<?php $item['id']; ?>')" class="fa fa-close" aria-hidden="true"></i></span> -->

                        <!-- <span class="badge">Mango</span> -->


                        <h6><?php echo $row['nume_produs']; ?></h6>
                        <p class="size">Marime: <?php echo $item['marime']; ?></p>
                        <p class="color">Cantitate: <?php echo $item['cantitate']; ?></p>
                        <p class="price"><?php echo $pret; ?></p>
                    </div>
                </a>
            </div>


          <?php } }
          endforeach;
          ?>

        </div>

        <!-- Cart Summary -->
        <div class="cart-amount-summary">

            <h2>Sumar</h2>
            <ul class="summary-table">
                <li class="bottomed"><span>Subtotal:</span> <span><?php echo $subtotal_modif; ?></span></li>
                <li class="bottomed">
                  <span>Livrare:</span>
                  <span>
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
                  </span>
                </li>

                <li class="bottomed">
                  <span>Total:</span>
                  <span>
                    <?php
                    if ($subtotal > 0) {
                      if (is_numeric($livrare)) {
                        echo $subtotal + $livrare . " Lei";
                      } else {
                        echo $subtotal_modif;
                      }
                    } else {
                      echo 0 . " Lei";
                    }
                    ?>
                  </span>
                </li>


            </ul>

            <div class="row">
              <div class="col-sm" style="margin: 5px">
                <button type="button" class="btn btn-seccondary" aria-pressed="false" autocomplete="off">
                  <a class="" href="checkout.php">Pasul Urmator</a>
                </button>
              </div>
              <div class="col-sm" style="margin: 5px">
                <button type="button" class="btn btn-warning" aria-pressed="false" autocomplete="off">
                  <a class="" href="includes/goleste_cos.php">Goleste Cosul</a>
                </button>
              </div>
            </div>

        </div>
    </div>
</div>
<!-- ##### Right Side Cart End ##### -->
<!-- <script type="text/javascript">

    function removeItem( itemID ) {

        // make AJAX request to server to remove item from session.
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "cart.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("remove_item=" + itemID);
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                var element = document.getElementById("single-cart-item-" + this.responseText);
                if (element !== null) {
                    element.remove();
                }
            }
        };

    }

</script> -->
