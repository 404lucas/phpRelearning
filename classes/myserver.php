<?php 

    class myserver {

        public static function listPizzas(){

            $pizzaList = connectionFactory::connect()->prepare("SELECT * FROM pizzas");
            $pizzaList->execute();
            $pizzaList = $pizzaList->fetchAll();

            return $pizzaList;
        }

        public static function insertPizza($flavor, $ingredients){

            connectionFactory::connect()->exec("INSERT INTO pizzas (sabor, ingredientes_ids) VALUES ('$flavor', '$ingredients')");

            echo '<br> sabor '.$flavor.' adicionado com sucesso!!';
        } 

        public static function deletePizza($id){

            connectionFactory::connect()->exec("DELETE FROM pizzas WHERE id = '$id'");
        }
    }

?>