<?php 

    include_once(__DIR__ . "/../bootstrap.php");	

    if(!empty($_POST)){
        $meal = Meal::searchMealByName($_POST['name']);

        $response = [
            'status' => 'succes',
            'body' => $meal,
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    };

?>