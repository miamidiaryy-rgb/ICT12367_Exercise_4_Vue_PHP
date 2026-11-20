# แบบฝึกหัดที่ 4: โปรแกรมเพิ่มข้อมูลพนักงานและแสดงข้อมูล (Vue.js + PHP)

รายวิชา **ICT12367 การใช้กรอบงานสำหรับการพัฒนาเว็บแอปพลิเคชันเพื่อความปลอดภัย**

## โครงสร้างโปรเจกต์
- `src/` — หน้าเว็บ Front-end พัฒนาด้วย Vue 3 + Bootstrap 5
  - `src/components/EmployeeList.vue` — หน้าแสดงรายชื่อพนักงาน (ดึงข้อมูลจาก `show_employees.php`)
  - `src/components/AddEmployee.vue` — หน้าฟอร์มเพิ่มข้อมูลพนักงาน (ส่งข้อมูลไป `add_employee.php`)
- `php_api/` — Back-end API พัฒนาด้วย PHP (PDO)
  - `condb.php` — เชื่อมต่อฐานข้อมูล MySQL และตั้งค่า CORS
  - `show_employees.php` — API ดึงข้อมูลพนักงาน (`GET`)
  - `add_employee.php` — API เพิ่มข้อมูลพนักงาน (`POST`)
- `database/employees.sql` — สคริปต์สร้างฐานข้อมูล `company_db` และตาราง `employees`

## วิธีติดตั้งและรันโปรเจกต์

### 1. นำเข้าฐานข้อมูล
นำเข้าไฟล์ `database/employees.sql` ใน phpMyAdmin หรือ MySQL

### 2. รัน PHP API
```bash
php -S localhost:8000
```
*(หรือคัดลอกโฟลเดอร์ `php_api` ไปไว้ใน `htdocs` ของ XAMPP แล้วปรับ URL ใน `src/config.js`)*

### 3. รัน Vue.js Front-end
```bash
npm install
npm run dev
```
เปิดเบราว์เซอร์ไปที่ `http://localhost:5175`
