<?php
    $kv_username = "" .$_ENV['usernamepostgre']."@pg-srv-nathan-lepron";
    $kv_password = $_ENV['passwordpostgre'];
   class Database {
       private $host = "pg-srv-nathan-lepron.postgres.database.azure.com";
       private $db_name = "pg-db-nathan-lepron";
       public $conn;

       public function getConnection($username,$password) {
           $this->conn = null;

           try {
               $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name, $username, $password);
           } catch(PDOException $exception) {
               echo "Connection error: " . $exception->getMessage() . "/" . $password . "/" . $username;
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
   $conn = $database->getConnection($kv_username,$kv_password);
   $stmt = $database->readAllCategories();
   $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');
echo json_encode($rows);
?>