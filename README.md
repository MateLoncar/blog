# 📝 Simple PHP Blog Project

## 📌 Project Overview
This is a simple **blog application** built using **PHP (without a framework)**, MySQL, Object-Oriented Programming (OOP), and PDO for database interaction.  
The project allows users to:
✅ Register an account  
✅ Log in and log out  
✅ Create, edit, and delete blog posts  
✅ View posts from all users on the homepage  

---

📌 2. Setting Up the Database

Start MySQL in your terminal or MySQL command line and run the following commands:


    CREATE DATABASE blog_db;
    USE blog_db;

    
✅ This creates the database and sets it as active.

📌 3. Creating Database Tables

🔹 3.1 Creating the users table

Run the following SQL query to create the users table:

    CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
✅ This table stores users and their hashed passwords.

🔹 3.2 Creating the posts table
Run the following SQL query to create the posts table:


    CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    );
✅ This table stores blog posts, linking them to users. If a user is deleted, their posts are automatically removed (ON DELETE CASCADE).

