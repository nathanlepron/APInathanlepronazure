<?php
    $kv_username = "" .$_ENV['usernamepostgre']."@pg-srv-nathan-lepron";
    $kv_password = $_ENV['passwordpostgre'];
   class Database {
       private $host = "pg-srv-nathan-lepron.postgres.database.azure.com";
       private $db_name = "pg-db-nathan-lepron";
       public $conn;

       public function getConnection() {
           $this->conn = null;

           try {
               $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name, $kv_username, $kv_password);
           } catch(PDOException $exception) {
               echo "Connection error: " . $exception->getMessage() . "/" . $kv_password . "/" . $kv_username;
           }

           return $this->conn;
       }
       public function readAllCategories() {
        $sql = "SELECT * FROM category";
 
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
 
        return $stmt;
    }
   }
   $database = new Database();
   $conn = $database->getConnection();
   $stmt = $database->readAllCategories();
   $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo $kv_password;
echo $kv_username;
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: *");
//header('Content-Type: application/json');
//echo json_encode($rows);
?>