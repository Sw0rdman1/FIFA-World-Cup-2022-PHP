<?php

require "dbBroker.php";
require "model/fudbaler.php";
require "model/pozicija.php";
require "model/zemlja.php";
session_start();

if (!isset($_SESSION['korisnik_username'])) {
  header('Location:index.php');
  exit();
}

$rezultat = Fudbaler::getAll($conn);
$zemlje = Zemlja::getAll($conn);
$pozicije = Pozicija::getAll($conn);

if (!$rezultat) {
  echo "<script>alert('Greska prilikom vracanja fudbalera');</script>";
  exit();
}

if (!$zemlje) {
  echo "<script>alert('Greska prilikom vracanja zemalja');</script>";
  exit();
}



if ($rezultat->num_rows ==  0) {
  echo 'Nema fudbalera u bazi!';
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
  <title>Svetsko Prvenstvo 2022</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Finlandica:wght@500&display=swap');
  </style>

  <link rel="stylesheet" href="style.css">
  
  </head>

  <body>

  <div class="header" >
    <h1>FIFA World Cup 2022</h1>
    <p>Welcome, <?php echo $_SESSION['korisnik_username'] ?></p>
  </div>
  <div class="navar">
    <a class="active"  href="index.php">Log out</a>
  </div>




  <div class="container">

    <div class = "row">
      <h2>Search player by country </h2>
        <div>
          <form id="pretrazi" action="#" method="POST">
          <div class="form">
                  <div class="username-setion">
                    <input type="text" id="drzavaPretraga" required>
                    <label for="name" class="label-name">
                      <span class="content-name">Country</span>
                    </label>
                  </div>
                </div>
                <button class = "sort" type="button" onClick=funkcijaZaPretragu()>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Search players
                </button>          

              </form>
              <br>
              <h3>Sorting options</h3>
              <button  onclick="sortiraj(5)">Sort table by country
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </button>
              <button  onclick="sortiraj(4)">Sort table by positions
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </button>
              
        </div>
    </div>

    <div class="row1">
      <h2>Add a player</h2>
      <div class="addPlayer">
        <div>
          <form id="dodaj" action="#" method="POST">
            <table>
              <tr>
                  <div class="form" id ="unos">
                  <div class="username-setion">
                    <input type="text" name="ime" required>
                    <label for="name" class="label-name">
                      <span class="content-name">First name</span>
                    </label>
                  </div>
                  </div>
              </tr>
              <tr>
                <div class="form" id ="unos">
                  <div class="username-setion">
                    <input type="text" name="prezime" required>
                    <label for="name" class="label-name">
                      <span class="content-name">Last name</span>
                    </label>
                  </div>
                </div>                
              </tr>
              <div class="form" id ="unos">
                  <div class="username-setion">
                    <input type="text" name="brojDresa" required>
                    <label for="name" class="label-name">
                      <span class="content-name">Jersey number</span>
                    </label>
                  </div>
                </div>
              </tr>
              <tr>
                <td> <h5>Country:</h5> </td>
                <td class = "select-option">
                  <select name='zemlja'>
                    <?php while ($zemlja = $zemlje->fetch_array()) :  ?>
                      <option> <?php echo $zemlja['Naziv']; ?> </option>
                    <?php endwhile; ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td> <h5> Position: </h5></td>
                <td>
                  <select name='pozicija'>
                    <?php while ($pozicija = $pozicije->fetch_array()) :  ?>
                      <option> <?php echo $pozicija['Naziv']; ?> </option>
                    <?php endwhile; ?>
                  </select>
                </td>
              </tr>


              <tr>
                <td colspan='2'>
                  <button class = "sort" type="submit" id="dodaj">Add player
                  <span></span>
                <span></span>
                <span></span>
                <span></span>
                  </button>
                </td>
              </tr>

            </table>

        </div>
      </div>

    </div>

    <div class="row2">
      <table id="myTable">
              <thead>
                <tr>
                  <th> </th>
                  <th>Name</th>
                  <th>Last name</th>
                  <th>Jersey number</th>
                  <th>Position</th>
                  <th>Country</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($red = $rezultat->fetch_array()) : ?>
                  <tr>
                  <td>
                      <label class="custom-radio-btn">
                        <input type="radio" name="checked-donut" value=<?php echo $red["idFudbaler"] ?>>
                        <span class="checkmark"></span>
                      </label>
                    </td>
                    <td><?php echo $red["Ime"] ?></td>
                    <td><?php echo $red["Prezime"] ?></td>
                    <td><?php echo $red["BrojDresa"] ?></td>
                    <td><?php
                        $pozicija = Pozicija::getById($red["Pozicija"], $conn)->fetch_array();
                        echo $pozicija["Naziv"] ?></td>
                    <td><?php
                        $zemlja = Zemlja::getById($red["Zemlja"], $conn)->fetch_array();
                        echo $zemlja["Naziv"] ?></td>
                    
                  <?php endwhile;

                  ?>

                  </tr>
                  </form>
                  
              </tbody>
            </table>
            <button class="sort" type="submit" id="obrisi">Delete selected player</button>
    </div>

  </div>
        

          





          
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
          
          <script src="js/main.js"></script>

          <script>
            function sortiraj(col) {
              var table, rows, switching, i, x, y, shouldSwitch;
              table = document.getElementById("myTable");
              switching = true;

              while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                  shouldSwitch = false;
                  x = rows[i].getElementsByTagName("TD")[col];
                  y = rows[i + 1].getElementsByTagName("TD")[col];
                  if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                  }
                }
                if (shouldSwitch) {
                  rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                  switching = true;
                }
              }
            }

            function funkcijaZaPretragu() {
              var input, filter, table, tr, td, i, txtValue;
              input = document.getElementById("drzavaPretraga");
              filter = input.value.toUpperCase();
              table = document.getElementById("myTable");
              tr = table.getElementsByTagName("tr");
              for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[5];
                if (td) {
                  txtValue = td.textContent || td.innerText;
                  if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";
                  }
                }
              }
            }
          </script>
  </body>

</html>