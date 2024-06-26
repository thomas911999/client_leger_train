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

$id_train = $_POST['id_train'];
$h_dep = $_POST['h_dep'];
$v_arr = $_POST['v_arr'];
$v_dep = $_POST['v_dep'];
$enfant=$_POST["enfant"];
$adulte=$_POST["adulte"];
$senior=$_POST["senior"];
$userId=$_POST["choix"];
$date = date('Y-m-d H:i'); // Format YYYY-MM-DD HH:MM
try {
  // Vérifier si la réservation existe déjà
  $checkQuery = "SELECT COUNT(*) FROM reservation WHERE id_voyageur = :userId AND id_train = :id_train";
  $checkStmt = $bdd->prepare($checkQuery);
  $checkStmt->bindParam(':userId', $userId);
  $checkStmt->bindParam(':id_train', $id_train);
  $checkStmt->execute();
  $count = $checkStmt->fetchColumn();

  if ($count > 0) {
      // L'utilisateur a déjà réservé ce train
      echo "<script>
      alert('Vous avez déjà réservé ce train');
      setTimeout(function() {
          window.location.href = 'accueil.php';
      }); 
    </script>";
  }else{
$query = "insert into reservation(nb_adulte,nb_senior,nb_enfant,id_voyageur,date_reservation,id_train, v_depart, H_depart, v_arrivee ) values('$adulte','$senior','$enfant','$userId', '$date','$id_train','$v_dep', '$h_dep', '$v_arr' )";
$statement = $bdd->prepare($query);
$statement->execute();
      echo "<script>
      alert('Bienvenue à bord');
      setTimeout(function() {
           window.location.href = 'accueil.php';
      });</script>";
   exit();
}
} catch (Exception $e) {
// En cas d'erreur, afficher le message d'erreur
echo "Erreur: " . $e->getMessage();
}
?>
  
  </div>
</nav>