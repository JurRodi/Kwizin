<?php 

    class Preference {
        
        public static function getPreferences() {
            $preferences = ['Vegetarisch', 'Veganistisch', 'Pescotarisch', 'Halal', 'Glutenvrij'];
            return $preferences;
        }

        public static function getPreferencesByUser($userId) {
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM preferences WHERE user_id = :user_id");
            $stmt->bindValue(":user_id", $userId);
            $stmt->execute();
            $preferences = $stmt->fetchAll();
            return $preferences;
        }

        public static function setPreferences($userId, $preferences) {
            $conn = Db::getConnection();
            $stmt = $conn->prepare("DELETE FROM preferences WHERE user_id = :user_id");
            $stmt->bindValue(":user_id", $userId);
            $stmt->execute();
            foreach($preferences as $preference) {
                $stmt = $conn->prepare("INSERT INTO preferences (user_id, preference) VALUES (:user_id, :preference)");
                $stmt->bindValue(":user_id", $userId);
                $stmt->bindValue(":preference", $preference);
                $stmt->execute();
            }
        }
    }