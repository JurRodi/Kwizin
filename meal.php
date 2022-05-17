<?php 

    include_once(__DIR__ . "/bootstrap.php");
    //Security::onlyLoggedInUsers();

    $meal = Meal::getById($_GET['id']);
    $host = Meal::getUserById($meal['user_id']);
    $ingredients = [];

    $datetime = new DateTime($meal['meetingTime']);
    $date = $datetime->format('d-m-Y');
    $time = $datetime->format('H:i');

    $id = 1;
    $user = User::getById($id);

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
    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>
    <?php $culture = Culture::getById($meal['culture_id']) ?>
    <div class="meal-details">
        <div class="floating-icons floating-icons-meal">
            <a href="feed.php"><img class="icon" src="icons/Icon-arrow.png" alt="arrow-button"></a>
            <a href=""><img class="icon" src="icons/Icon-share.png" alt="share-button"></a>
        </div>
        <div><img class="detail-image" src="images/<?php echo $meal['image'] ?>" alt="<?php echo $meal['name'] ?>"></div>
        <div class="meal-avatar"><img class="avatar big" src="images/<?php echo $user['avatar'] ?>" alt="<?php echo $user['firstname'] ?>"></div>
        <div class="content">
            <h2><?php echo $meal['name'] ?></h2>
            <p><?php echo $culture['name'] ?></p>
            <p><?php echo $host['firstname'] ?></p>
            <p><?php echo $meal['location'] ?></p>
            <p><?php echo $meal['meetingTime'] ?></p> 
        </div> 
    </div>
    <div class="content">
        <p><?php echo $meal['description'] ?></p>
        <ul>
            <?php foreach($ingredients as $ingredient): ?>
                <li><?php echo $ingredient['name'] ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="centered bottom" id="signUp-button"><a class="button" id="signUp-meal" href="#">Inschrijven</a></div>
    </div>
    <div class="pop-up">
        <h2 class="centered">Je bent ingeschreven bij <?php echo $host['firstname'] ?></h2>
        <p class="centered"><?php echo "Op " . $date . " om " . $time . " in " . $meal['location']?></p>
        <ul class="centered">
            <p>Samen met:</p>
            <?php foreach($ingredients as $ingredient): ?>
                <li><?php echo $ingredient['name'] ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="centered bottom"><a class="button" id="confirm-signUp-meal" href="#">Doorgaan</a></div>
        <div class="centered bottom annulation"><a id="annulation" href="#">Annuleren</a></div>
    </div>
    <script src="scripts/script.js"></script>
</body>
</html>