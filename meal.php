<?php 

    include_once(__DIR__ . "/bootstrap.php");
    //Security::onlyLoggedInUsers();

    $meal = Meal::getById($_GET['id']);

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
    <?php //include_once(__DIR__ . "/partials/nav.inc.php"); ?>
    <?php $culture = Culture::getById($meal['culture_id']) ?>
    <h3><?php echo $meal['name'] ?></h3>
    <p><?php echo $culture['name'] ?></p>
    <p><?php echo $meal['description'] ?></p>
    <p><?php echo $meal['location'] ?></p>
    <p><?php echo $meal['meetingTime'] ?></p>
    <img src="<?php echo $meal['image'] ?>" alt="<?php echo $meal['name'] ?>">
</body>
</html>