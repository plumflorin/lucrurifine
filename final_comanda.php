<?php
ob_start();


include "includes/head.php";

if (isset($_POST['comanda'])) {
  if (empty($_SESSION['cart'])) {
    echo "Eroare! Cosul este gol";
  } else {
    $object = new Produs();
    $object->insertRow("INSERT INTO comanda
                            (nume_comanda, prenume_comanda, adresa_comanda, localitate_comanda, judet_comanda, telefon_comanda, email_comanda, total_comanda)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
                            [$_POST['nume'], $_POST['prenume'], $_POST['adresa'], $_POST['localitate'], $_POST['judet'], $_POST['telefon'], $_POST['email'], $_POST['total_comanda']]);

    $last_inserted_id = $object->lastInsertId();
    $cartItems = $_SESSION['cart'];
    foreach ($cartItems as $item) {
        $object->insertRow("INSERT INTO produse_comanda
                            (id_comanda, id_produs, marime_produs, numar_produse)
                            VALUES (?, ?, ?, ?)",
                            [$last_inserted_id, $item['id'], $item['marime'], $item['cantitate']]);
          }

    session_destroy();



  echo '<div class="container">';
    echo '<div class="row">';
      echo '<div class="col-12">';
       echo "<h1 style='color: #000099'>Comanda inregistrata cu succes</h>";
       echo "<h2 style='color: #0066ff'>Numarul de inregistrare al comenzii dumneavoastra este: " . $last_inserted_id . "</h>";
      echo '</div>';
    echo '</div>';
  echo '</div>';
  }
}

 ?>
