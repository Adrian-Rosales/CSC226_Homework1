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

    $item = new Teams($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->id = $data->id;
    $item->name = $data->name;
    $item->win = $data->win;
    $item->loss = $data->loss;
    $item->tie = $data->tie;
    $item->date_entered = $data->date_entered;
    
    if($item->createTeam()){
        echo 'Team created successfully.';
    } else{
        echo 'Team could not be created.';
    }
