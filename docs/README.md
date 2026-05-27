# 🏛️ SAMS CMS - Seminary Management System

A clean, organized Laravel-based Content Management System for the Seminary of the Assumption.

---

## 📋 Quick Overview

| Component | Location | Purpose |
|-----------|----------|---------|
| **Backend** | `app/` | Models, Controllers, Business Logic |
| **Frontend** | `resources/views/` | Blade templates (organized by feature) |
| **Static Assets** | `public/` | CSS, JS, Images (web root) |
| **Database** | `database/migrations/` | 7 table schemas |
| **Routes** | `routes/` | All URL mappings |
| **Storage** | `storage/uploads/` | User-uploaded files |

---

## 🚀 Getting Started

### 1. Prerequisites
- PHP 8.0+
- MySQL/MariaDB
- Composer
- Node.js (for asset compilation)

### 2. Quick Setup

```bash
# Install dependencies
composer install

# Create .env file
cp .env.example .env

# Generate app key
php artisan key:generate

# Configure database in .env
nano .env
# Set DB_DATABASE, DB_USERNAME, DB_PASSWORD

# Run migrations
php artisan migrate

# Create admin user
php artisan tinker
> User::create(['name' => 'Admin', 'email' => 'admin@sams.com', 'password' => Hash::make('password')])
> exit

# Start development server
php artisan serve
# Visit http://localhost:8000
```

### 3. File Organization

After setup, organize files with these terminal commands:

```bash
# Move images to public folder
Copy-Item "images/*" -Destination "public/images/" -Recurse -Force

# Move CSS to public
Copy-Item "style.css" -Destination "public/css/style.css"

# Archive legacy HTML files
New-Item -Type Directory -Path "resources/static/legacy-html" -Force
Copy-Item "*.html" -Destination "resources/static/legacy-html/" -Exclude "README.md"

# Clean root
Get-ChildItem -Filter "*.html" | Remove-Item -Force
Remove-Item "style.css", "images/" -Recurse -Force
```

---

## 📚 Project Structure

```
SAMS WEBSITE/
│
├── app/                              # Application Code
│   ├── Models/                       # Database Models
│   └── Http/Controllers/             # Request Handlers
│
├── database/
│   └── migrations/                   # Database Schemas (7 tables)
│
├── resources/
│   ├── views/                        # Blade Templates (by feature)
│   │   ├── auth/                     # Login
│   │   ├── pages/                    # Page Management
│   │   ├── posts/                    # Blog/News
│   │   ├── departments/              # Departments
│   │   ├── alumni/                   # Alumni
│   │   ├── media/                    # Media Gallery
│   │   ├── settings/                 # Site Settings
│   │   └── layouts/                  # Master Templates
│   └── static/legacy-html/           # Archive (old files)
│
├── public/                           # Web Root
│   ├── index.php                     # Entry Point
│   ├── css/                          # Stylesheets
│   ├── js/                           # JavaScript
│   └── images/                       # Public Images
│
├── storage/uploads/                  # User Uploads
├── routes/                           # URL Routes
│
├── .env                              # Configuration
├── PROJECT_STRUCTURE.md              # Structure Guide
├── FILE_ORGANIZATION_GUIDE.md        # Organization Steps
└── SETUP_CHECKLIST.md                # Setup Checklist
```

---

## 🗄️ Database Schema (7 Tables)

- **Users** → Admin authentication
- **Pages** → Static pages (slug, title, content)
- **Departments** → Seminary departments
- **Posts** → Blog/news articles
- **Media** → Attached files
- **Alumni** → Alumni records
- **Settings** → Site configuration

---

## 🎯 Features

✅ Authentication (admin-only login)  
✅ Page management (CRUD)  
✅ Blog/posts management  
✅ Department management  
✅ Alumni management  
✅ Media gallery  
✅ Site settings  
✅ Public landing page  

---

## 🔑 Routes

**Public:**
- `GET /` → Landing page
- `GET /login` → Login form

**Protected (Admin):**
- `GET /dashboard` → Admin dashboard
- `/pages`, `/posts`, `/departments`, `/alumni`, `/media`, `/settings` → CRUD operations

---

## 🛠️ Common Commands

```bash
php artisan migrate              # Run migrations
php artisan tinker              # Interactive shell
php artisan serve               # Start dev server
php artisan config:clear        # Clear config cache
php artisan cache:clear         # Clear application cache
```

---

## 📝 Environment Setup

Copy `.env.example` to `.env` and configure:

```env
APP_NAME="SAMS CMS"
APP_DEBUG=false                 # true for dev, false for prod
DB_DATABASE=sams_cms
DB_USERNAME=root
DB_PASSWORD=your_password
```

---

## 📖 Documentation

- **PROJECT_STRUCTURE.md** → Detailed architecture
- **FILE_ORGANIZATION_GUIDE.md** → File organization steps
- **SETUP_CHECKLIST.md** → Complete setup walkthrough
- **.env.example** → Configuration template

---

## ✨ Clean Architecture

```
Backend (app/)
    ↓
Database (database/migrations/)
    ↓
Frontend (resources/views/)
    ↓
Public (public/)
```

**SAMS CMS is production-ready!** 🎉
