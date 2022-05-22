<?php 

    include_once(__DIR__ . "/bootstrap.php");
    Security::onlyLoggedInUsers();

    $user = User::getByEmail($_SESSION['email']);
    //$connected = User::getChatUser($user['id'], $_GET['u']);

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
        <a href="reconnect.php"><img class="icon" src="icons/Icon-arrow-black.svg" alt="arrow-button"></a>
    </div>
    <div>
        <div class="meal-avatar"><img class="avatar big" src="images/<?php echo $reconnect['avatar'] ?>" alt="<?php echo $reconnect['firstname'] ?>"></div>
        <p><?php echo $reconnect['firstname'] ?></p>
        <p><?php //echo $online ?></p>
        <a href="#" class="chat-icon"><img class="chat-reconnect" src="icons/Icon-euro.svg" alt="euro-icon"></a>
        <a href="#" class="chat-icon"><img class="chat-reconnect" src="icons/Icon-reconnect.png" alt="reconnect-icon"></a>
    </div>
    <div>
        <div class=""><img class="" src="icons/Icon-camera.svg" alt="camera-icon"></div>
        <div class=""><img class="" src="icons/Icon-photo-library.svg" alt="library-icon"></div>
        <div class=""><img class="" src="icons/Icon-microphone.svg" alt="microphone-icon"></div>
        <form action="" method="POST">
            <input type="text" name="chat" class="chat" >
        </form>
    </div>
</body>
</html>