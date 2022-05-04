<?php 

    include_once(__DIR__ . "/bootstrap.php");
    //Security::onlyLoggedInUsers();

    $suggestedMeals = Meal::getAll();
    $cultures = Culture::getAll();

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
    <?php include_once(__DIR__ . "/partials/header.inc.php"); ?>

    <form class="content search-form">
        <input type="text" name="search" placeholder="Search for a meal" class="search">
    </form>
    <div class="content suggestions">
        <h2>Aanbevolen voor jou</h2>
        <div class="slide-bar">
        <?php foreach($suggestedMeals as $meal): $host = Meal::getUserById($meal['user_id']); ?>
            <a href="meal.php?id=<?php echo $meal['id'] ?>">
                <div class="meal">
                    <img src="<?php echo $meal['image'] ?>" alt="<?php echo $meal['name'] ?>">
                    <h3><?php echo $meal['name'] ?></h3>
                    <img src="<?php echo $host['avatar'] ?>" alt="<?php echo $host['firstname'] ?>">
                    <div class="guests">
                        <p class="amoutOfGuests"><?php echo $amoutOfGuests = Meal::countGuests($meal['id']); ?></p>
                        <div class="iconPeople"></div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
        </div>
    </div>
    <?php foreach($cultures as $culture): ?>
        <div class="content culture">
            <h2><?php echo $culture['name'] ?></h2>
            <div class="slide-bar">
            <?php foreach(Meal::getMealsByCulture($culture['id']) as $meal): $host = Meal::getUserById($meal['user_id']); ?>
                <a href="meal.php?id=<?php echo $meal['id'] ?>">
                    <div class="meal">
                        <img src="<?php echo $meal['image'] ?>" alt="<?php echo $meal['name'] ?>">
                        <h3><?php echo $meal['name'] ?></h3>
                        <img src="<?php echo $host['avatar'] ?>" alt="<?php echo $host['firstname'] ?>">
                        <div class="guests">
                            <p class="amoutOfGuests"><?php echo $amoutOfGuests = Meal::countGuests($meal['id']); ?></p>
                            <div class="iconPeople"></div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>
</body>
</html>