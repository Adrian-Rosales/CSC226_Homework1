<?php
class teams{

    // Connection
    private $conn;

    // Table
    private $db_table = "Teams";

    // Columns
    public $id;
    public $name;
    public $win;
    public $loss;
    public $tie;
    public $date_entered;

    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }

    // GET ALL
    public function getTeam(){
        $sqlQuery = "SELECT id, name, win, loss, tie, date_entered FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createTeam(){
        $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        win = :win, 
                        loss = :loss, 
                        tie = :tie, 
                        date_entered = :date_entered";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->win=htmlspecialchars(strip_tags($this->win));
        $this->loss=htmlspecialchars(strip_tags($this->loss));
        $this->tie=htmlspecialchars(strip_tags($this->tie));
        $this->date_entered=htmlspecialchars(strip_tags($this->date_entered));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":win", $this->win);
        $stmt->bindParam(":loss", $this->loss);
        $stmt->bindParam(":tie", $this->tie);
        $stmt->bindParam(":date_entered", $this->date_entered);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // UPDATE
    public function getSingleTeam(){
        $sqlQuery = "SELECT 
                        name, 
                        win, 
                        loss, 
                        tie, 
                        date_created,
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $dataRow['name'];
        $this->win = $dataRow['win'];
        $this->loss = $dataRow['loss'];
        $this->tie = $dataRow['tie'];
        $this->date_entered = $dataRow['date_entered'];
    }

    // UPDATE
    public function updateTeam(){
        $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        win = :win, 
                        loss = :loss, 
                        tie = :tie, 
                        date_entered = :date_entered
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->win=htmlspecialchars(strip_tags($this->win));
        $this->loss=htmlspecialchars(strip_tags($this->loss));
        $this->tie=htmlspecialchars(strip_tags($this->tie));
        $this->date_entered=htmlspecialchars(strip_tags($this->date_entered));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":win", $this->win);
        $stmt->bindParam(":loss", $this->loss);
        $stmt->bindParam(":tie", $this->tie);
        $stmt->bindParam(":date_entered", $this->date_entered);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // DELETE
    function deleteTeam(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

}


