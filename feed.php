<?php 

    include_once(__DIR__ . "/bootstrap.php");
    Security::onlyLoggedInUsers();

    $user = User::getByEmail($_SESSION['email']);
    $suggestedMeals = Meal::getAll($user['id']);
    $cultures = Culture::getAll();
    $title = "Aanbevolen voor jou";
    $skip = 0;

    if(isset($_GET['s'])){
        $search = $_GET['s'];
        $suggestedMeals = Meal::searchMealByName($search);
        if(count($suggestedMeals) == 0){
            $title = "Geen resultaten gevonden voor '$search'";
            $skip = false;
        } else {
            $title = "Resultaten voor '$search'";
            $skip = true;
        }
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

    <div class="content">
        <a class="filter" href="filter.php">Filteren</a>
        <form class="search-form" method="GET">
            <input type="text" id="search-meal" class="search" name="s" autocomplete="off">
            <div id="search-meal-suggestions"></div>
        </form>
    </div>
    
    <div class="content suggestions">
        <h2><?php echo $title ?></h2>
        <?php if($skip === 0 || $skip === true): ?>
        <div id="slider1" class="slide-bar">
        <?php foreach($suggestedMeals as $meal): $host = Meal::getUserById($meal['user_id']); ?>
            <div class="meal">
                <a href="meal.php?id=<?php echo $meal['id'] ?>">
                    <img class="feed-image" src="images/<?php echo $meal['image'] ?>" alt="<?php echo $meal['name'] ?>">
                    <div class="feed-details">
                        <img class="avatar avatar-feed" src="images/<?php echo $host['avatar'] ?>" alt="<?php echo $host['firstname'] ?>">
                        <div>
                            <h3 class="meal-title"><?php echo $meal['name'] ?></h3>
                            <div class="guests">
                                <p class="amoutOfGuests"><?php echo $amoutOfGuests = Meal::countGuests($meal['id']); ?></p>
                                <div class="iconPeople"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php if($skip === 0 || $skip === false): foreach($cultures as $culture): ?>
        <div class="content culture">
            <h2><?php echo $culture['name'] . " keuken" ?></h2>
            <div id="" class="slide-bar">
            <?php foreach(Meal::getMealsByCulture($culture['id'], $user['id']) as $meal): $host = Meal::getUserById($meal['user_id']); ?>
                <div class="meal">        
                    <a href="meal.php?id=<?php echo $meal['id'] ?>">
                        <img class="feed-image" src="images/<?php echo $meal['image'] ?>" alt="<?php echo $meal['name'] ?>">
                        <div class="feed-details">
                            <img class="avatar avatar-feed" src="images/<?php echo $host['avatar'] ?>" alt="<?php echo $host['firstname'] ?>">
                                <div>
                                <h3 class="meal-title"><?php echo $meal['name'] ?></h3>
                                <div class="guests">
                                    <p class="amoutOfGuests"><?php echo $amoutOfGuests = Meal::countGuests($meal['id']); ?></p>
                                    <div class="iconPeople"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; endif; ?>
    <div class="whiteSpace"></div>
    <script src="scripts/feedSlider.js"></script>
    <script src="scripts/liveSearch.js"></script>
</body>
</html>