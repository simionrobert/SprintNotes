<?php

include "User.php";

class UserRepository {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /*
     * Momentarily No need for this
     */ 
    private function read($row) {
        $result = new User();
        $result->id = $row["ID"];
        $result->name = $row["Name"];
        $result->username = $row["Username"];
        $result->password = $row["Password"];
        return $result;
    }

    /*
     * Momentarily No need for this
     */ 
    public function getAll() {
        $sql = "SELECT * FROM users";
        $q = $this->db->prepare($sql);
        $q->execute();
        $rows = $q->fetchAll();

        $result = array();
        foreach($rows as $row) {
            array_push($result, $this->read($row));
        }
        return $result;
    }

     public function verifyUser($username, $password) {
        $sql = "select * from users where password='$password' AND username='$username'";
        $q = $this->db->prepare($sql);
        $q->execute();
        
        $rows = $q->rowCount();
        
        // Take care if there are multiple users with the same username and password
        return $rows >= 1 ? 1 : 0;
    }
    
    public function getID($username) {
        $sql = "select ID from users where username='$username'";
        $q = $this->db->prepare($sql);
        $q->execute();
       
        $row = $q->fetch();
        return $row["ID"];
    }
    
    public function getName($id) {
        $sql = "select Name from users where ID=$id";
        $q = $this->db->prepare($sql);
        $q->execute();
        
        $row = $q->fetch();
        return $row["Name"];
    }
}

?>