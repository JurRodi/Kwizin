<?php 

    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();
    if($_SESSION['next-reg-step'] == false){
        header("Location: feed.php");
        die();
    }
    else{
        $_SESSION['next-reg-step'] = false;
    }

    $user = User::getByEmail($_SESSION['email']);

    if(isset($_POST['culture'])) {
        User::setCulture($user['id'], ucfirst($_POST['culture']));
        header("Location: feed.php");
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

    <div class="welcome register">
        <div class="IM-header">
            <img class="welcome-logo" src="images/Kwizin_logo.png" alt="Kwizin-logo">
        </div>

        <form action="" method="POST" id="culture-form" class="login-form">
            <div class="form-group culture-form">
                <label for="culture">In welke cultuur bent u opgegroeid?</label>
                <input type="text" name="culture" class="form-input" required>
            </div>

            <div class="form-group culture-form">
                <label for="favorites">Welke keukens/culturen vind u het lekkerste om uit te eten?</label>
                <input type="text" name="favorites" class="form-input">
            </div>
        
            <input type="submit" value="Volgende" class="button form-button">
        </form>
    </div>
    
</body>
</html>
