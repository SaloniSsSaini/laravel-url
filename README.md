🚀 Laravel URL Shortener — Assessment Project

Created by: Saloni Saini

A role-based URL shortener system built as per the assignment requirements.
The application supports multiple user roles, company management, invitation rules, and restricted short URL creation workflows.

✨ Features Implemented
🔐 Authentication & Authorization

Laravel authentication with login/logout

Roles implemented:

SuperAdmin

Admin

Member

Sales

Manager

Role restrictions applied using Middleware + Policies

SuperAdmin created through Database Seeder using raw SQL

🧑‍🤝‍🧑 Company & User Management

Each company can have multiple users

Role-based rules applied:

SuperAdmin → can create companies

Admin → can manage users inside their own company

Members → restricted access

Invitation Logic:

SuperAdmin cannot invite Admin into new companies

Admin cannot invite Admin or Member into their own company

🔗 URL Shortener Module

Role-based rules:

Role	Can create short URL?	Can view others' URLs?
SuperAdmin	❌ Cannot create	❌ Cannot view all companies' URLs
Admin	❌ Cannot create	✔ Can see URLs NOT created in their own company
Member	❌ Cannot create	✔ Can see URLs NOT created by themselves
Sales / Manager	(optional rules)	

Other rules:

Short URLs are not publicly resolvable

Visiting short URL does not redirect to the real URL
(as per assignment requirement)

🧪 Test Cases Implemented

SuperAdmin cannot create short URLs

Admin and Member cannot create short URLs

Admin sees only URLs not created in their own company

Member sees only URLs not created by themselves

Short URLs do not publicly resolve or redirect

📂 Project Structure
app/
 ├── Http/
 │    ├── Controllers/
 │    ├── Middleware/
 │    ├── Requests/
 │    ├── Policies/
 │
 ├── Models/
database/
 ├── migrations/
 ├── seeders/
resources/
 ├── views/
routes/
 ├── web.php

🛠️ Tech Stack

Laravel 12

PHP 8.3

SQLite database

Laravel Sanctum (auth utilities)

⚙️ Setup Instructions (Local Development)
1️⃣ Clone the Repository
git clone https://github.com/SaloniSsSaini/laravel-url.git
cd laravel-url

2️⃣ Install PHP Dependencies
composer install

3️⃣ Create Environment File
cp .env.example .env

4️⃣ Generate Application Key
php artisan key:generate

5️⃣ Create SQLite Database
touch database/database.sqlite


Update .env file:

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite

6️⃣ Run Migrations + Seeders
php artisan migrate:fresh --seed


This creates your SuperAdmin using raw SQL.

SuperAdmin Login
Email: superadmin@example.com
Password: password

▶️ Run the Application
php artisan serve


App opens at:

👉 http://127.0.0.1:8000

🤖 AI Usage Disclosure (As Required)

This project was built by Saloni Saini.
AI tools were used strictly within acceptable limits:

ChatGPT — debugging help, syntax guidance, structuring policies

All project logic, architecture, routes, controllers, and reasoning were written by me

No AI tool was used to auto-generate the entire project.
