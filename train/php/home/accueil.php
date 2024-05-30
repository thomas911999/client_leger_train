<?php

session_start();

// Vérifier si l'utilisateur est connecté

if (!isset($_SESSION['login'])) {

    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté

    header("Location: ../../index.php");

    exit;

}

?><!doctype html>
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
          <a class="nav-link active" aria-current="page" href="historique.php">Mes voyages</a>
          <a href="logout.php">Déconnexion</a>
        </li>
<?php
require_once __DIR__ . '/../bdd.php';
$bdd = DatabaseConnection();
$query = "SELECT id_train, V_DEPART, V_ARRIVEE,H_DEPART, image, modele, prix_billet  FROM billet natural join train ";
$statement = $bdd->prepare($query);
$statement->execute();
while ($train = $statement->fetch(PDO::FETCH_OBJ)) {

  $query = "SELECT id_ville, libelle  FROM ville WHERE  id_ville='$train->V_DEPART'";
  $statement_dep = $bdd->prepare($query);
  $statement_dep->execute();
  $v_dep = $statement_dep->fetch(PDO::FETCH_OBJ)->libelle; 
  
  $query = "SELECT id_ville, libelle  FROM ville WHERE  id_ville='$train->V_ARRIVEE'";
  $statement_arr = $bdd->prepare($query);
  $statement_arr->execute();
  $v_arrivee = $statement_arr->fetch(PDO::FETCH_OBJ)->libelle;

    ?>
    <section id='principale'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='card col-3' style='width: 18rem;'>
                <img src="../../<?=$train->image;?>">
                    <div class='card-body'>
                        <h2 class='card-subtitle'><?php echo $train->modele; ?></h2>
                        <h3 class='card-subtitle'><em><?php echo $v_dep; ?> </em> vers <em> <?php echo $v_arrivee; ?> </em> </h3>
                       <h5 class='card-subtitle'><?php echo $train->prix_billet; ?> €</h5>
                        <a href='reservation.php?choix=<?=$train->id_train?>&v_dep=<?=$train->V_DEPART?>&v_arr=<?=$train->V_ARRIVEE?>&h_dep=<?=$train->H_DEPART?>'><button type="button" class="btn btn-primary">Réserver</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>
</div>
  </div>
</nav>