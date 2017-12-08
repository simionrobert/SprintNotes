<?php

include "../models/UserRepository.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$users = new UserRepository($db);


switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $users->getAll();
        break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>