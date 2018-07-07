<?php include "includes/head.php"; ?>
<?php include_once "../app/class.produs.php"; ?>
<?php include "includes/nav.php"; ?>

<div class="content-wrapper">
  <div class="container">


<?php

if (isset($_POST['creare_produs'])) {
    $nume_produs = $_POST['titlu'];
    $categorie_produs = $_POST['categorie_produs'];
    $pret_produs = $_POST['pret_produs'];
    $pret_redus_produs = $_POST['pret_redus_produs'];
    $descriere = $_POST['descriere'];
    $status = $_POST['status'];
    //$image =$_FILES['files']['name'];


    $object = new Produs();
    $photoPath = $object->photoPath();
    $row = $object->insertRow ("INSERT INTO produs
                            (nume_produs, pret_produs, pret_redus_produs, descriere_produs, id_categorie_produs, status_produs)
                            VALUES (?, ?, ?, ?, ?, ?)", [$nume_produs, $pret_produs, $pret_redus_produs, $descriere, $categorie_produs, $status]);

    $last_inserted_id = $object->lastInsertId();
    //var_dump ($last_inserted_id);


    for ($i=0; $i<count($_FILES['images']['tmp_name']); $i++ ){
        $imgtmp = $_FILES['images']['tmp_name'][$i];
        $imgname = $_FILES['images']['name'][$i];
        $tmpname = explode(".",$imgname);
        $newfilename = current($tmpname) . time() . rand(0, 9999) . '.' . end($tmpname);

        move_uploaded_file($imgtmp, "../". $photoPath . $newfilename);


        $object = new Produs();
        $row = $object->insertRow ("INSERT INTO imagini
                                (id_produs_imagine, nume_imagine)
                                VALUES (?, ?)", [$last_inserted_id, $newfilename]);


    }
  echo '<div class="col-sm-12">';
  echo '<div class="alert alert-success" role="alert">';
  echo "Produs adaugat!<a href=''> Vizualizeaza produsul</a> sau vezi <a href='produse.php'> Lista Toate Produsele</a>";
  echo "</div>";
  echo "</div>";

}
 ?>

<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

  <div class="form-group row">
    <label class="col-sm-2 col-form-label"for="title">Nume Produs</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" name="titlu">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-form-label col-sm-2" for="post_category">Categorie</label>
    <div class="col-sm-3">
      <select class="form-control" name="categorie_produs">
        <?php

        $object = new Produs();
        $rows = $object->getRows("SELECT * FROM categorie");
        foreach ($rows as $row) {
          $id = $row['id_categorie'];
          $categorie = $row['nume_categorie'];

          echo "<option value='$id'>$categorie</option>";
        }

         ?>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-form-label col-sm-2" for="title">Pret Produs</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="pret_produs">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-form-label col-sm-2" for="title">Pret Redus</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="pret_redus_produs">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-form-labell col-sm-2" for="post_content">Descriere Produs</label>
    <div class="col-sm-5">
        <textarea name="descriere" class="form-control" rows="5" width="15"></textarea>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-form-label col-sm-2" for="post_image">Imagine Produs</label>
    <div class="col-sm-5">
      <input type="file" class="form-control" name="images[]" multiple>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-form-label col-sm-2" for="post_status">Status Produs</label>
    <div class="col-sm-2">
      <select class="form-control" name="status">
        <option value="nelistat" selected>Nelistat</option>
        <option value="listat">Listat</option>
    </select>
    </div>
  </div>




  <div class="form-group row">

      <div class="col-sm-5 offset-sm-3">
        <input class="btn btn-primary" type="submit" name="creare_produs" value="Adauga Produs">
      </div>

  </div>
  </form>

  </div>
  </div>
</body>
  </html>
