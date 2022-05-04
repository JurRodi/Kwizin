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

        public static function getAll(){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM meals");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function getMealsByCulture($culture_id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM meals WHERE culture_id = :culture_id");
            $stmt->bindValue(":culture_id", $culture_id);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function getMealByUser($user_id){
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

        public static function getAllGuests(){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM meal_users");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function countGuests($meal_id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT COUNT(id) FROM meal_users WHERE meal_id = :meal_id");
            $stmt->bindValue(":meal_id", $meal_id);
            return $stmt->execute();
        }
    }