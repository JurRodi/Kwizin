<?php 

    class Message{
        public static function getLastMessage($reciever_id, $sender_id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM messages WHERE reciever_id = :reciever_id AND sender_id = :sender_id OR reciever_id = :sender_id AND sender_id = :reciever_id ORDER BY time_sent DESC LIMIT 1");
            $stmt->bindValue(":reciever_id", $reciever_id);
            $stmt->bindValue(":sender_id", $sender_id);
            $stmt->execute();
            $message = $stmt->fetch();
            if($message !== false){
                if($message['sender_id'] == $sender_id){
                    return $message['message'];
                }else{
                    return "Jij: " . $message['message'];
                }
            }
            else{
                return "Nog geen berichten...";
            }
        }

        public static function getAllMessages($reciever_id, $sender_id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM messages WHERE reciever_id = :reciever_id AND sender_id = :sender_id OR reciever_id = :sender_id AND sender_id = :reciever_id ORDER BY time_sent DESC");
            $stmt->bindValue(":reciever_id", $reciever_id);
            $stmt->bindValue(":sender_id", $sender_id);
            $stmt->execute();
            $messages = $stmt->fetchAll();
            return $messages;
        }

        public static function addMessage($reciever_id, $sender_id, $message){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("INSERT INTO messages (reciever_id, sender_id, message) VALUES (:reciever_id, :sender_id, :message)");
            $stmt->bindValue(":reciever_id", $reciever_id);
            $stmt->bindValue(":sender_id", $sender_id);
            $stmt->bindValue(":message", $message);
            $stmt->execute();
            return $conn->lastInsertId();
        }

        public static function getMessageById($id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM messages WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $message = $stmt->fetch(PDO::FETCH_ASSOC);
            return $message;
        }
    }