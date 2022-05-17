<?php 

    include_once(__DIR__."/bootstrap.php");

    $id = 1;
    $user = User::getById($id);
    $meals = Meal::getMealsByUser($id);

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

    <div class="profile content-line ">
        <div class="centered"><img class="avatar big" src="images/<?php echo $user['avatar'] ?>" alt="<?php echo $user['firstname'] ?>"></div>
        <h2 class="centered"><?php echo $user['firstname'] ?></h2>
        <div class="ratings centered">
            <div><img src="icons" alt="chef-icon"></div>
            <div><img src="icons" alt="ster-icon"></div>
        </div>
        <div class="centered"><a class="button" id="edit-profile" href="">Profiel bewerken</a></div>
        <p><?php echo $user['bio'] ?></p>
    </div>
    <div class="content-line extraProfile">
        <div class="favoriteMeals">
            <h3 class="red">Favoriete gerechten</h3>
            <ul>
                <li><?php echo $user['favorites'] ?></li>
            </ul>
        </div>
        <div class="cultures">
            <h3 class="red">Cultuur</h3>
            <ul>
                <li><?php echo $user['culture'] ?></li>
            </ul>
        </div>
    </div>
    <div class="best-meals content-line">

    </div>
    <div class="own-meals content-line">
        <div class="profile-heading">
            <h3 class="red">Gerechten</h3>
            <a href="uploadMeal.php"><img src="icons/Icon-add.svg" alt="add-icon"></a>
        </div>
        <div class="profile-meals">
            <?php foreach($meals as $meal): ?>
                <div class="profile-meal">
                    <div class="meal-image"><img src="<?php echo $meal['image'] ?>" alt="<?php echo $meal['name'] ?>"></div>
                    <div class="meal-content">
                        <h4 class="red"><?php echo $meal['name'] ?></h4>
                        <p><?php echo $meal['rating'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>