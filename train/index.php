<html>
  <head>
    <title>TrainExpress</title>
    <link href="ressources/css/form_user.css" rel="stylesheet">
  </head>
<body>
    <div class="login-box">
    <h2>Connexion</h2>
    <form action="php/login/verif.php" method="post">
        <div class="user-box">
    <form>
        <div class="user-box">
        <input type="text" name="name" required="">
        <label>Utilisateur</label>
    </div>
    <div class="user-box">
        <input type="password" name="pass" required="">
        <label>mot de passe</label>
    </div>
    <a href="php/login/register.php" id="register">Pas encore de compte ? Cliquez ici</a>
    <a href="#">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <input type="submit" value="Se connecter">
    </a>
    </form>
</div>
</body>
</body>