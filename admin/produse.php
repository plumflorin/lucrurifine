<?php include "includes/head.php"; ?>
<?php include_once "../app/class.produs.php"; ?>


  <!-- Navigation-->
  <?php include "includes/nav.php"; ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
              Welcome to Admin
              <small>Author</small>
          </h1>
        </div>
      </div>

          <form class="" action="" method="post">
            <div class="row">
              <div class="col-sm-4">

                  <select class="form-control" name="bulk_options">
                    <option value="">Select Options</option>
                    <option value="published">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                    <option value="clone">Clone</option>
                  </select>
                </div>


                <div class="col-sm-4">
                  <input type="submit" name="submit" class="btn btn-success" value="Apply">
                  <a class="btn btn-primary" href="posts.php?src=adaug_produs">Add New</a>
                </div>
            </div>
    <div class="row">
      <table class="table  table-bordered table-hover">
        <thead>
          <tr>
            <th><input id="selectAllBoxes" type="checkbox"</th>
            <th>Id</th>
            <th>Nume</th>
            <th>Pret</th>
            <th>Pret Vechi</th>
            <th>Descriere</th>
            <th>Imagine</th>
            <th>Categorie</th>
            <th>Data Adaugare</th>
            <th>Status</th>
            <th>Editare</th>
            <th>Stergere</th>
          </tr>
        </thead>
        <tbody>
          <?php
              $object = new Produs();
              $rows = $object->getRows("SELECT * FROM produs ORDER BY data_adaugare_produs");
              $photoPath = $object->photoPath();
              foreach ($rows as $row) :
                  $id_produs = $row['id_produs'];
                  $nume_produs = $row['nume_produs'];
                  $pret_produs = $row['pret_produs'];
                  $pret_vechi = $row['pret_vechi_produs'];
                  $descriere_produs = $row['descriere_produs'];
                  $id_categorie_produs = $row['id_categorie_produs'];
                  $data_adaugare_produs = $row['data_adaugare_produs'];
                  $status_produs = $row['status_produs'];

              $row = $object->getRow("SELECT * FROM categorie WHERE id_categorie = ?", [$id_categorie_produs]);
              $cat_id = $row['nume_categorie'];



          ?>
          <tr>
            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php //echo $post_id; ?>'></td>
            <td><?php echo $id_produs; ?></td>
            <td><a href="../single-product.php?p_id=<?php echo $id_produs; ?>"><?php echo $nume_produs; ?></a></td>
            <td><?php echo $pret_produs; ?></td>
            <td><?php echo $pret_vechi; ?></td>
            <td><?php echo $descriere_produs; ?></td>
            <td>
              <?php
              $object = new Produs();
              $rows = $object->getRow("SELECT * FROM imagini WHERE id_produs_imagine = ?", [$id_produs]);
              $nume_imagine = $rows["nume_imagine"];
                echo "<img width='50' src='../". $photoPath . $nume_imagine ."' alt='image'>";

              ?>
            </td>
            <td><?php echo $cat_id; ?></td>
            <td><?php echo $data_adaugare_produs; ?></td>
            <td><?php echo $status_produs; ?></td>


            <td><a href='modif_produs.php?p_id=<?php echo $id_produs; ?>'>Edit</a></td>
            <td><a  href='produse.php?delete=<?php echo $id_produs; ?>'>Delete</a></td>
          </tr>
        </tbody>
      <?php  endforeach; ?>
      </table>
    </div>
      <div class="row">


      <?php

      if (isset($_GET['delete'])) {
        $id_produs = $_GET['delete'];

        $object = new Produs();
        $object->deleteRow("DELETE FROM produs WHERE id_produs = ?", [$id_produs]);
        $object->deleteRow("DELETE FROM imagini WHERE id_produs_imagine = ?", [$id_produs]);
        $delete = $object->getRows("SELECT * FROM imagini WHERE id_produs_imagine = ?", [$id_produs]);

        foreach ($delete as $del) {
          $file = $photoPath . $del['nume_imagine'];
          unlink ($file);
        }
        header ("Location: produse.php");
      }


       ?>
       </div>
      </div>
    </div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <?php include "includes/footer.php"; ?>

</body>
</html>
