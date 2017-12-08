<?php

include "../models/UserStoryRepository.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$backlog = new UserStoryRepository($db,"Increment");

switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $backlog->getRootUserStories();
        break;
    case "POST":
        $result = $backlog->changeBacklogType(intval($_GET["id"]),$_GET["backlog"]);
        break;
    case "PUT":
        // This is not used
        parse_str(file_get_contents("php://input"), $_PUT);
        
        $result = $activities->update(array(
            "id" => intval($_PUT["id"]),
            "date" => $_PUT["date"],
            "description" => $_PUT["description"],
            "finished" => $_PUT["finished"] === "true" ? 1 : 0,
            "user_id" => intval($_PUT["user_id"])
        ));
        break;
        
    case "DELETE":
        $result = $backlog->remove(intval($_GET["id"]));
        break;
}


header("Content-Type: application/json");
$encoding = json_encode($result);
echo json_encode($result);

?>
