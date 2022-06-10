<?php 

    class Review{
        protected $meal_rating;
        protected $user_rating;
        protected $text;
        protected $meal_id;
        protected $user_id;

        /**
         * Get the value of meal_rating
         */ 
        public function getMeal_rating()
        {
                return $this->meal_rating;
        }

        /**
         * Set the value of meal_rating
         *
         * @return  self
         */ 
        public function setMeal_rating($meal_rating)
        {
                $this->meal_rating = $meal_rating;

                return $this;
        }

        /**
         * Get the value of user_rating
         */ 
        public function getUser_rating()
        {
                return $this->user_rating;
        }

        /**
         * Set the value of user_rating
         *
         * @return  self
         */ 
        public function setUser_rating($user_rating)
        {
                $this->user_rating = $user_rating;

                return $this;
        }

        /**
         * Get the value of text
         */ 
        public function getText()
        {
                return $this->text;
        }

        /**
         * Set the value of text
         *
         * @return  self
         */ 
        public function setText($text)
        {
                $this->text = $text;

                return $this;
        }

        /**
         * Get the value of meal_id
         */ 
        public function getMeal_id()
        {
                return $this->meal_id;
        }

        /**
         * Set the value of meal_id
         *
         * @return  self
         */ 
        public function setMeal_id($meal_id)
        {
                $this->meal_id = $meal_id;

                return $this;
        }

        /**
         * Get the value of user_id
         */ 
        public function getUser_id()
        {
                return $this->user_id;
        }

        /**
         * Set the value of user_id
         *
         * @return  self
         */ 
        public function setUser_id($user_id)
        {
                $this->user_id = $user_id;

                return $this;
        }

        public static function getReviewsByMealId($meal_id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM reviews WHERE meal_id = :meal_id");
            $stmt->bindValue(":meal_id", $meal_id);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function getAllReviewsByUser($user_id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT * FROM reviews WHERE meal_id IN (SELECT id FROM meals WHERE user_id = :user_id)");
                $stmt->bindValue(":user_id", $user_id);
                $stmt->execute();
                return $stmt->fetchAll();
        }

        public static function getReviewsByUser($user_id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT * FROM reviews WHERE meal_id IN (SELECT id FROM meals WHERE user_id = :user_id) LIMIT 3");
                $stmt->bindValue(":user_id", $user_id);
                $stmt->execute();
                return $stmt->fetchAll();
        }

        public static function getRatingFromReviewer($user_id){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("SELECT user_rating FROM reviews WHERE user_id = :user_id");
                $stmt->bindValue(":user_id", $user_id);
                $stmt->execute();
                return $stmt->fetch()[0];
        }

        public static function postReview($meal_id, $user_id, $user_rating, $meal_rating, $text){
                $conn = Db::getConnection();
                $stmt = $conn->prepare("INSERT INTO reviews (meal_id, user_id, user_rating, meal_rating, text) VALUES (:meal_id, :user_id, :user_rating, :meal_rating, :text)");
                $stmt->bindValue(":meal_id", $meal_id);
                $stmt->bindValue(":user_id", $user_id);
                $stmt->bindValue(":user_rating", $user_rating);
                $stmt->bindValue(":meal_rating", $meal_rating);
                $stmt->bindValue(":text", $text);
                $stmt->execute();
        }
    }