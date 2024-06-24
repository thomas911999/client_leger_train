<?php

require_once __DIR__ . '/../bdd.php';
try{
    $bdd = DatabaseConnection();

// Configuration du mode d'erreur de PDO
//$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupération des données du formulaire
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$adresse = isset($_POST['adresse']) ? $_POST['adresse'] : '';
$cp = isset($_POST['cp']) ? $_POST['cp'] : '';
$login = isset($_POST['name']) ? $_POST['name'] : '';
$pass = isset($_POST['pass']) ? $_POST['pass'] : '';

// Préparation de la requête SQL pour insérer les données
$sql = "INSERT INTO voyageur (prenom, nom, adresse, cp, login, mdp) VALUES (:prenom, :nom, :adresse, :cp, :login, :pass)";

// Préparation de la déclaration
$stmt = $bdd->prepare($sql);

 // Liaison des paramètres
 $stmt->bindParam(':prenom', $prenom);
 $stmt->bindParam(':nom', $nom);
 $stmt->bindParam(':adresse', $adresse);
 $stmt->bindParam(':cp', $cp);
 $stmt->bindParam(':login', $login);
 $stmt->bindParam(':pass', $pass);

 // Exécution de la déclaration
 $stmt->execute();

 echo "Nouvel enregistrement créé avec succès";
 header("Location: ../../index.php");
} catch (PDOException $e) {
 echo "Erreur: " . $e->getMessage();
}

// Fermeture de la connexion
$conn = null;

?>