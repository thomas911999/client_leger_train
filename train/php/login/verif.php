<?php
require_once __DIR__ . '/../bdd.php';

    try{
    $bdd = DatabaseConnection();

    // Configuration du mode d'erreur de PDO pour lancer des exceptions
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Démarrage de la session
    session_start();

    $name = $_POST["name"];
    $pass = $_POST["pass"];

    $query = "SELECT login, mdp FROM voyageur WHERE login = ?";

     // Préparation de la déclaration
    $statement = $bdd->prepare($query);
    
    // Liaison des paramètres avec les valeurs des variables
    $statement->bindParam(1, $login, PDO::PARAM_STR);
    
    // Exécution de la déclaration SQL
    $statement->execute();

    // Récupération du résultat
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe
    if ($name==$result && password_verify($pass, $result['mdp'])) {
        // Connexion réussie, démarrage de la session
        $_SESSION['login'] = $login;
        // Redirection vers la page d'accueil ou une autre page sécurisée
        header("Location: ../home/accueil.php");
        exit(); // Assurez-vous de quitter le script après la redirection
    } else {
        // Connexion échouée
        echo "Nom d'utilisateur ou mot de passe incorrect.";
        header("Location: ../../index.php");
    }
} catch (PDOException $e) {
    // En cas d'erreur, affichage du message d'erreur
    echo "Erreur: " . $e->getMessage();
}

// Fermeture de la connexion
$bdd = null;
?>