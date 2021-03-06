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

        public static function addMeal($user_id, $culture_id, $name, $description, $price, $location, $meetingTime, $max_guests){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("INSERT INTO meals (user_id, culture_id, name, description, price, location, meetingTime, max_guests) VALUES (:user_id, :culture_id, :name, :description, :price, :location, :meetingTime, :max_guests)");
                $stmt->bindValue(":user_id", $user_id);
                $stmt->bindValue(":culture_id", $culture_id);
                $stmt->bindValue(":name", $name);
                $stmt->bindValue(":description", $description);
                $stmt->bindValue(":price", $price);
                $stmt->bindValue(":location", $location);
                $stmt->bindValue(":meetingTime", $meetingTime);
                $stmt->bindValue(":max_guests", $max_guests);
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

        public static function getBestMeals($user_id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT meal_id FROM reviews WHERE meal_id IN (SELECT id FROM meals WHERE user_id = :user_id) ORDER BY meal_rating DESC LIMIT 3");
                $stmt->bindValue(":user_id", $user_id);
                $stmt->execute();
                $meal_ids = $stmt->fetchAll();
                if(count($meal_ids) == 0){
                    return null;
                }
                foreach($meal_ids as $meal){
                    $meals[] = self::getById($meal['meal_id']);
                }
                return $meals;
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

        public static function searchMealByName($name, $user_id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT * FROM meals WHERE name LIKE :name AND user_id != :user_id");
                $stmt->bindValue(":name", $name . "%");
                $stmt->bindValue(":user_id", $user_id);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function filterMeals($filter, $user_id){
                $conn = Db::getConnection();
                if(!empty($filter["culture"]) && !empty($filter["city"])){
                    $stmt = $conn->prepare("SELECT * FROM meals WHERE culture_id = :culture_id AND price <= :price AND location = :location AND user_id != :user_id");
                    $stmt->bindValue(":culture_id", $filter["culture"]);
                    $stmt->bindValue(":price", $filter["price"]);
                    $stmt->bindValue(":location", $filter["city"]);
                    $stmt->bindValue(":user_id", $user_id);
                }
                else if(!empty($filter["culture"])){
                    $stmt = $conn->prepare("SELECT * FROM meals WHERE culture_id = :culture_id AND price <= :price AND user_id != :user_id");
                    $stmt->bindValue(":culture_id", $filter["culture"]);
                    $stmt->bindValue(":price", $filter["price"]);
                    $stmt->bindValue(":user_id", $user_id);
                }
                else if(!empty($filter["city"])){
                    $stmt = $conn->prepare("SELECT * FROM meals WHERE location = :location AND price <= :price AND user_id != :user_id");
                    $stmt->bindValue(":location", $filter["city"]);
                    $stmt->bindValue(":price", $filter["price"]);
                    $stmt->bindValue(":user_id", $user_id);
                }
                else{
                    $stmt = $conn->prepare("SELECT * FROM meals WHERE price <= :price AND user_id != :user_id");
                    $stmt->bindValue(":price", $filter["price"]);
                    $stmt->bindValue(":user_id", $user_id);
                }
                $stmt->execute();
                return $stmt->fetchAll();
        }
    }