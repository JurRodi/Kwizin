<?php 

    include_once(__DIR__."/bootstrap.php");
    Security::onlyLoggedInUsers();

    $user = User::getByEmail($_SESSION['email']);
    $cultures = Culture::getAll();

    if(isset($_POST['mealUpload'])){
        $meal_id = Meal::addMeal($user['id'], $_POST['culture'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['location'], $_POST['meetingTime'], $_POST['max-guests']);
        Image::upload($meal_id, $user['id']);
        $ingredients = json_decode($_POST['ingredient']);
        foreach($ingredients as $ingredient){
            Ingredient::addIngredient($ingredient, $meal_id);
        }
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

    <form action="" method="POST" enctype="multipart/form-data" class="">
        <div class="form-item">
            <div class="filter-item">
                <label for="name" class="red"><h3>Naam gerecht</h3></label>
                <input type="text" name="name" id="name" class="form-input" required>
            </div>
        </div>

        <div class="form-item">
            <div class="filter-item">
                <label for="culture" class="red"><h3>Cultuur</h3></label>
                <select name="culture" id="culture" class="form-input">
                    <option value="">Kies een cultuur</option>
                    <?php foreach($cultures as $culture): ?>
                        <option value="<?php echo $culture['id'] ?>"><?php echo $culture['name'] . " cultuur" ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-item">
            <div class="filter-item">
                <label for="description" class="red"><h3>Beschrijving</h3></label>
                <textarea name="description" id="description" class="form-input form-text" cols="30" rows="10" required></textarea>
            </div>
        </div>

        <div class="form-item">
            <div class="filter-item">
                <label for="ingredients" class="red"><h3>Ingrediënten</h3></label>
                <div class="add-ingredients">
                    <input type="text" name="ingredient" id="ingredient" class="form-input" value="">
                    <a href="" class="add-ingredient"><img id="add-ingredient-btn" src="icons/Icon-add.svg" alt="add-icon"></a>
                </div>
            </div>
        </div>

        <div class="form-item">
            <div class="filter-item">
                <div id="ingredient-list"></div>
                <label for="price" class="red"><h3>Prijs <output for="price" id="price-output" class="slider-output"></output></h3></label>
                <div class="slideContainer">
                    <input type="range" name="price" id="price" min="0" max="150" value="10" class="form-input slider" required>
                </div>
            </div>
        </div>

        <div class="form-item">
            <div class="filter-item">
                <label for="image" class="red"><h3>Afbeelding</h3></label>
                <input type="file" name="image" id="image" required>
            </div>
        </div>

        <div class="form-item">
            <div class="filter-item">
                <label for="location" class="red"><h3>Locatie</h3></label>
                <input type="text" name="location" id="location" class="form-input" required>
            </div>
        </div>

        <div class="form-item">
            <div class="filter-item">
                <label for="max-guests" class="red"><h3>Aantal personen</h3></label>
                <input type="number" name="max-guests" id="max-guests" class="form-input" step="1" min="0" max="99" required>
            </div>
        </div>

        <div class="form-item">
            <div class="filter-item">
                <label for="meetingTime" class="red"><h3>Datum en tijdstip</h3></label>
                <input type="datetime-local" name="meetingTime" id="meetingTime" class="form-input" required>
            </div>
        </div>
        
        <div class="centered form-button-align"><input type="submit" name="mealUpload" value="Voeg gerecht toe" id="mealUpload" class="button form-button"></div>
    </form>
    <div class="whiteSpace"></div>

    <script src="scripts/slider.js"></script>
    <script src="scripts/addIngredient.js"></script>
</body>
</html>