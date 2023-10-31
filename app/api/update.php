<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/teams.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new teams($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    // employee values
    $item->name = $data->name;
    $item->win = $data->win;
    $item->loss = $data->loss;
    $item->tie = $data->tie;
    $item->date_entered = date('Y-m-d H:i:s');
    
    if($item->updateTeam()){
        echo json_encode("Team data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>