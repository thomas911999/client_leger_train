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
$query = "SELECT capacite, villedep, villearrivee,image FROM train where id_train='$libelle'";
$statement = $bdd->prepare($query);
$statement->execute();
while ($train = $statement->fetch(PDO::FETCH_OBJ)) {
    ?>
    <section id='principale'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='card col-3' style='width: 18rem;'>
                <img src="../../<?=$train->image;?>">
                    <div class='card-body'>
                        <h3 class='card-subtitle'><em><?php echo $train->villedep; ?> </em> vers <em> <?php echo $train->villearrivee; ?> </em> </h3>
                        <h5 class='card-subtitle'><?php echo $train->capacite; ?> places</h5>
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