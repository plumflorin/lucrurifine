<?php include "app/class.produs.php"; ?>
<?php
if (empty($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}
  ?>

<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="index.php"><img src="img/core-img/logo.png" alt=""></a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>
            <!-- Menu -->
            <div class="classy-menu">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                    <ul>
                      <li><a href="shop.php">Toate modelele</a></li>
                      <?php

                      $object = new Produs();
                      $enumCat = $object->getRows("SELECT * FROM categorie");
                      foreach ($enumCat as $categorie) {
                        echo '<li><a href="shop.php?categorie=' . $categorie['nume_categorie'] . '">' . ucwords($categorie['nume_categorie']) .'</a></li>';
                      }
                      ?>
                    </ul>
                </div>
                <!-- Nav End -->
            </div>
        </nav>

        <!-- Header Meta Data -->
        <div class="header-meta d-flex clearfix justify-content-end">
          <!-- Livrare Area -->
          <div class="user-login-info">
              <a href="#">Livrare</a>
          </div>
          <!-- Contact Area -->
          <div class="user-login-info">
              <a href="#">Contact</a>
          </div>
            <!-- Cart Area -->
            <div class="cart-area">
                <a href="#" id="essenceCartBtn"><img src="img/core-img/shopping_cart36dp.png" alt=""> <span><?php echo count($_SESSION['cart']); ?></span></a>
            </div>
        </div>

    </div>
</header>
<!-- ##### Header Area End ##### -->
