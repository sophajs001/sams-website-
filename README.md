# SAMS CMS - Clean Environment

## 🏗️ Project Structure

This project is organized into clean, separated environments:

### Backend (Laravel CMS)
- **Location**: `backend/` folder
- **Purpose**: Full Laravel application with admin CMS
- **Access**: `cd backend && php artisan serve` then visit `http://127.0.0.1:8000/login`
- **Login**: `admin@example.com` / `password`

### Frontend (Static Files)
- **Location**: `frontend/` folder
- **Purpose**: Static HTML/CSS/JS files (legacy or separate frontend)
- **Access**: Open `frontend/index.html` directly in browser

### Documentation
- **Location**: `docs/` folder
- **Purpose**: All project documentation and guides

### General Resources
- **Location**: Root directory
- **Contains**: `.env`, `.gitignore`, `README.md`, etc.

## 🚀 Quick Start

### Backend (CMS)
```bash
cd backend
php artisan serve
# Access admin panel at: http://127.0.0.1:8000/login
# Email: admin@example.com
# Password: password
```

### Frontend (Static)
```bash
# Open static files directly
start frontend/index.html
```

## 📁 Directory Guide

- `backend/` - Laravel application (app/, routes/, config/, etc.)
- `frontend/` - Static HTML/CSS/JS files
- `docs/` - Documentation and guides
- Root files - General project configuration

## 🔧 Development

- **Backend changes**: Work in `backend/` directory
- **Frontend changes**: Work in `frontend/` directory
- **Documentation**: Update files in `docs/` directory

- **Backend changes**: Modify Laravel files in root directory
- **Frontend changes**: Modify files in `frontend/` directory
- **Documentation**: Update files in `docs/` directory