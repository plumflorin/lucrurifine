<div class="col-12 col-md-4 col-lg-3">
    <div class="shop_sidebar_area">

        <!-- ##### Single Widget ##### -->
        <div class="widget category mb-50">
            <!-- Widget Title -->
            <h6 class="widget-title mb-30" style="font-size: 30px;">Categorii</h6>

            <!--  Catagories  -->
            <div class="catagories-menu">
                <ul id="menu-content2" class="menu-content">

                  <!-- Single Item -->

                  <li data-target="#Toate Modelele">
                      <a style="font-size: 20px;" href="shop.php">Toate Modelele</a>
                      <!-- <ul class="sub-menu collapse show" id="clothing">
                          <li><a href="#">All</a></li>
                          <li><a href="#">Bodysuits</a></li>
                      </ul> -->
                  </li>



                    <!-- Single Item -->

                    <?php
                    $object = new Produs();
                    $categorii = $object->getRows("SELECT * FROM categorie");
                    foreach ($categorii as $categorie) { ?>




                    <li data-target="#<?php echo $categorie['nume_categorie'] ?>">
                        <a style="font-size: 20px;" href="shop.php?categorie=<?php echo $categorie['nume_categorie'] ?>"><?php echo $categorie['nume_categorie'] ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>


        <!-- ##### Single Widget ##### -->
        <div class="widget color mb-50">
            <!-- Widget Title 2 -->
            <p class="widget-title2 mb-30">Color</p>
            <div class="widget-desc">
                <ul class="d-flex">
                    <li><a href="#" class="color1"></a></li>
                    <li><a href="#" class="color2"></a></li>
                    <li><a href="#" class="color3"></a></li>
                    <li><a href="#" class="color4"></a></li>
                    <li><a href="#" class="color5"></a></li>
                    <li><a href="#" class="color6"></a></li>
                    <li><a href="#" class="color7"></a></li>
                    <li><a href="#" class="color8"></a></li>
                    <li><a href="#" class="color9"></a></li>
                    <li><a href="#" class="color10"></a></li>
                </ul>
            </div>
        </div>


    </div>
</div>
