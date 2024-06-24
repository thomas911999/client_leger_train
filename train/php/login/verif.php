<?php

require_once __DIR__ . '/../bdd.php';
try{
    $bdd = DatabaseConnection();
   // Récupération des données du formulaire
    $name = $_POST['name'];
    $pass = $_POST['pass'];

    // Préparation de la requête SQL pour sélectionner le login et le mot de passe 
    $query = "SELECT id_voyageur,login, mdp FROM voyageur WHERE login = ?";
    $statement = $bdd->prepare($query);
    $statement->bindParam(1, $name, PDO::PARAM_STR);
    $statement->execute();
    
    // Récupération du résultat
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe
    if ($result && $pass=$result['mdp']) {
        // Connexion réussie
        session_start();
        //$_SESSION['login'] = $name;
        // Ajoutez cette ligne pour stocker l'identifiant de l'utilisateur
        $_SESSION['id_voyageur'] = $result['id_voyageur'];
        header("Location: ../home/accueil.php");
        exit();
    } else {
        // Connexion échouée
        echo "Nom d'utilisateur ou mot de passe incorrect.";
        header("Location: ../../index.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>