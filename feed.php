<?php 

    include_once(__DIR__ . "/bootstrap.php");
    Security::onlyLoggedInUsers();

    // $vis_ip = Location::getVisIpAddr();
    // $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $vis_ip));
    // echo 'Latitude: ' . $ipdat->geoplugin_latitude . "\n";
    // echo 'Longitude: ' . $ipdat->geoplugin_longitude . "\n";

    $user = User::getByEmail($_SESSION['email']);
    $suggestedMeals = Meal::getAll($user['id']);
    $cultures = Culture::getAll();
    $title = "Aanbevolen voor jou";
    $view = 'standard';

    if(isset($_GET['s'])){
        $search = $_GET['s'];
        $suggestedMeals = Meal::searchMealByName($search, $user['id']);
        if(count($suggestedMeals) == 0){
            $title = "Geen resultaten gevonden voor '$search'";
            $view = 'no-suggestions';
        } else {
            $title = "Resultaten voor '$search'";
            $view = 'suggestions';
        }
    }

    if(isset($_GET['filter'])){
        $filter = $_GET;
        if(!empty($filter['culture'])){
            $filter['culture'] = Culture::getIdByName($filter['culture']);
        }
        $suggestedMeals = Meal::filterMeals($filter, $user['id']);
        if(count($suggestedMeals) == 0){
            $title = "Geen resultaten gevonden voor deze filter";
            $view = 'no-suggestions';
        } else {
            $title = "Resultaten voor deze filter";
            $view = 'suggestions';
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
        <?php if($view === 'standard' || $view === 'suggestions'): ?>
        <div class="slide-bar">
        <?php foreach($suggestedMeals as $meal): $host = Meal::getUserById($meal['user_id']); ?>
            <div class="meal">
                <a href="meal.php?id=<?php echo $meal['id'] ?>">
                    <img class="feed-image" src="images/<?php echo $meal['image'] ?>" alt="<?php echo $meal['name'] ?>">
                    <div class="feed-details">
                        <img class="avatar avatar-feed" src="images/<?php echo $host['avatar'] ?>" alt="<?php echo $host['firstname'] ?>">
                        <div>
                            <h3 class="meal-title"><?php echo $meal['name'] ?></h3>
                            <div class="guests">
                                <p class="amoutOfGuests culture"><?php echo $amoutOfGuests = Meal::countGuests($meal['id']); ?></p>
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
    <?php if($view === 'standard' || $view === 'no-suggestions'): foreach($cultures as $culture): ?>
        <div class="content">
            <h2><?php echo $culture['name'] . " keuken" ?></h2>
            <div class="slide-bar">
            <?php foreach(Meal::getMealsByCulture($culture['id'], $user['id']) as $meal): $host = Meal::getUserById($meal['user_id']); ?>
                <div class="meal">        
                    <a href="meal.php?id=<?php echo $meal['id'] ?>">
                        <img class="feed-image" src="images/<?php echo $meal['image'] ?>" alt="<?php echo $meal['name'] ?>">
                        <div class="feed-details">
                            <img class="avatar avatar-feed" src="images/<?php echo $host['avatar'] ?>" alt="<?php echo $host['firstname'] ?>">
                            <div>
                                <h3 class="meal-title"><?php echo $meal['name'] ?></h3>
                                <div class="guests">
                                    <p class="amoutOfGuests culture"><?php echo $amoutOfGuests = Meal::countGuests($meal['id']); ?></p>
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
    <script src="scripts/liveSearch.js"></script>
</body>
</html>