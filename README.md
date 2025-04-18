# Employee Management API

This API allows you to manage employee records, including creating, retrieving, deleting, and importing employee data.

## Requirements

- PHP 8.2 or higher
- Composer
- MySQL

---

## Installation

Follow the steps below to set up and run the project on your local machine.

### 1. Create DB

Creat a new database as the config in .env

```code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=employee_import
DB_USERNAME=root
DB_PASSWORD=root
```

### 2. Config php.ini

```code
upload_max_filesize = 200M
post_max_size = 200M
memory_limit = -1 // already set in import service
max_execution_time = 0 // already set in import service
```

### 3. Run the project

```bash
cd employee-import
composer run dev
```
See more in: https://laravel.com/docs/12.x/installation#creating-an-application

### 4. Following steps in composer run dev

---

## How to use
 The App Url will be: http://localhost:8000
### 1. **POST /employee**

**Description**: Import employee data via a CSV file. This endpoint allows the user to upload a CSV file containing employee records.

#### Request URL:
```bash
curl -X POST -H 'Content-Type: text/csv' --data-binary @large_employee_data.csv http://localhost:8000/api/employee
```

### 2. **GET /employee**

**Description**: List of all employees.

#### Request URL:
```bash
http://localhost:8000/api/employee
```

### 3. **GET /employee/{id}**

**Description**: List infomation of an employee.

#### Request URL:
```bash
http://localhost:8000/api/employee/{id}
```

### 4. **DELETE /employee/{id}**

**Description**: Delete an employee.

#### Request URL:
```bash
http://localhost:8000/api/employee/{id}
```

---

## Source code structure
### 1. **Route**
```bash
routes/api.php
```
### 2. **Controller**
```bash
app/Http/Controllers/ImportController.php
app/Http/Controllers/EmployeeController.php
```
### 3. **Model**
```bash
app/Models/Employee.php
```
### 4. **Service**
```bash
app/Services/EmployeeImportService.php
```
### 5. **Handle Exception and Middleware**
```bash
bootstrap/app.php
```

---

## Another approach
We can use queue for handle the import process, and can have a mechanism to push notification (socket, pusher, firebase...) after the import is successful

