<?php 

    class Meal{
        protected $name;
        protected $description;
        protected $culture;
        protected $price;
        protected $image;

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        /**
         * Get the value of culture
         */ 
        public function getCulture()
        {
                return $this->culture;
        }

        /**
         * Set the value of culture
         *
         * @return  self
         */ 
        public function setCulture($culture)
        {
                $this->culture = $culture;

                return $this;
        }

        /**
         * Get the value of price
         */ 
        public function getPrice()
        {
                return $this->price;
        }

        /**
         * Set the value of price
         *
         * @return  self
         */ 
        public function setPrice($price)
        {
                $this->price = $price;

                return $this;
        }

        /**
         * Get the value of image
         */ 
        public function getImage()
        {
                return $this->image;
        }

        /**
         * Set the value of image
         *
         * @return  self
         */ 

        public function setImage($image)
        {
                $this->image = $image;

                return $this;
        }

        public static function getAll($user_id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM meals WHERE user_id != :user_id");
            $stmt->bindValue(":user_id", $user_id);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function getMealsByCulture($culture_id, $user_id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM meals WHERE culture_id = :culture_id AND user_id != :user_id");
            $stmt->bindValue(":culture_id", $culture_id);
            $stmt->bindValue(":user_id", $user_id);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function getMealsByUser($user_id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM meals WHERE user_id = :user_id LIMIT 6");
            $stmt->bindValue(":user_id", $user_id);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function getAllMealsByUser($user_id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT * FROM meals WHERE user_id = :user_id");
                $stmt->bindValue(":user_id", $user_id);
                $stmt->execute();
                return $stmt->fetchAll();
            }

        public static function getById($id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM meals WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetch();
        }

        public static function getUserById($id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetch();
        }

        public static function getGuests($meal_id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT * FROM users WHERE id IN (SELECT user_id FROM meal_users WHERE meal_id = :meal_id)");
                $stmt->bindValue(":meal_id", $meal_id);
                $stmt->execute();
                return $stmt->fetchAll();
        }

        public static function countGuests($meal_id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT COUNT(id) FROM meal_users WHERE meal_id = :meal_id");
                $stmt->bindValue(":meal_id", $meal_id);
                $stmt->execute();
                return $stmt->fetch()[0];
        }

        public static function addMeal($user_id, $culture_id, $name, $description, $price, $location, $meetingTime){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("INSERT INTO meals (user_id, culture_id, name, description, price, location, meetingTime) VALUES (:user_id, :culture_id, :name, :description, :price, :location, :meetingTime)");
                $stmt->bindValue(":user_id", $user_id);
                $stmt->bindValue(":culture_id", $culture_id);
                $stmt->bindValue(":name", $name);
                $stmt->bindValue(":description", $description);
                $stmt->bindValue(":price", $price);
                $stmt->bindValue(":location", $location);
                $stmt->bindValue(":meetingTime", $meetingTime);
                $stmt->execute();
                return $conn->lastInsertId();
        }

        public static function calculateMealRating($meal_id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT AVG(meal_rating) FROM reviews WHERE meal_id = :meal_id");
                $stmt->bindValue(":meal_id", $meal_id);
                $stmt->execute();
                return round($stmt->fetch()[0]);
        }

        public static function getBestMeals(){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT * FROM meals WHERE id IN (SELECT meal_id FROM reviews ORDER BY meal_rating DESC) LIMIT 3"); //SELECT meal_id FROM reviews WHERE meal_id IN (SELECT id FROM meals WHERE user_id = :user_id) ORDER BY meal_rating DESC LIMIT 3
                $stmt->execute();
                return $stmt->fetchAll();
        }

        public static function signUp($user_id, $meal_id, $reconnect_id){
                $conn = Db::getConnection();
                $check = $conn->prepare("SELECT * FROM meal_users WHERE user_id = :user_id AND meal_id = :meal_id");
                $check->bindValue(":user_id", $user_id);
                $check->bindValue(":meal_id", $meal_id);
                $check->execute();
                if($check->rowCount() == 0){
                    $stmt = $conn->prepare("INSERT INTO meal_users (user_id, meal_id) VALUES (:user_id, :meal_id)");
                    $stmt->bindValue(":user_id", $user_id);
                    $stmt->bindValue(":meal_id", $meal_id);
                    $stmt->execute();
                    $connCheck = $conn->prepare("SELECT * FROM connections WHERE user_id = :user_id AND reconnect_id = :reconnect_id");
                    $connCheck->bindValue(":user_id", $user_id);
                    $connCheck->bindValue(":reconnect_id", $reconnect_id);
                    $connCheck->execute();
                    if($connCheck->rowCount() == 0){
                        $stmt = $conn->prepare("INSERT INTO connections (user_id, reconnect_id) VALUES (:user_id, :reconnect_id)");
                        $stmt->bindValue(":user_id", $user_id);
                        $stmt->bindValue(":reconnect_id", $reconnect_id);
                        $stmt->execute();
                    }
                }
        }

        public static function cancelSignUp($user_id, $meal_id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("DELETE FROM meal_users WHERE user_id = :user_id AND meal_id = :meal_id");
                $stmt->bindValue(":user_id", $user_id);
                $stmt->bindValue(":meal_id", $meal_id);
                return $stmt->execute();
        }

        public static function getMealByName($name){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT * FROM meals WHERE name = :name");
                $stmt->bindValue(":name", $name);
                $stmt->execute();
                return $stmt->fetch();
        }

        public static function searchMealByName($name){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT * FROM meals WHERE name LIKE :name");
                $stmt->bindValue(":name", $name . "%");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }