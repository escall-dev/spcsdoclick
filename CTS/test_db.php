<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=sdo_cts;charset=utf8mb4", "root", "");
    echo "Connected successfully to sdo_cts!\n";
    $result = $conn->query("DESCRIBE complaint_documents")->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
