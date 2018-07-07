<?php

class Produs  {

  private $photoPath;
  private $connect;
  public function __construct()
  {
      $host = 'localhost';
      $user = 'root';
      $database = 'lucrurifine';
      $password = '';
      try
      {
          $this->connect = new PDO('mysql:host='.$host.';dbname='.$database, $user, $password);
      }
      catch (PDOException $e)
      {
          print_r($e);
      }

      $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
      $this->connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }

  public function lastInsertId(){
      return $this->connect->lastInsertId();
  }


  public function photoPath() {
    $this->photoPath = 'imagini/';
    return $this->photoPath;
  }
  // private $servername;
  // private $username;
  // private $password;
  // private $dbname;
  // private $charset;
  // private $pdo;
  //
  // public function connect() {
  //   $this->servername = 'localhost';
  //   $this->username = 'root';
  //   $this->password = '';
  //   $this->dbname = 'lucrurifine';
  //   $this->charset = 'utf8mb4';
  //
  //
  // try
  // {
  //   $dsn = "mysql:host=".$this->servername."; dbname=".$this->dbname."; charset=".$this->charset;
  //   $this->pdo = new PDO($dsn, $this->username, $this->password);
  //   $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //   $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  //
  //   return $this->$pdo;
  //
  // }
  // catch(PDOException $e)
  // {
  //  echo "CONECTION FAILED: ".$e->getMessage();
  // }
  // }


    // disconnect from db
    public function Disconnect(){
        $this->connect = NULL;

    }
    // get row
    public function getRow($query, $params = []){
        try {
            $stmt = $this->connect->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // get rows
    public function getRows($query, $params = []){
        try {
            $stmt = $this->connect->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // insert row
    public function insertRow($query, $params = []){
        try {
            $stmt = $this->connect->prepare($query);
            $stmt->execute($params);
            return TRUE;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }



    // update row
    public function updateRow($query, $params = []){
        $this->insertRow($query, $params);
    }
    // delete row
    public function deleteRow($query, $params = []){
        $this->insertRow($query, $params);
    }
}

?>
