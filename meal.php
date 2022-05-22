<?php 

    include_once(__DIR__ . "/bootstrap.php");
    Security::onlyLoggedInUsers();

    $meal = Meal::getById($_GET['id']);
    $host = Meal::getUserById($meal['user_id']);
    $ingredients = [];

    $datetime = new DateTime($meal['meetingTime']);
    $date = $datetime->format('d-m-Y');
    $time = $datetime->format('H:i');

    $user = User::getByEmail($_SESSION['email']);

    $guests = Meal::getGuests($meal['id']);

    if(isset($_POST['signUp'])){
        Meal::signUp($user['id'], $meal['id'], $meal['user_id']);
        header("Location: meal.php?id=" . $meal['id']);
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
    <div class="pop-up-bg">
        <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>
        <?php $culture = Culture::getById($meal['culture_id']) ?>
        <div class="meal-details">
            <div class="floating-icons floating-icons-meal">
                <a href="feed.php"><img class="icon" src="icons/Icon-arrow.png" alt="arrow-button"></a>
                <a href=""><img class="icon" src="icons/Icon-share.png" alt="share-button"></a>
            </div>
            <div><img class="detail-image" src="images/<?php echo $meal['image'] ?>" alt="<?php echo $meal['name'] ?>"></div>
            <div class="meal-avatar"><img class="avatar big" src="images/<?php echo $host['avatar'] ?>" alt="<?php echo $host['firstname'] ?>"></div>
            <div class="content">
                <h2><?php echo $meal['name'] ?></h2>
                <p><?php echo $culture['name'] . " keuken" ?></p>
                <p><?php echo $host['firstname'] ?></p>
                <p><img src="icons/Icon-map-pin.svg" alt="pin-icon"><?php echo " " . $meal['location'] ?></p>
                <p class="red"><?php echo $date . " om " . $time ?></p> 
                <ul class=" guestsList guestsList-meal">
                    <?php foreach($guests as $guest): ?>
                        <li class="guestItem"><img class="avatar small" src="images/<?php echo $guest['avatar'] ?>" alt="<?php echo $guest['firstname'] ?>"></li>
                    <?php endforeach; ?>
                </ul>
            </div> 
        </div>
        <div class="content">
            <p><?php echo $meal['description'] ?></p>
            <ul>
                <?php foreach($ingredients as $ingredient): ?>
                    <li><?php echo $ingredient['name'] ?></li>
                <?php endforeach; ?>
            </ul>
            <?php if($guests === []): ?>
                <div class="centered bottom" id="signUp-button"><a class="button" id="signUp-meal" href="#">Inschrijven</a></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="pop-up">
        <h2 class="centered">Je bent ingeschreven bij <?php echo $host['firstname'] ?></h2>
        <p class="centered"><?php echo "Op " . $date . " om " . $time . " in " . $meal['location']?></p>
        <p class="centered">Samen met:</p>
        <div class="centered">
            <ul class="guestsList">
                <?php foreach($guests as $guest): ?>
                    <li class="guestItem"><img class="avatar medium" src="images/<?php echo $guest['avatar'] ?>" alt="<?php echo $guest['firstname'] ?>"></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <form method="POST">
            <div class="centered"><input type="submit" name="signUp" value="Doorgaan" class="button form-button" id="confirm-signUp-meal"></div>
        </form>
        <div class="centered annulation"><a id="annulation" href="#">Annuleren</a></div>
    </div>
    <script src="scripts/mealPopUp.js"></script>
</body>
</html>