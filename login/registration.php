<?php include "includes/head.php"; ?>

<?php

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if(!empty($username) && !empty($password)) {

  $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

  $object = new Produs();
  $object->insertRow("INSERT INTO users
            (username, password)
            VALUES (?, ?)", [$username, $password]);


$message = "Your registration has been submited";

  } else {

$message = "Fields cannot be empty";

  }

} else {

  $message = "";
}

 ?>


  <!-- Page Content -->

  <div class="container">

    <section id="login">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 offset-sm-3">
            <div class="form-wrap">
            <h1>Register</h1>
                <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                  <h6><?php echo $message; ?></h6>
                  <div class="form-group">
                    <label for="username" class="sr-only">username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter Desired Username">
                  </div>
                  <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" class="form-control" id="key" placeholder="Password">
                  </div>

                  <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <hr>

    <?php //include "includes/footer.php"; ?>

  </div>
