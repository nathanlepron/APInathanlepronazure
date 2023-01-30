<?php
    $host = "pg-srv-nathan-lepron.postgres.database.azure.com";
    $db_name = "pg-db-nathan-lepron";
    $username = "" . $_ENV['usernamepostgre'] . "@pg-srv-nathan-lepron";
    $password = "".$_ENV['passwordpostgre']."";
    try {
        $conn = new PDO("pgsql:host=" . $host . ";dbname=" . $db_name, $username, $password);
    } catch(PDOException $exception) {
        echo "Connection error: " . $exception->getMessage();
    }
    $sql = "SELECT * FROM category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header('Content-Type: application/json');
    echo json_encode($rows);
?>