<?php

include "bdd.php";

function pass_crypt($pwd) : string
{
    return md5($pwd);
}

function check_login($login, $pwd)
{
    $bdd = DatabaseConnection();
    $req = "SELECT login, mdp FROM user WHERE login = ? AND mdp = ? ";
    $pwd = md5($pwd);
    $prep = $bdd->prepare($req);
    $prep->bindParam(1, $login);
    $prep->bindParam(2, $pwd);
    $prep->execute();
    $count = $prep->rowCount();
    if ($count == 1)
        $_SESSION["login"] = $login;
    return $count == 1;
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