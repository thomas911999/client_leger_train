<?php

require_once __DIR__ . '/../bdd.php';

function pass_hash($password) {
    // Use bcrypt for password hashing
    return password_hash($password, PASSWORD_DEFAULT);
}

function check_login($login, $password) {
    $bdd = DatabaseConnection();
    $query = "SELECT login, mdp FROM user WHERE login = ?";
    
    $statement = $bdd->prepare($query);
    $statement->bindParam(1, $login);
    $statement->execute();
    
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user['mdp'])) {
        $_SESSION["login"] = $login;
        return true;
    } else {
        $_SESSION["login"] = null;
        return false;
    }
}

function home_page()
{

    $name = $_POST["name"];
    $pass = $_POST["pass"];
    if (check_login($name, $pass))
        header('Location: /php/home.php');
    else
    {
        header('Location: /index.php');
    }
}
?>