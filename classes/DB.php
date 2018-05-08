<?php 
class DB{
    private $mysqli;
    function __construct(){
        $this->mysqli=new mysqli('localhost','root','','police_crime_record');
        if($this->mysqli->connect_error){
            $this->mysqli=false;
        }
        $this->mysqli->set_charset("utf8mb4");
    }
    function connect(){
        return $this->mysqli;
    }
    function deleteRow($table,$key,$value){
        $query="delete from $table where $key= ? ";
        $stmt=$this->connect()->prepare($query);
        $stmt->bind_param('s',$value);
        $stmt->execute();
        if($stmt->affected_rows===0){
            $stmt->close();    
            return false;
        }
        else{
            $stmt->close();
            return true;
        }
    }
    function update($table,$column,$new_value,$key,$value){
        $query="update $table set $column=? where $key= ?";
        $stmt=$this->mysqli->prepare($query);
        $stmt->bind_param('ss',$new_value,$value);
        if($stmt->affected_rows===0){
            $stmt->close();    
            return false;
        }
        else{
            $stmt->close();
            return true;
        }
    }
}
?>