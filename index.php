<?php
require "model/korisnik.php";
require "dbBroker.php";

session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
  $uname = $_POST['username'];
  $upass = $_POST['password'];

  $korisnik = new Korisnik($uname, $upass, null);
  $odgovor = $korisnik->prijaviSe($conn);


  if ($odgovor->num_rows == 1) {
    $_SESSION['korisnik_username'] = $korisnik->username;
    header('Location: pocetna.php');
    $message = "Uspesno";
    exit();
    echo "<script>alert('$message');</script>";
  } else {
    $message = "Neuspesno";
    echo "<script>alert('$message');</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Prijava</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style>
@import url('https://fonts.googleapis.com/css2?family=Finlandica:wght@500&display=swap');
</style>

  <link rel="stylesheet" href="style.css">

</head>

<body>

  <div class="header" >
    <h1>FIFA World Cup 2022</h1>
    <p>Welcome!</p>
  </div>

    

  <div class="container-login">
    <div class="row-login">
        <h2>Log In</h2>

          <form method="POST">
            <table>
              <tr>
                <div class="form">
                  <div class="username-setion">
                    <input type="text" name="username" required>
                    <label for="name" class="label-name">
                      <span class="content-name">Username</span>
                    </label>
                  </div>
                </div>
              </tr>
              <tr>
              <div class="form">
                  <div class="username-setion">
                    <input type="password" name="password" required>
                    <label for="name" class="label-name">
                      <span class="content-name">Password</span>
                    </label>
                  </div>
                </div>
              </tr>
                <button type="submit" name="submit">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Log In
                </button>


            </table>

          </form>


    </div>
  </div>
  </html>