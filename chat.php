<?php 

    include_once(__DIR__ . "/bootstrap.php");
    Security::onlyLoggedInUsers();

    $user = User::getByEmail($_SESSION['email']);
    $connected = User::getChatUser($_SESSION['reconnect'][$_GET['u']], $user['id']);

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
    <div class="floating-icons floating-icons-meal">
        <a href="reconnect.php"><img class="icon" src="icons/Icon-arrow-black.svg" alt="arrow-button"></a>
        <div>
            <a href="#" class=""><img class="chat-reconnect" src="icons/Icon-euro.svg" alt="euro-icon"></a>
            <a href="#" class=""><img class="chat-reconnect" src="icons/Icon-reconnect.png" alt="reconnect-icon"></a>
        </div>
    </div>
    <div class="reconnect-details">
        <div class="chat-avatar"><img class="avatar medium" src="images/<?php echo $connected['avatar'] ?>" alt="<?php echo $connected['firstname'] ?>"></div>
        <h3 class="red chat-username"><?php echo $connected['firstname'] ?></h3>
        <p><?php //echo $online ?></p>
    </div>
    <div class="chat-footer">
        <div class="chat-footer-icons">
            <div class=""><img class="" src="icons/Icon-camera.svg" alt="camera-icon"></div>
            <div class=""><img class="" src="icons/Icon-photo-library.svg" alt="library-icon"></div>
            <div class=""><img class="" src="icons/Icon-microphone.svg" alt="microphone-icon"></div>
        </div>
        <form action="" method="POST" class="chat-form">
            <input type="text" name="chat" placeholder="Aa" class="chat-input" >
        </form>
    </div>
</body>
</html>