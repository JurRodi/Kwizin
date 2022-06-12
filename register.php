<?php 

    if(!empty($_POST)){
        try {
            include_once(__DIR__. "/bootstrap.php");
            
            $user = new User();
            $user->setFirstName($_POST["firstname"]);
            $user->setLastName($_POST["lastname"]);
            $user->setEmail($_POST['email']);
            $user->setPassword(($_POST['password']));
            $user->register();
            
            session_start();
            $_SESSION['email'] = $user->getEmail();
            header("Location: itsMe.php");
        }
        catch(Throwable $error) {
            $error = $error->getMessage();
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwizin</title>
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
                <label for="email">Voornaam</label>
                <input type="text" name="firstname" class="form-input">
            </div>
            <div class="form-group">
                <label for="email">Achternaam</label>
                <input type="text" name="lastname" class="form-input">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-input">
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" class="form-input">
            </div>
            <div class="form-group">
                <input type="submit" name="login" value="Registeren" class="button form-button">
            </div>
        </form>
        
        <div class="welcome-q">
            <p>Al een account?</p>
            <a href="login.php">Log in</a>
        </div>
    </div>
    
</body>
</html>
