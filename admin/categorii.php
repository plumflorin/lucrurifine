<?php include "includes/head.php"; ?>
<?php include_once "../app/class.dbh.php"; ?>
<?php include_once "../app/class.produs.php"; ?>


  <!-- Navigation-->
  <?php include "includes/nav.php"; ?>

  <div class="content-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
              Welcome to Admin
              <small>Author</small>
          </h1>
        </div>
      </div>



      <div class="row">
      <div class="col-sm-4">

          <!-- Add category form -->
        <form class="" action="" method="post">
          <div class="form-group">
            <label for="cat_title">Adaugare Categorie</label>
            <input class="form-control"type="text" name="titlu_categorie">
          </div>
          <div class="form-group">
            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
          </div>

          <?php

            if(isset($_POST['submit'])) {
            $object = new Produs();
            $object->insertRow ("INSERT INTO categorie (nume_categorie) VALUE (?)", [$_POST['titlu_categorie']]);
            }
          ?>

        </form>

        <?php
            if (isset($_GET['modifica'])) {
              $id_categorie = $_GET['modifica'];
              include "includes/modifica_categorie.php";
            }

         ?>


        </div>
        <div class="col-sm-8">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Category Title</th>
                <th>Modifica</th>
                <th>Sterge</th>
              </tr>
            </thead>
        <?php
          $object = new Produs();
          $rows = $object->getRows ("SELECT * FROM categorie");
          foreach ($rows as $row): ?>

            <tbody>
              <tr>
                <?php
                    echo "<td>".$row['id_categorie']."</td>";
                    echo "<td>".$row['nume_categorie']."</td>";
                    echo "<td><a href='categorii.php?modifica=".$row['id_categorie']."'>Edit</a></td>";
                    echo "<td><a href='categorii.php?sterge=".$row['id_categorie']."'>Sterge</a></td>";
                  endforeach;
                 ?>

              </tr>
            </tbody>

          </table>


        </div>


</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>




    <?php
    if (isset($_GET['sterge'])) {

      $object = new Produs();
      $row = $object->deleteRow("DELETE FROM categorie WHERE id_categorie = ?", [$_GET['sterge']] );
      header ("Location: categorii.php");
    }

     ?>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <?php include "includes/footer.php"; ?>

</body>
</html>
