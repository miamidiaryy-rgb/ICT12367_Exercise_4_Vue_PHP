<?php
require_once "condb.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        "success" => false,
        "message" => "Method Not Allowed"
    ]);
    exit();
}

$input = json_decode(file_get_contents("php://input"), true);

$emp_code = trim($input['emp_code'] ?? '');
$full_name = trim($input['full_name'] ?? '');
$position = trim($input['position'] ?? '');
$department = trim($input['department'] ?? '');
$email = trim($input['email'] ?? '');
$phone = trim($input['phone'] ?? '');
$salary = isset($input['salary']) ? floatval($input['salary']) : 0;

if ($emp_code === '' || $full_name === '' || $position === '' || $department === '') {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วน"
    ]);
    exit();
}

try {
    $sql = "INSERT INTO employees (emp_code, full_name, position, department, email, phone, salary)
            VALUES (:emp_code, :full_name, :position, :department, :email, :phone, :salary)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':emp_code' => $emp_code,
        ':full_name' => $full_name,
        ':position' => $position,
        ':department' => $department,
        ':email' => $email,
        ':phone' => $phone,
        ':salary' => $salary,
    ]);

    http_response_code(201);
    echo json_encode([
        "success" => true,
        "message" => "เพิ่มข้อมูลพนักงานเรียบร้อยแล้ว",
        "id" => $conn->lastInsertId()
    ]);
} catch (PDOException $e) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => "ไม่สามารถเพิ่มข้อมูลพนักงานได้: " . $e->getMessage()
    ]);
}
?>
