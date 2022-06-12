<?php 

    include_once(__DIR__. "/bootstrap.php");

    if (!empty($_POST)) {
        try {
            $user = new User();
            $user->setEmail($_POST["email"]);
            $user->setPassword($_POST["password"]);
            $user->canLogin();
            
            session_start();
            $_SESSION['email'] = $user->getEmail();
            header("Location: feed.php");
        }
        catch ( Throwable $e ) {
            $error = $e->getMessage();
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwizin</title>
    <link rel="icon" type="image/x-icon" href="/icons/favicon.png">
    <link rel="stylesheet" href="styling/style.css">
</head>
<body>

    <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif ?>

    <div class="welcome">
        <img class="welcome-logo" src="images/Kwizin_logo.png" alt="Kwizin-logo">
        <form action="" method="POST" class="login-form">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-input">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Wachtwoord</label>
                <input type="password" name="password" class="form-input">
            </div>
            <div class="">
                <input type="checkbox">
                <label for="remember">Onthoud mij</label>
            </div>
            <div class="">
                <input type="submit" name="login" value="Inloggen" class="button form-button">
            </div>
        </form>

        <a class="pw-forgot" href="password-forgotten.php">Wachtwoord vergeten?</a>
        
        <div class="welcome-q">
            <p>Nog geen account?</p>
            <a href="register.php">Registreren</a>
        </div>
    </div>
    
</body>
</html>
