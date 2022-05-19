<?php 

    class User{
        protected $firstName;
        protected $lastName;
        protected $email;
        protected $password;
        protected $bio;
        protected $culture;
        protected $avatar;

        /**
         * Get the value of firstName
         */ 
        public function getFirstName()
        {
                return $this->firstName;
        }

        /**
         * Set the value of firstName
         *
         * @return  self
         */ 
        public function setFirstName($firstName)
        {
                $this->firstName = $firstName;

                return $this;
        }

        /**
         * Get the value of lastName
         */ 
        public function getLastName()
        {
                return $this->lastName;
        }

        /**
         * Set the value of lastName
         *
         * @return  self
         */ 
        public function setLastName($lastName)
        {
                $this->lastName = $lastName;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of bio
         */ 
        public function getBio()
        {
                return $this->bio;
        }

        /**
         * Set the value of bio
         *
         * @return  self
         */ 
        public function setBio($bio)
        {
                $this->bio = $bio;

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
         * Get the value of avatar
         */ 
        public function getAvatar()
        {
                return $this->avatar;
        }

        /**
         * Set the value of avatar
         *
         * @return  self
         */ 
        public function setAvatar($avatar)
        {
                $this->avatar = $avatar;

                return $this;
        }

        public static function getAllPrevConnected($id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT * FROM users WHERE id IN (SELECT reconnect_id FROM connections WHERE user_id = :id)");
                $stmt->bindValue(":id", $id);
                $stmt->execute();
                return $stmt->fetchAll();
        }

        public static function getById($id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
                $stmt->bindValue(":id", $id);
                $stmt->execute();
                return $stmt->fetch();
        }

        public static function getAllMeals($id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT * FROM meals WHERE user_id = :id");
                $stmt->bindValue(":id", $id);
                $stmt->execute();
                return $stmt->fetchAll();
        }

        public static function calculateUserRating($user_id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT AVG(user_rating) FROM reviews WHERE meal_id IN (SELECT id FROM meals WHERE user_id = :user_id)");
                $stmt->bindValue(":user_id", $user_id);
                $stmt->execute();
                return round($stmt->fetch()[0]);
        }

        public static function calculateCookingRating($user_id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT AVG(meal_rating) FROM reviews WHERE meal_id IN (SELECT id FROM meals WHERE user_id = :user_id)");
                $stmt->bindValue(":user_id", $user_id);
                $stmt->execute();
                return round($stmt->fetch()[0]);
        }

        public static function getFavorits($id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT * FROM meals WHERE id IN (SELECT meal_id FROM favorites WHERE user_id = :id)");
                $stmt->bindValue(":id", $id);
                $stmt->execute();
                return $stmt->fetchAll();
        }
    }
?>