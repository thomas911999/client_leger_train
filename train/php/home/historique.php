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
  <nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="accueil.php">Accueil</a>
          <a class="nav-link active" aria-current="page" href="logout.php">Déconnexion</a>
        </li>
        <?php
        require_once __DIR__ . '/../bdd.php';

        $bdd = DatabaseConnection();
        $userId=$_GET["choix"];
        
        $query=" select date_reservation, id_train, libelle from reservation join ville on reservation.v_depart=ville.Id_ville where id_voyageur='$userId' ";
        $statement = $bdd->prepare($query);
        $statement->execute();
        while($train = $statement->fetch(PDO::FETCH_OBJ)) {
        ?>
        <section id='principale'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='card col-3' style='width: 18rem;'>
                    <div class='card-body'>
                        <h3 class='card-subtitle'>Date de la réservation: </h3><h5><?php echo $train->date_reservation; ?></h5>
                        <h3 class='card-subtitle'>Gare de départ: </h3><h5><?php echo $train->libelle; ?></h5>
                       <h3 class='card-subtitle'><em>Numero du train: </h3><h5><?php echo $train->id_train; ?></h5>
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