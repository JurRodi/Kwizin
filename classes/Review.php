<?php 

    class Review{
        protected $rating;
        protected $text;
        protected $meal_id;
        protected $user_id;
        protected $receiving_user_id;

        /**
         * Get the value of rating
         */ 
        public function getRating()
        {
                return $this->rating;
        }

        /**
         * Set the value of rating
         *
         * @return  self
         */ 
        public function setRating($rating)
        {
                $this->rating = $rating;

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

        /**
         * Get the value of receiving_user_id
         */ 
        public function getReceiving_user_id()
        {
                return $this->receiving_user_id;
        }

        /**
         * Set the value of receiving_user_id
         *
         * @return  self
         */ 
        public function setReceiving_user_id($receiving_user_id)
        {
                $this->receiving_user_id = $receiving_user_id;

                return $this;
        }

        public static function getReviewsByMealId($meal_id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM reviews WHERE meal_id = :meal_id");
            $stmt->bindValue(":meal_id", $meal_id);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }