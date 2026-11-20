<?php
require_once "condb.php";

try {
    $stmt = $conn->prepare("SELECT id, emp_code, full_name, position, department, email, phone, salary FROM employees ORDER BY id ASC");
    $stmt->execute();
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $employees
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "ไม่สามารถดึงข้อมูลพนักงานได้: " . $e->getMessage()
    ]);
}
?>
