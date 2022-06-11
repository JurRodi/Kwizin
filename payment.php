<?php 

    include_once(__DIR__ . "/bootstrap.php");
    Security::onlyLoggedInUsers();
    if($_SESSION['acces-payment'] == false){
        header("Location: feed.php");
        die();
    }
    else{
        $_SESSION['acces-payment'] = false;
    }

    $user = User::getByEmail($_SESSION['email']);
    $host = User::getById($_SESSION['host']);
    $meals = Meal::getMealsByUser($host['id']);
    $meal = $meals[0];

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

    <div class="floating-icons">
        <a href="<?php if(isset($_SERVER['HTTP_REFERER'])){ echo $_SERVER['HTTP_REFERER'];} ?>"><img class="icon" src="icons/Icon-arrow-black.svg" alt="arrow-button"></a>
    </div>

    <div class="payment-top">
        <div class=""><img class="avatar very-big" src="images/<?php echo $host['avatar'] ?>" alt="<?php echo $host['firstname'] ?>"></div>
        <h2 class="payment-title"><?php echo $host['firstname'] ?><br>Betalen voor</h2>
    </div>

    <div class="pay-meal-conatiner">
        <div class="pay-meal-img-container"><img class="pay-meal-img" src="images/<?php echo $meal['image'] ?>" alt="<?php echo $meal['name'] ?>"></div>
        <div class="pay-meal-content">
            <div>
                <h3><?php echo $meal['name'] ?></h3>
                <p class="pay-price">€<?php echo $meal['price'] ?></p>
            </div>
            <div class="form-button-align pay-btn-container"><input type="submit" name="pay" value="Betalen" id="pay" class="button form-button"></div>
        </div>
    </div>

    <div class="payed">
        <h2 class="payment-title red">Bedankt voor uw betaling!</h2>
        <a href="<?php if(isset($_SERVER['HTTP_REFERER'])){ echo $_SERVER['HTTP_REFERER'];} ?>"><div class="centered form-button-align"><input type="submit" name="return" value="Terug naar chat" id="return" class="button form-button"></div></a>
    </div>

    <script src="scripts/paymentSuccesfull.js"></script>
</body>
</html>