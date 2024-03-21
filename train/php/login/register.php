<html>
  <head>
    <title>TrainExpress</title>
    <link href="../../ressources/css/form_user.css" rel="stylesheet">
  </head>
<body>
    <div class="login-box">
    <h2>Connexion</h2>
    <form action="create_user.php" method="post">
        <div class="user-box">
    <form>
        <div class="user-box">
        <input type="text" name="prenom" >
        <label>Prenom</label>
        </div>
    <div class="user-box">
        <input type="text" name="nom">
        <label>Nom</label>
    </div>
    <div class="user-box">
        <input type="text" name="adresse">
        <label>Adresse</label>
    </div>
    <div class="user-box">
        <input type="number" name="cp" style="-moz-appearance: textfield">
        <label>Code Postale</label>
    </div>
    <div class="user-box">
        <input type="text" name="name" required>
        <label>Login</label>
    </div>
    <div class="user-box">
        <input type="password" name="pass" required>
        <label>mot de passe</label>
    </div>
    <a href="#">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <input type="submit" value="Crée un compte">
    </a>
    </form>
</div>
</body>