# Project Management API

📌 **Images of Postman API requests are available in the `docs/images/` folder.**

## 📌 Overview
This is a **Laravel API** for managing projects and tasks. Users can **register, log in, create projects, add tasks, update task statuses, and generate reports.**

## ⚙️ Installation & Setup

### **1️⃣ Clone the Repository**
```bash
git clone https://github.com/Shibin-jay/project_management_laravel.git
cd project_management_laravel
```

### **2️⃣ Install Dependencies**
```bash
composer install
```

### **3️⃣ Set Up Environment**
Rename `.env.example` to `.env` and update database credentials:
```bash
cp .env.example .env
```
Update `.env` with MySQL credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_management_api
DB_USERNAME=root
DB_PASSWORD=
```

### **4️⃣ Run Migrations**
```bash
php artisan migrate
```

### **5️⃣ Install Laravel Passport**
```bash
composer require laravel/passport
php artisan migrate
php artisan passport:install 
```
Copy the generated **Personal Access Client ID & Secret** into `.env`:
```
PASSPORT_PERSONAL_ACCESS_CLIENT_ID=1
PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET=your_secret_here
```

### **6️⃣ Configure Passport in `AuthServiceProvider.php`**
Open `app/Providers/AuthServiceProvider.php` and update the `boot` method:
```php
use Laravel\Passport\Passport;

public function boot()
{
    $this->registerPolicies();
    Passport::routes();
}
```

### **7️⃣ Seed Database (Optional)**
```bash
php artisan db:seed
```

### **8️⃣ Start Server**
```bash
php artisan serve
```

---
## 🔑 Authentication
### **Register a User**
- **Endpoint:** `POST /api/register`
- **Request Body:**
```json
{
    "name": "jay",
    "email": "jay@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```
- **Response:**
```json
{
    "user": {
        "id": 2,
        "name": "jay",
        "email": "jay@example.com"
    },
    "token": "your_access_token_here"
}
```

### **Login User**
- **Endpoint:** `POST /api/login`
- **Request Body:**
```json
{
    "email": "jay@example.com",
    "password": "password"
}
```
- **Response:**
```json
{
    "user": {
        "id": 2,
        "name": "jay",
        "email": "jay@example.com"
    },
    "token": "your_access_token_here"
}
```

📌 **Use the `token` in Authorization headers for further requests.**
```bash
Authorization: Bearer your_access_token_here
```

### **Logout User**
- **Endpoint:** `POST /api/logout`
- **Headers:** `Authorization: Bearer your_access_token_here`
- **Response:** `{ "message": "Logged out successfully." }`

---
## 📌 API Endpoints

### **🛠️ Projects**
#### **Create a Project**
- **Endpoint:** `POST /api/projects`
- **Request Body:**
```json
{
    "title": "Project Management API",
    "description": "A project management system for Laravel."
}
```
- **Response:**
```json
{
    "id": 2,
    "title": "Project Management API",
    "description": "A project management system for Laravel.",
    "user_id": 1
}
```

#### **Get All Projects**
- **Endpoint:** `GET /api/projects`
- **Response:**
```json
[
    {
        "id": 1,
        "title": "Project Management API",
        "description": "A project management system for Laravel."
    }
]
```

### **📌 Tasks**
#### **Create a Task**
- **Endpoint:** `POST /api/projects/{project_id}/tasks`
- **Request Body:**
```json
{
    "title": "Setup Database",
    "status": "Pending"
}
```
- **Response:**
```json
{
    "id": 1,
    "project_id": 1,
    "title": "Setup Database",
    "status": "Pending"
}
```

#### **Get All Tasks in a Project**
- **Endpoint:** `GET /api/projects/{project_id}/tasks`
- **Response:**
```json
[
    {
        "id": 1,
        "project_id": 1,
        "title": "Setup Database",
        "status": "Pending"
    }
]
```

#### **Update Task Status with Remarks**
- **Endpoint:** `PUT /api/tasks/{task_id}/status`
- **Request Body:**
```json
{
    "status": "In Progress",
    "remark": "Started working on database setup."
}
```
- **Response:**
```json
{
    "message": "Task status updated successfully."
}
```

### **📌 Project Reports**
#### **Get Project Report**
- **Endpoint:** `GET /api/projects/{project_id}/report`
- **Response:**
```json
{
    "project": {
        "id": 1,
        "title": "Project Management API",
        "description": "A project management system for Laravel.",
        "tasks": [
            {
                "id": 1,
                "title": "Setup Database",
                "status": "In Progress",
                "remarks": [
                    {
                        "id": 1,
                        "text": "Started working on database setup."
                    }
                ]
            }
        ]
    }
}
```

---
## 🚀 Running Tests
Run API tests using:
```bash
php artisan test
```

To test with **Postman**, import the provided Postman collection.

---
## 📄 License
This project is licensed under the **MIT License**.

---
