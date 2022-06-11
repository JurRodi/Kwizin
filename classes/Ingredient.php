<?php 

    class Ingredient{

        public static function addIngredient($name, $meal_id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("INSERT INTO ingredients (name, meal_id) VALUES (:name, :meal_id)");
            $stmt->bindValue(":name", $name);
            $stmt->bindValue(":meal_id", $meal_id);
            return $stmt->execute();
        }

        public static function getAllIngredients(){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM ingredients");
            $stmt->execute();
            $ingredients = $stmt->fetchAll();
            return $ingredients;
        }

        public static function getIngredientById($id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM ingredients WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $ingredient = $stmt->fetch();
            return $ingredient;
        }

        public static function getIngredientByName($name){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM ingredients WHERE name = :name");
            $stmt->bindValue(":name", $name);
            $stmt->execute();
            $ingredient = $stmt->fetch();
            return $ingredient;
        }

        public static function getIngredientByMealId($meal_id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("SELECT * FROM ingredients WHERE meal_id = :meal_id");
            $stmt->bindValue(":meal_id", $meal_id);
            $stmt->execute();
            $ingredients = $stmt->fetchAll();
            return $ingredients;
        }

        public static function deleteIngredient($id){
            $conn = Db::getConnection();
            $stmt = $conn->prepare("DELETE FROM ingredients WHERE id = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
        }
    }