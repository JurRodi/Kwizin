<?php 

    include_once(__DIR__ . "/../bootstrap.php");	

    if(!empty($_POST)){
        $cultures = Culture::searchByName($_POST["name"]);
        foreach($cultures as $key => $culture){
            $cultures[$key]["name"] .= " cultuur";
        }
        $meals = Meal::searchMealByName($_POST['name'], $_POST['user_id']);

        $response = [
            'status' => 'succes',
            'body' => array_merge($cultures, $meals),
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    };

?>