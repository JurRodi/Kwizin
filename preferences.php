<?php 

    include_once(__DIR__. "/bootstrap.php");
    Security::onlyLoggedInUsers();
    if($_SESSION['next-reg-step'] == false){
        header("Location: feed.php");
        die();
    }
    else{
        $_SESSION['next-reg-step'] = true;
    }
    
    $user = User::getByEmail($_SESSION['email']);

    $preferences = Preference::getPreferences();
    if(!empty($_POST)) {
        $chosenPreferences = $_POST;
        Preference::setPreferences($user['id'], $chosenPreferences);
        header("Location: culture.php");
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

            <p class="pref-text">Heeft u bepaalde voorkeuren voor uw eten? Geef het hier door zodat de app hier rekening mee kan houden. Deze instellingen kunnen altijd nog gewijzigd worden op uw profiel.</p>
        </div>

        <form action="" method="POST" class="login-form">
            <div class="form-group">
                <?php foreach($preferences as $preference): ?>
                    <div class="pref">
                        <input type="checkbox" name="<?php echo $preference ?>" value="<?php echo $preference ?>">
                        <label for="<?php echo $preference ?>"><?php echo $preference ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
        
            <input type="submit" value="Volgende" class="button form-button">
        </form>
    </div>
    
</body>
</html>
