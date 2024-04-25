<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
  <body>
  <nav class="navbar navbar-expand-lg bg-primary">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="accueil.php">Accueil</a>
        </li>
        <?php
require_once __DIR__ . '/../bdd.php';
$bdd = DatabaseConnection();


$id_train = $_POST['id_train'];
$h_dep = $_POST['h_dep'];
$v_arr = $_POST['v_arr'];
$v_dep = $_POST['v_dep'];

$enfant=$_POST["enfant"];
$adulte=$_POST["adulte"];
$senior=$_POST["senior"];
$date = date('Y-m-d H:i'); // Format YYYY-MM-DD HH:MM
$query = "insert into reservation(nb_adulte,nb_senior,nb_enfant,id_voyageur,date_reservation,id_train, v_depart, H_depart, v_arrivee ) values('$adulte','$senior','$enfant',1, '$date','$id_train','$v_dep', '$h_dep', '$v_arr' )";
$statement = $bdd->prepare($query);
$statement->execute();

    ?>    
  </div>
</nav>