<?php 

    class Culture{
        protected $name;

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

        public static function getAll(){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM cultures");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public static function getById($id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM cultures WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetch();
        }
    }