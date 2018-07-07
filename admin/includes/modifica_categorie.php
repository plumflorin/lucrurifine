<!-- Edit category form -->
<form class="" action="" method="post">
<div class="form-group">
  <label for="cat_title">Modifica Categorie</label>

  <?php
  if (isset($_GET['modifica'])) {

    $object = new Produs();
    $row = $object->getRow ("SELECT * FROM categorie WHERE id_categorie = ?", [$_GET['modifica']]);

  } ?>

  <input value="<?php if (isset($row['nume_categorie'])) { echo $row['nume_categorie']; } ?>" class="form-control" type="text" name="nume_categorie">




<?php //update query
  if (isset($_POST['modificare_categorie'])) {
    $id_categorie = $_GET['modifica'];
    $object = new Produs();
    $row = $object->updateRow("UPDATE categorie SET nume_categorie = ? WHERE id_categorie = ?", [$_POST['nume_categorie'], $id_categorie]);
    header ("Location: categorii.php");
  }

 ?>


</div>
<div class="form-group">
  <input class="btn btn-primary" type="submit" name="modificare_categorie" value="Update Category">
</div>

</form>
