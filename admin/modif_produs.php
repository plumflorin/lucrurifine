<?php include "includes/head.php"; ?>
<?php include_once "../app/class.produs.php"; ?>
<?php include "includes/nav.php"; ?>

<div class="content-wrapper">
  <div class="container">


<?php

if (isset($_GET['p_id'])) {
  $p_id = $_GET['p_id'];

}

if (isset($_POST['modif_produs'])) {
    $nume_produs = $_POST['titlu'];
    $categorie_produs = $_POST['categorie_produs'];
    $pret_produs = $_POST['pret_produs'];
    $pret_redus_produs = $_POST['pret_redus_produs'];

    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];

    $descriere = $_POST['descriere'];
    $status = $_POST['status'];

    move_uploaded_file($image_temp, "../img/product-img/$image");

    if (empty($image)) {
      $obj = new Produs();
      $list = $obj->getRow("SELECT * FROM produs WHERE id_produs = ?", [$p_id]);
      $image = $list['imagine_produs'];
    }

  $object = new Produs();
  $row = $object->insertRow ("UPDATE produs SET
                          nume_produs = ?, pret_produs = ?, pret_redus_produs = ?, descriere_produs = ?, imagine_produs = ?, id_categorie_produs = ?, status_produs = ?
                          WHERE id_produs = ?", [$nume_produs, $pret_produs, $pret_redus_produs, $descriere, $image, $categorie_produs, $status, $p_id]);

  echo '<div class="col-sm-5">';
  echo '<div class="alert alert-success" role="alert">';
  echo "Produs modificat!<a href=''> Vizualizeaza produsul</a> sau vezi <a href='produse.php'> Toate produsele</a>";
  echo "</div>";
  echo "</div>";
}

 ?>

<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

  <?php

  $obj = new Produs();
  $list = $obj->getRow("SELECT * FROM produs WHERE id_produs = ?", [$p_id]);


?>
  <div class="form-group">
    <label class="control-label col-sm-2 "for="title">Nume Produs</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="titlu" value="<?php echo $list['nume_produs']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="post_category">Categorie</label>
    <div class="col-sm-3">
      <select class="form-control" name="categorie_produs">
        <?php

        $object = new Produs();
        $rows = $object->getRows("SELECT * FROM categorie");
        foreach ($rows as $row) {
          $id = $row['id_categorie'];
          $nume_categorie = $row['nume_categorie'];


          switch ($id) {
            case $list['id_categorie_produs']:
              echo "<option value='$id' selected >$nume_categorie</option>";
              break;

            default:
              echo "<option value='$id'>$nume_categorie</option>";
              break;
          }

         }
         ?>
      </select>

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="title">Pret Produs</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="pret_produs" value="<?php echo $list['pret_produs']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="title">Pret Redus</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="pret_redus_produs" value="<?php echo $list['pret_redus_produs']; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="post_content">Descriere Produs</label>
    <div class="col-sm-5">
        <textarea name="descriere" class="form-control" rows="5" width="15"><?php echo $list['descriere_produs']; ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="post_image">Imagine Produs</label>
    <div class="col-sm-5">
      <input type="file" class="form-control" name="image">
      <img src="../img/product-img/<?php echo $list['imagine_produs']; ?>" width="300">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2" for="post_status">Status Produs</label>
    <div class="col-sm-2">
      <select class="form-control" name="status">
        <option value="nelistat" <?php if ($list['status_produs'] == 'nelistat') { echo 'selected'; } ?>>Nelistat</option>
        <option value="listat" <?php if ($list['status_produs'] == 'listat') {echo 'selected'; } ?>>Listat</option>
    </select>
    </div>
  </div>




  <div class="form-group">
      <div class="col-sm-4">
        <input class="btn btn-primary" type="submit" name="modif_produs" value="Modifica Produs">
      </div>

  </div>
  </form>

  </div>
  </div>
</body>
  </html>
