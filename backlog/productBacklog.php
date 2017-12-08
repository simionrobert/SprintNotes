<?php

include "../models/UserStoryRepository.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$backlog = new UserStoryRepository($db,"ProductBacklog");

switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $backlog->getRootUserStories();
        break;  
    case "POST":
        if($_SERVER['PATH_INFO'] == "/changeBacklog"){
            $result = $backlog->changeBacklogType(intval($_GET["id"]),$_GET["backlog"]);
        }
        else  if($_SERVER['PATH_INFO'] == "/addUserStory"){
            $title = $_POST["title"];
            //$deadlineTimestamp = $_POST["deadlineTimestamp"];
            
            //construct userstoryJSON
            $userStoryJSON["id"]=0;
            $userStoryJSON["title"] = $title;
            $userStoryJSON["addedTimestamp"] = date('Y-m-d H:m:s');
            $userStoryJSON["deadlineTimestamp"] = date('Y-m-d H:m:s');
            $userStoryJSON["startTimestamp"] = null;
            $userStoryJSON["stopTimestamp"] = null;
            $userStoryJSON["fk_ParentUserStory"]=null;
           
            $result = $backlog->insert($userStoryJSON);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
        
        break;
    case "PUT":

        break;
    case "DELETE":
        $result = $backlog->remove(intval($_GET["id"]));
        break;
}


header("Content-Type: application/json");
$encoding = json_encode($result);
echo json_encode($result);

?>
