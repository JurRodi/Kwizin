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
    <div class="floating-icons">
        <a href="reconnect.php"><img class="icon" src="icons/Icon-arrow-black.svg" alt="arrow-button"></a>
    </div>
    <div class="floating-icons right">
        <a href="#" class=""><img class="chat-reconnect" src="icons/Icon-euro.svg" alt="euro-icon"></a>
        <a href="#" class=""><img class="chat-reconnect" src="icons/Icon-reconnect.png" alt="reconnect-icon"></a>
    </div>
    <div class="reconnect-details">
        <div class="chat-avatar"><a href="profile.php?u=<?php echo $connected['firstname'] ?>"><img class="avatar medium" src="images/<?php echo $connected['avatar'] ?>" alt="<?php echo $connected['firstname'] ?>"></a></div>
        <div class="chat-username-container"><a href="profile.php?u=<?php echo $connected['firstname'] ?>"><h3 class="red chat-username"><?php echo $connected['firstname'] ?></h3></a></div>
        <p><?php //echo $online ?></p>
    </div>
    <div class="chat-messages">
        <?php foreach($messages = Message::getAllMessages($connected['id'], $user['id']) as $message): ?>
            <?php if($message['sender_id'] == $user['id']): ?>
                <div class="chat-message-right">
                    <div class="chat-message-right-text">
                        <p><?php echo $message['message'] ?></p>
                    </div>
                </div>
            <?php else: ?>
                <div class="chat-message-left">
                    <div class="chat-message-left-avatar"><img class="avatar small" src="images/<?php echo $connected['avatar'] ?>" alt="<?php echo $connected['firstname'] ?>"></div>
                    <div class="chat-message-left-text">
                        <p><?php echo $message['message'] ?></p>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="chat-footer">
        <div class="chat-footer-icons">
            <div class=""><img class="" src="icons/Icon-camera.svg" alt="camera-icon"></div>
            <div class=""><img class="" src="icons/Icon-photo-library.svg" alt="library-icon"></div>
            <div class=""><img class="" src="icons/Icon-microphone.svg" alt="microphone-icon"></div>
        </div>
        <form action="" method="POST" class="chat-form">
            <input type="text" name="message" placeholder="Aa" id="messageInput" class="chat-input" data-sender="<?php echo $user['id'] ?>" data-reciever="<?php echo $connected['id'] ?>">
        </form>
    </div>

    <script src="scripts/addMessage.js"></script>
</body>
</html>