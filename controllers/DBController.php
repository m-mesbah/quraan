
<?php
class ConnectDb{
  private $servername ;
  private $username ;
  private $password ;
  private $dbname ;
  function __construct($servername, $username, $password, $dbname){
      $this->servername=$servername;
      $this->username=$username;
      $this->password=$password;
      $this->dbname=$dbname;

  }

      //method to connect with database

  function connectdb(){
      $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      return $conn;
  }

//CRUD methods 

function insert_row($table, $fields, $values ){
  global $conn;
  $quoted = array_map(function($item) { return "`" . $item . "`"; }, $fields);
  $fields = implode(", ", $quoted) ?? '';
  //////////////
  $quoted = array_map(function($item) { return "'" . $item . "'"; }, $values);
  $values = implode(", ", $quoted) ?? '';

    if ($values == null || $fields == null) {
      array_push(DataHandlingController::$errs,"Thers an error in code call the programmar");
      echo (json_encode(DataHandlingController::$errs)); 
      die();
    } 
    
    else {

        $query = "INSERT INTO $table ($fields) VALUES ($values)  ";
        // die( $query);
    }
    $result = mysqli_query($conn, $query);
    return $result;
  }


  function insert($conn,$sql){
    if ($conn->query($sql) !== TRUE) {
      array_push(DataHandlingController::$errs,$conn->error);         
    } 
    
  }

  function select($conn,$sql){
    $result = $conn->query($sql);
    return $result;   
    
  }

  function select_rows($table, $fields, $where = "")
  {
    global $conn;
    if ($where == "") {
        $query = "SELECT " . $fields . " FROM " . $table . "";
    } else {
        $query = "SELECT " . $fields . " FROM " . $table . $where;
    }
    $result = mysqli_query($conn, $query);
    // die($query);
    return $result;
  }

  function update_row($table, $fields, $values , $where ){
    global $conn;
      if ($values == null || $fields == null) {
        array_push(DataHandlingController::$errs,"Thers an error in code call the programmar");
        echo (json_encode(DataHandlingController::$errs)); 
        die();
      } 
      
      else {
        if(is_array($values) && is_array($fields)){
        $sets='';$seperate_sets = ' , ';
        $sets_count = count($fields);
        for( $i=0 ; $i < count($values) ; $i++)
        {
          if($i == count($values)-1)$seperate_sets='';
          $sets .= $fields[$i] . " = '". $values[$i] . "'" .  $seperate_sets;
        }


          $query = "UPDATE   $table SET $sets  $where ";
          // die($query);
      }
      else{
        $sets = $fields . " = '". $values . "' " ;

        $query = "UPDATE   $table SET $sets  $where ";
        // die($query);

      }
    }
    // die($query);
      $result = mysqli_query($conn, $query);
      return $result;
  }

  function delete_row($table, $field, $value){
    global $conn;  
      if ($value == null || $field == null) {
        array_push(DataHandlingController::$errs,"Thers an error in code call the programmar");
        echo (json_encode(DataHandlingController::$errs)); 
        die();
      } 
      else {
          $query = "DELETE FROM $table WHERE $field = $value";
      }
      $result = mysqli_query($conn, $query);
      return $result;
  }

}