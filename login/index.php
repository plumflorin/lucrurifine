<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>LUCRURI FINE SHOP</title>

    <!-- Favicon  -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="../css/core-style.css">
    <link rel="stylesheet" href="../style.css">


    <?php session_start(); ?>
</head>

<body>


    <?php include "../app/class.produs.php"; ?>


<?php

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $object = new Produs();
  $user = $object->getRow("SELECT * FROM users WHERE username = ?",[$username]);

    if ($username == $user['username'] && password_verify($password, $user['password'])) {
      $_SESSION['username'] = $user['username'];

      header("Location: ../admin");
      exit;

    } else { ?>
      <div class="col-sm-4 offset-sm-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Username ori parola gresita!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>

      <?php
    }
}

?>
  <!-- Page Content -->

  <div class="container">

    <section id="login">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 offset-sm-3">
            <div class="form-wrap">
            <h1>Login</h1>
                <form role="form" action="index.php" method="post" id="login-form" autocomplete="off">
                  <div class="form-group">
                    <label for="username" class="sr-only">username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder=" Username">
                  </div>
                  <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" class="form-control" id="key" placeholder="Password">
                  </div>

                  <input type="submit" name="login" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log In">
                </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <hr>

  </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
