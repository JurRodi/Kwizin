<?php 

    include_once(__DIR__."/bootstrap.php");
    Security::onlyLoggedInUsers();

    $user = User::getByEmail($_SESSION['email']);
    $host = User::getByName($_GET['u']);
    $meals = Meal::getMealsByUser($host['id']);

    if(isset($_POST['review'])){
        Review::postReview($_POST['select-meal'], $user['id'], $_POST['user-rating'], $_POST['meal-rating'], $_POST['review-text']);
        header("Location: profile.php?u=".$_GET['u']);
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
    <div class="floating-icons">
        <a href="profile.php"><img class="icon" src="icons/Icon-arrow-black.svg" alt="arrow-button"></a>
    </div>
    <div class="review-top">
        <h2 class="review-title">Schrijf een review voor <br><?php echo $host['firstname'] ?></h2>
        <div class=""><img class="avatar very-big" src="images/<?php echo $host['avatar'] ?>" alt="<?php echo $host['firstname'] ?>"></div>
    </div>
    <form method="POST" class="review-form">
        <div class="review-container">
            <textarea name="review-text" id="review-text" placeholder="Schrijf een review..." cols="30" rows="10" required></textarea>
        </div>

        <div class="review-container giving-review-rating">
            <label for="select-meal">Kies het gerecht dat u wilt beoordelen.</label>
            <select name="select-meal" id="select-meal" required>
            <?php foreach($meals as $meal): ?>
                <option value="<?php echo $meal['id']; ?>"><?php echo $meal['name']; ?></option>
            <?php endforeach; ?>
            </select>
        </div>

        <div class="review-container giving-review-rating">
            <label for="meal-rating">Mijn score voor het eten</label>
            <div class="rating rating-review rating1">
                <?php for($i = 5; $i > 0; $i--): ?>
                    <input type="radio" name="meal-rating" value="<?php echo $i ?>" id="meal-rate-<?php echo $i ?>"/><label for="meal-rate-<?php echo $i ?>" class="meal-rating"></label>
                <?php endfor; ?>
            </div>
        </div>

        <div class="review-container giving-review-rating">
            <label for="user-rating">Mijn score voor <?php echo $host['firstname'] ?> als gast</label>
            <div class="rating rating-review rating2">
                <?php for($i = 5; $i > 0; $i--): ?>
                    <input type="radio" name="user-rating" value="<?php echo $i ?>" id="user-rate-<?php echo $i ?>"/><label for="user-rate-<?php echo $i ?>" class="user-rating"></label>
                <?php endfor; ?>
            </div>
        </div>

        <div class="centered form-button-align"><input type="submit" name="review" value="Review toevoegen" id="review" class="button form-button"></div>
    </form>
    <script></script>
</body>
</html>