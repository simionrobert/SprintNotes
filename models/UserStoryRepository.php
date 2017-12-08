<?php
session_start();

include "UserStory.php";

class UserStoryRepository{
    
    private $db;
    private $userID;
    private $backlogType;
    
    public function __construct($db, $backlog){
        $this->userID = $_SESSION['logged_user'];
        $this->db = $db;
        $this->backlogType = $backlog;
    }
    
    public function getRootUserStories()
    {
        $sql = "SELECT *
            FROM userstory
            INNER JOIN backlogtype ON userstory.FK_BacklogType_ID = backlogtype.ID
            WHERE FK_User_ID = '$this->userID'
            AND backlogtype.Name = '$this->backlogType'";
        
        return $this->readRows($sql);
    }
    
    public function getChildrenUserStories( $parentUserStoryID)
    {
        $sql = "SELECT *
            FROM userstory
            INNER JOIN backlogtype ON userstory.FK_BacklogType_ID = backlogtype.ID
            WHERE backlogtype.Name = '$this->backlogType'
            AND FK_User_ID = '$this->userID'
            AND FK_ParentUserStory = '$parentUserStoryID';";
        
        return $this->readRows($sql);
    }
    
    public function insert($userStoryJSON)
    {
        $backlogID = $this->getBacklogID($this->backlogType);
        
        $userStory = new UserStory(0, $userStoryJSON["title"], $userStoryJSON["addedTimestamp"], 
                                    $userStoryJSON["deadlineTimestamp"], $userStoryJSON["startTimestamp"], 
                                    $userStoryJSON["stopTimestamp"], $this->userID,
                                    $backlogID,$userStoryJSON["fk_ParentUserStory"]);

        //$sql = "INSERT INTO userstory
        //VALUES ($userStory->id, $userStory->title, $userStory->addedTimestamp,$userStory->deadlineTimestamp,
       // $userStory->startTimestamp,$userStory->stopTimestamp,$userStory->fk_User_ID,$userStory->fk_BacklogType_ID,
        //$userStory->fk_ParentUserStory);";
        
        $sql ="INSERT INTO userstory (ID, Title, AddedTimestamp,FK_User_ID,FK_BacklogType_ID)
        VALUES ($userStory->id, '$userStory->title', '$userStory->addedTimestamp',
        $userStory->fk_User_ID,$userStory->fk_BacklogType_ID)";
        
        $q = $this->db->prepare($sql);
        $r = $q->execute();
        
        return $r;
    }
    
    public function changeBacklogType($userStoryID,$backlog)
    {
        $sql=null;
        $backlogIDSource = $this->getBacklogID($this->backlogType);
        $backlogIDDestination = $this->getBacklogID($backlog);
        
        if($backlogIDSource == 1){
            $date = date('Y-m-d H:m:s');
            $sql ="UPDATE userstory
                SET userstory.FK_BacklogType_ID=(SELECT backlogtype.ID
                                            FROM backlogtype
                                            WHERE backlogtype.Name='$backlog'),
                userstory.StartTimestamp = '$date'
                WHERE userstory.ID = $userStoryID" ;
            
        } else if($backlogIDSource == 2 && $backlogIDDestination ==3){
            $date = date('Y-m-d H:m:s');
            $sql ="UPDATE userstory
                SET userstory.FK_BacklogType_ID=(SELECT backlogtype.ID
                                            FROM backlogtype
                                            WHERE backlogtype.Name='$backlog'),
                 userstory.StopTimestamp = '$date'
                WHERE userstory.ID = $userStoryID" ;
            
        } else if($backlogIDSource == 2 && $backlogIDDestination ==1){
            
            $sql ="UPDATE userstory
                SET userstory.FK_BacklogType_ID=(SELECT backlogtype.ID
                                            FROM backlogtype
                                            WHERE backlogtype.Name='$backlog'),
                userstory.StartTimestamp = NULL,
                userstory.StopTimestamp = NULL
                WHERE userstory.ID = $userStoryID" ;
            
        } else{
            $sql ="UPDATE userstory
            SET userstory.FK_BacklogType_ID=(SELECT backlogtype.ID
                                        FROM backlogtype
                                        WHERE backlogtype.Name='$backlog')
            WHERE userstory.ID = $userStoryID" ;
            
        }

        if($sql!=null){
            $q = $this->db->prepare($sql);
            $q->execute();
        }

        return;
    }
    
    public function remove($UserStoryID)
    {
        $sql = "DELETE FROM userstory
                WHERE ID = $UserStoryID;";
        
        $q = $this->db->prepare($sql);
        $q->execute();
        
        return;
    }
    
    private function getBacklogID($backlog){
        $sql = "SELECT ID
            FROM backlogtype
            WHERE Name = '$backlog'";
        
        $q = $this->db->prepare($sql);
        $q->execute();
        return $q->fetchAll()[0][0];
    }
    
    private function read($row) {
        return new UserStory($row["0"], $row["Title"],
            $row["AddedTimestamp"],$row["DeadlineTimestamp"],
            $row["StartTimestamp"],$row["StopTimestamp"],null,null,null);
    }
    
    private function readRows($sql){
        $q = $this->db->prepare($sql);
        $q->execute();
        $rows = $q->fetchAll();
        
        $listUserStory = array();
        foreach($rows as $row) {
            array_push($listUserStory, $this->read($row));
        }
        
        return $listUserStory;
    }
}