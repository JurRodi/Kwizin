<?php 

    include_once(__DIR__."/bootstrap.php");
    Security::onlyLoggedInUsers();
    $_SESSION['acces-payment'] = false;

    $user = User::getByEmail($_SESSION['email']);
    $connectedUsers = User::getAllPrevConnected($user['id']);
    $reconnect_ids = [];

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
    <?php include_once(__DIR__ . "/partials/nav.inc.php"); ?>

    <div class="content">
        <form class="search-form">
            <input type="text" name="search" class="search" >
        </form>
        <div class="centered"><a class="button" href="">Eetverzoeken</a></div>
    </div>
    <div class="chats">
        <?php foreach($connectedUsers as $connectedUser): $token = md5($connectedUser['firstname'].rand(10,9999)); $reconnect_ids[$token] = $connectedUser['id']; $_SESSION['reconnect'] = $reconnect_ids; ?> 
            <a href="chat.php?u=<?php echo $token ?>" class="chat">
                <img class="avatar reconnect-avatar" src="images/<?php echo $connectedUser['avatar'] ?>" alt="<?php echo $connectedUser['firstname'] ?>">
                <div class="chat-details">
                    <h3 class="red"><?php echo $connectedUser['firstname']." ".$connectedUser['lastname'] ?></h3>
                    <p class="chat-message"><?php echo $message = Message::getLastMessage($user['id'], $connectedUser['id']) ?></p>
                </div>
                <a href="#" class="chat-icon"><img class="chat-reconnect" src="icons/Icon-reconnect.png" alt="reconnect-icon"></a>
            </a>
        <?php endforeach; ?>
    </div>
</body>
</html>