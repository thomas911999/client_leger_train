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
$libelle=$_GET["choix"];
$libelle_dep=$_GET["v_dep"];
$libelle_arr=$_GET["v_arr"];
$libelle_h=$_GET["h_dep"];
$query = "SELECT id_train, image, modele, V_DEPART,H_DEPART  FROM billet natural join train where id_train='$libelle'";
$statement = $bdd->prepare($query);
$statement->execute();

$query = "SELECT id_ville, libelle  FROM ville WHERE  id_ville='$libelle_dep'";
$statement_dep = $bdd->prepare($query);
$statement_dep->execute();
$v_dep = $statement_dep->fetch(PDO::FETCH_OBJ)->libelle;

$query = "SELECT id_ville, libelle  FROM ville WHERE  id_ville='$libelle_arr'";
$statement_arr = $bdd->prepare($query);
$statement_arr->execute();
$v_arrivee = $statement_arr->fetch(PDO::FETCH_OBJ)->libelle;

while ($train = $statement->fetch(PDO::FETCH_OBJ)) {
    ?>
    <section id='principale'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='card col-3' style='width: 18rem;'>
                <img src="../../<?=$train->image;?>">
                    <div class='card-body'>
                    <h2 class='card-subtitle'><?php echo $train->modele; ?></h2>
                       <h3 class='card-subtitle'><em><?php echo $v_dep ?> </em> vers <em> <?php echo $v_arrivee ?> </em> </h3> 
                        <h5 class='card-subtitle'><?php echo $train->H_DEPART; ?> </h5>
                        <form action="panier.php" method="POST">
                        <div class="container bg-secondary">
  <div class="mb-3 mt-3 ms-3 me-3">
    <label for="exampleInputEmail1" class="form-label text-light">Enfant</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre d'enfants" name="enfant">
   </div>
   <div class="mb-3 mt-3 ms-3 me-3">
    <label for="exampleInputEmail1" class="form-label text-light">Adulte</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre d'adultes" name="adulte">
   </div>
   <div class="mb-3 mt-3 ms-3 me-3">
    <label for="exampleInputEmail1" class="form-label text-light">Senior</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre de senior" name="senior">
   </div>
   <input type="hidden" name="id_train" value="<?php echo $libelle ?>">
   <input type="hidden" name="h_dep" value="<?php echo $libelle_h?>">
   <input type="hidden" name="v_arr" value="<?php echo $libelle_arr?>">
   <input type="hidden" name="v_dep" value="<?php echo $libelle_dep?>">
   <button type="submit" class="btn btn-primary">Valider</button>
</div>
                  </form>
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