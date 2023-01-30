<?php
   class Database {
       private $host = "pg-srv-nathan-lepron.postgres.database.azure.com";
       private $db_name = "pg-db-nathan-lepron";
       private $username = "postgree_user@pg-srv-nathan-lepron";//"" . $_ENV['usernamepostgre'] . "@pg-srv-nathan-lepron";
       private $password = "Password####PG";//"".$_ENV['passwordpostgre']."";
       public $conn;

       public function getConnection() {
           $this->conn = null;

           try {
               $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
           } catch(PDOException $exception) {
               echo "Connection error: " . $exception->getMessage();
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
   
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');
echo json_encode($rows);
?>