<?php 

    class Message{
        public static function getLastMessage($reciever_id, $sender_id){
            $db = Db::getConnection();
            $stmt = $db->prepare("SELECT * FROM messages WHERE reciever_id = :reciever_id AND sender_id = :sender_id ORDER BY id DESC LIMIT 1");
            $stmt->bindValue(":reciever_id", $reciever_id);
            $stmt->bindValue(":sender_id", $sender_id);
            $stmt->execute();
            $message = $stmt->fetch();
            if($message !== false){
                return $message['message'];
            }
            else{
                return "Nog geen berichten...";
            }
        }
    }