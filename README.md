# Tasks API

A simple RESTful API for managing tasks, built with PHP and MySQL.

## Description

This project provides endpoints to create, read, update, and delete tasks. It is designed to run locally using XAMPP.

## Setup Instructions

1. **Install XAMPP**

   - Download and install XAMPP from [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).
   - Start Apache and MySQL from the XAMPP control panel.

2. **Clone or Copy the Project**

   - Place the `tasks-api` folder in `/Applications/XAMPP/xamppfiles/htdocs/` (macOS) or the `htdocs` directory on your system.

3. **Import the Database**

   - Open phpMyAdmin (`http://localhost/phpmyadmin`).
   - Create a database (e.g., `tasks_db`).
   - Import the provided SQL file in db folder named (schema ans seed.sql) to set up the `tasks` table.

4. **Configure Database Connection**
   - Open `db.php` in the project folder.
   - Set your database credentials (DB name, user, password, host) as needed.

## Base URL

```
http://localhost/tasks-api/
```

## API Endpoints

### Get All Tasks

**GET** `/tasks`

```http
GET http://localhost/tasks-api/tasks
```

### Get a Single Task

**GET** `/tasks/{id}`

```http
GET http://localhost/tasks-api/tasks/1
```

### Create a Task

**POST** `/tasks`

```http
POST http://localhost/tasks-api/tasks
Content-Type: application/json

{
  "title": "Buy groceries",
  "description": "Milk, Bread, Eggs"
}
```

### Update a Task

**PUT** `/tasks/{id}`

```http
PUT http://localhost/tasks-api/tasks/1
Content-Type: application/json

{
  "title": "Go shopping",
  "description": "Milk, Bread, Eggs, Butter"
}
```

### Delete a Task

**DELETE** `/tasks/{id}`

```http
DELETE http://localhost/tasks-api/tasks/1
```

### Toggle Task Status

**PATCH** `/tasks/{id}/toggle`

```http
PATCH http://localhost/tasks-api/tasks/1/toggle
```

This endpoint flips the status of the specified task between `pending` and `completed`.

## Testing the API

- Use [Postman](https://www.postman.com/) or a similar tool to test the API endpoints.
- Set the appropriate HTTP method and headers (e.g., `Content-Type: application/json` for POST/PUT).

---

## 🐍 Python Integration — Accessing the PHP Tasks API

This project now includes a **Python client** (`api_with_python.py`) that connects to the PHP-based Tasks API to demonstrate how a Python script can perform all CRUD operations via HTTP requests.

### 🔧 Features

- `GET` → Fetch all tasks or a single task
- `POST` → Create a new task
- `PUT` → Update an existing task
- `DELETE` → Remove a task
- `PATCH` → Toggle task status (Pending ↔ Completed)

### 💻 How to Run the Python Client

1. Ensure your **XAMPP Apache server** is running.
2. Open your browser and confirm the API is active at:

```
http://localhost/tasks-api/
```

3. Open a terminal and navigate to the directory containing `api_with_python.py`.
4. Run the script using Python 3:

```bash
python3 api_with_python.py

 5. The script will execute predefined functions to demonstrate each API operation. You can uncomment specific function calls in the `if __name__ == "__main__":` block to test individual operations.

---
```
