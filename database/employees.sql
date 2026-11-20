CREATE DATABASE IF NOT EXISTS company_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE company_db;

CREATE TABLE IF NOT EXISTS employees (
  id INT AUTO_INCREMENT PRIMARY KEY,
  emp_code VARCHAR(20) NOT NULL UNIQUE,
  full_name VARCHAR(100) NOT NULL,
  position VARCHAR(100) NOT NULL,
  department VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  salary DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO employees (emp_code, full_name, position, department, email, phone, salary) VALUES
('EMP001', 'สมชาย ใจดี', 'โปรแกรมเมอร์', 'ไอที', 'somchai.j@company.co.th', '081-234-5678', 35000.00),
('EMP002', 'สุภาพร รักเรียน', 'นักวิเคราะห์ระบบ', 'ไอที', 'supaporn.r@company.co.th', '082-345-6789', 42000.00),
('EMP003', 'กิตติพงษ์ มั่นคง', 'เจ้าหน้าที่บุคคล', 'ทรัพยากรบุคคล', 'kittipong.m@company.co.th', '083-456-7890', 28000.00),
('EMP004', 'นภาพร แสงทอง', 'พนักงานบัญชี', 'บัญชีและการเงิน', 'napaporn.s@company.co.th', '084-567-8901', 30000.00),
('EMP005', 'ธนากร ศรีสุข', 'ผู้จัดการฝ่ายขาย', 'การขาย', 'thanakorn.s@company.co.th', '085-678-9012', 48000.00);
