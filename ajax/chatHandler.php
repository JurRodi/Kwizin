<?php 

    include_once(__DIR__ . "/../bootstrap.php");	

    if(!empty($_POST)){
        $id = Message::addMessage($_POST['reciever_id'], $_POST['sender_id'], $_POST['message']);
        $message = Message::getMessageById($id);
        $user = User::getById($message['sender_id']);

        $response = [
            'status' => 'succes',
            'body' => $message,
            'userAvatar' => $user['avatar'],
            'userFirstname' => $user['firstname']
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    };

?>