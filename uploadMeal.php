<?php 

    include_once(__DIR__."/bootstrap.php");
    Security::onlyLoggedInUsers();

    $user = User::getByEmail($_SESSION['email']);
    $cultures = Culture::getAll();

    if(isset($_POST['mealUpload'])){
        $meal_id = Meal::addMeal($user['id'], $_POST['culture'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['location'], $_POST['meetingTime']);
        Image::upload($meal_id, $user['id']);
        header("Location: profile.php");
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
    <?php include_once(__DIR__ . "/partials/header.inc.php"); ?>
    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>

    <div class="floating-icons">
        <a href="profile.php"><img class="icon" src="icons/Icon-arrow-black.svg" alt="arrow-button"></a>
    </div>

    <form action="" method="POST" enctype="multipart/form-data" class="content meal-form">
        <label for="name" class="red"><h3>Naam gerecht</h3></label>
        <input type="text" name="name" id="name" class="form-input" required>
        <label for="culture" class="red"><h3>Cultuur</h3></label>
        <select name="culture" id="culture" class="form-input">
            <option value="">Kies een cultuur</option>
            <?php foreach($cultures as $culture): ?>
                <option value="<?php echo $culture['id'] ?>"><?php echo $culture['name'] . " cultuur" ?></option>
            <?php endforeach; ?>
        </select>
        <label for="description" class="red"><h3>Beschrijving</h3></label>
        <textarea name="description" id="description" class="form-input form-text" cols="30" rows="10" required></textarea>
        <label for="ingredients" class="red"><h3>Ingrediënten</h3></label>
        <input type="text" name="ingredients" id="ingredients" class="form-input" required>
        <label for="price" class="red"><h3>Prijs</h3></label>
        <div class="slideContainer">
            <input type="range" name="price" id="price" min="0" max="150" value="10" class="form-input" required>
            <output for="price" id="price-output"></output>
        </div>
        <label for="image" class="red"><h3>Afbeelding</h3></label>
        <input type="file" name="image" id="image" required>
        <label for="location" class="red"><h3>Locatie</h3></label>
        <input type="text" name="location" id="location" class="form-input" required>
        <label for="meetingTime" class="red"><h3>Datum en tijdstip</h3></label>
        <input type="datetime-local" name="meetingTime" id="meetingTime" class="form-input" required>
        <div class="centered form-button-align"><input type="submit" name="mealUpload" value="Voeg gerecht toe" class="button form-button"></div>
    </form>
    <div class="whiteSpace"></div>

    <script src="scripts/addMealSlider.js"></script>
</body>
</html>