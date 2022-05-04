<?php 

    include_once(__DIR__."/bootstrap.php");

    $id = 1;
    $users = User::getAllPrevConnected($id);

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
    <div class="content">
        <form class="search-form">
            <input type="text" name="search" class="search" >
        </form>
        <div class="centered"><a class="button" href="">Eetverzoeken</a></div>
    </div>
    <div class="">
        <?php foreach($users as $user): ?>
            <div class="chat">
                <img class="avatar" src="<?php echo $user['avatar'] ?>" alt="<?php echo $user['firstname'] ?>">
                <h3 class="chat-user"><?php echo $user['firstname']." ".$user['lastname'] ?></h3>
                <p class="chat-message"><?php //echo $user['message'] ?>dit wordt een bericht</p>
                <div class="chat-reconnect"></div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>
</body>
</html>