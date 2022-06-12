<?php 

    include_once(__DIR__ . "/bootstrap.php");
    Security::onlyLoggedInUsers();

    $preferences = ['Vegetarisch', 'Veganistisch', 'Pescotarisch', 'Halal', 'Glutenvrij'];

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwizin</title>
    <link rel="icon" type="image/x-icon" href="/icons/favicon.png">
    <link rel="stylesheet" href="styling/style.css">
</head>
<body>

    <?php include_once(__DIR__ . "/partials/header.inc.php"); ?>
    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>

    <form action="feed.php?" class="form">
        <div class="form-item">
            <div class="filter-item">
                <label for="culture" class="red"><h3>Cultuur</h3></label>
                <input type="text" name="culture" class="form-input">
            </div>
        </div>

        <div class="form-item">
            <div class="filter-item">
                <label for="distance" class="red"><h3>Afstand <output for="distance" id="distance-output" class="slider-output"></output></h3></label>
                <div class="slideContainer">
                    <input type="range" name="distance" id="distance" min="0" max="50" value="10" class="form-input slider">
                </div>
            </div>
        </div>

        <div class="form-item">
            <div class="filter-item">
                <label for="city" class="red"><h3>Stad</h3></label>
                <p>Voor als u van de app gebruik wilt maken tijdens uw reis.</p>
                <input type="text" name="city" class="form-input">
            </div>
        </div>

        <div class="form-item">
            <div class="filter-item">
                <label for="preferences" class="red"><h3>Voorkeuren</h3></label>
                <?php foreach($preferences as $preference): ?>
                    <div>
                        <input type="checkbox" name="<?php echo $preference ?>" class="">
                        <label for="<?php echo $preference ?>"><?php echo $preference ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-item">
            <div class="filter-item">
                <label for="price" class="red"><h3>Maximum prijs <output for="price" id="price-output" class="slider-output"></output></h3></label>
                <div class="slideContainer">
                    <input type="range" name="price" id="price" min="0" max="150" value="10" class="form-input slider">
                </div>
            </div>
        </div>

        <div class="centered form-button-align"><input type="submit" name="filter" value="Bevestig" id="filter" class="button form-button"></div>
    </form>
    <div class="whiteSpace"></div>

    <script src="scripts/slider.js"></script>
</body>
</html>