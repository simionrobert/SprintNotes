<?php

class UserStory {
    public $id;
    public $title;
    
    public $addedTimestamp;
    public $deadlineTimestamp;
    public $startTimestamp;
    public $stopTimestamp;
    
    public $fk_User_ID;
    public $fk_BacklogType_ID;
    public $fk_ParentUserStory;
    
    public function __construct($id,$title,
        $addedTimestamp,$deadlineTimestamp,$startTimestamp,$stopTimestamp,$fk_User_ID,$fk_BacklogType_ID,$fk_ParentUserStory){
       
            $this->id = $id;
            $this->title = $title;

            $this->addedTimestamp = $addedTimestamp;
            $this->deadlineTimestamp = $deadlineTimestamp;
            $this->startTimestamp = $startTimestamp;
            $this->stopTimestamp = $stopTimestamp;
            
            $this->fk_User_ID=$fk_User_ID;
            $this->fk_BacklogType_ID = $fk_BacklogType_ID;
            $this->fk_ParentUserStory = $fk_ParentUserStory;
   }
}

?>