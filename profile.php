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

    <div class="floating-icons right">
        <a href="profile.php"><img class="icon" src="icons/Icon-menu.svg" alt="arrow-button"></a>
    </div>

    <div class="profile content-line ">
        <div class="centered"><img class="avatar big" src="images/<?php echo $user['avatar'] ?>" alt="<?php echo $user['firstname'] ?>"></div>
        <h2 class="centered"><?php echo $user['firstname'] ?></h2>
        <?php $rating = User::calculatecookingRating($user['id']) ?>
        <div class="ratings">
            <div class="rating">
                <?php for($i = 5; $i > 0; $i--): ?>
                    <?php if($rating > 0): ?>
                        <div><img class="profile-icon" src="icons/Icon-chef.svg" alt="chef-icon"></div>
                    <?php else: ?>
                        <div><img class="profile-icon" src="icons/Icon-chef-grey.svg" alt="chef-icon"></div>
                    <?php endif; $rating--?>
                <?php endfor; ?>
            </div>
            <?php $rating = User::calculateUserRating($user['id']) ?>
            <div class="rating">
                <?php for($i = 5; $i > 0; $i--): ?>
                    <?php if($rating > 0): ?>
                        <div><img class="profile-icon" src="icons/Icon-star.svg" alt="star-icon"></div>
                    <?php else: ?>
                        <div><img class="profile-icon" src="icons/Icon-star-grey.svg" alt="star-icon"></div>
                    <?php endif; $rating--?>
                <?php endfor; ?>
            </div>
        </div>
        <div class="centered"><a class="button" id="edit-profile" href="">Profiel bewerken</a></div>
        <p class="bio"><?php echo $user['bio'] ?></p>
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
                    <img class="meal-image" src="images/<?php echo $meal['image'] ?>" alt="<?php echo $meal['name'] ?>">
                    <div class="meal-content">
                        <h4 class="profile-meal-title red"><?php echo $meal['name'] ?></h4>
                        <?php $rating = Meal::calculateMealRating($meal['id']) ?>
                        <div class="rating">
                            <?php for($i = 5; $i > 0; $i--): ?>   
                                <?php if($rating > 0): ?>
                                    <div><img class="profile-icon" src="icons/Icon-star.svg" alt="star-icon"></div>
                                <?php else: ?>
                                    <div><img class="profile-icon" src="icons/Icon-star-grey.svg" alt="star-icon"></div>
                                <?php endif; $rating--?>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>