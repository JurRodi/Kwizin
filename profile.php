<?php 

    include_once(__DIR__."/bootstrap.php");
    Security::onlyLoggedInUsers();

    if(isset($_GET['u'])){
        $user = User::getByName($_GET['u']);   
    }
    else{
        $user = User::getByEmail($_SESSION['email']);
        $ownProfile = true;
    }
    $meals = Meal::getMealsByUser($user['id']);
    $favorites = User::getFavorits($user['id']);
    $reviews = Review::getReviewsByUser($user['id']);
    $bestMeals = Meal::getBestMeals($user['id']);

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

    <?php if(isset($ownProfile)): ?>
        <div class="floating-icons right">
            <a href="logout.php"><img class="icon" src="icons/Icon-menu.svg" alt="arrow-button"></a>
        </div>
    <?php endif; ?>

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
        <?php if(isset($ownProfile)): ?>
            <div class="centered"><a class="button" id="edit-profile" href="">Profiel bewerken</a></div>
        <?php endif; ?>
        <p class="bio"><?php echo $user['bio'] ?></p>
    </div>
    <div class="content-line extraProfile">
        <div class="favoriteMeals">
            <h3 class="red">Favoriete gerechten</h3>
            <ul>
                <?php foreach($favorites as $favorite): ?>
                    <li><?php echo $favorite['name'] ?></li>
                <?php endforeach; ?>
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
        <h3 class="red">Beste gerechten</h3>
        <div class="profile-meals">
            <?php if($bestMeals !== null): foreach($bestMeals as $bestMeal): ?>
                <div class="profile-meal">
                    <img class="meal-image" src="images/<?php echo $bestMeal['image'] ?>" alt="<?php echo $bestMeal['name'] ?>">
                    <div class="meal-content">
                        <h4 class="profile-meal-title red"><?php echo $bestMeal['name'] ?></h4>
                        <?php $rating = Meal::calculateMealRating($bestMeal['id']) ?>
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
            <?php endforeach; else: echo "Nog geen beste gerechten."; endif;?>
        </div>
    </div>
    <div class="own-meals content-line">
        <div class="profile-heading">
            <h3 class="red">Gerechten</h3>
            <?php if(isset($ownprofile)): ?>
                <a href="uploadMeal.php"><img src="icons/Icon-add.svg" alt="add-icon"></a>
            <?php endif; ?>
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
        <a href="meals.php" id="more-meals" class="red profile-more centered">Meer gerechten<img class="profile-more-icon" src="icons/Icon-arrow-red.svg" alt="arrow-icon"></a>
    </div>
    <div class="reviews">
        <h3 class="red review-title">Reviews</h3>
        <div class="reviews-content">
            <?php foreach($reviews as $review): $reviewer = User::getById($review['user_id']); $rating = Review::getRatingFromReviewer($review['user_id']); ?>
                <div class="review">
                    <div class="review-content">
                        <img class="avatar review-avatar" src="images/<?php echo $reviewer['avatar'] ?>" alt="<?php echo $reviewer['firstname'] ?>">
                        <div>
                            <div class="review-header">
                                <p class="review-author"><?php echo $reviewer['firstname'] ?></p>
                                <div class="review-rating">
                                    <?php for($i = 5; $i > 0; $i--): ?>
                                        <?php if($rating > 0): ?>
                                            <div><img class="review-icon" src="icons/Icon-star.svg" alt="star-icon"></div>
                                        <?php else: ?>
                                            <div><img class="review-icon" src="icons/Icon-star-grey.svg" alt="star-icon"></div>
                                        <?php endif; $rating--?>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <p class="review-text"><?php echo $review['text'] ?></p>
                        </div>
                    </div>                    
                </div>
            <?php endforeach; ?>
        </div>
        <a href="reviews.php" class="red profile-more centered">Meer reviews<img class="profile-more-icon" src="icons/Icon-arrow-red.svg" alt="arrow-icon"></a>
        <?php if(!isset($ownProfile)): ?>
            <div class="centered form-button-align"><a href="review.php?u=<?php if(isset($_GET['u'])){echo $_GET['u'];} ?>"><input type="submit" name="review" value="Review toevoegen" id="review" class="button form-button"></a></div>
        <?php endif; ?>
    </div>
    <div class="whiteSpace"></div>
</body>
</html>