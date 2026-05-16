# SAMS CMS - Project Structure

## 📁 Directory Organization

```
SAMS WEBSITE/
│
├── backend/                      # Laravel Backend Application
│   ├── app/                      # Backend Code (Laravel)
│   │   ├── Models/               # Database Models
│   │   ├── Http/Controllers/     # Controllers (CRUD logic)
│   │   └── ...
│   ├── database/                 # Database Layer & Migrations
│   ├── resources/views/          # Blade Templates (CMS Frontend)
│   │   ├── auth/                 # Authentication Views
│   │   ├── layouts/              # Layout Templates
│   │   ├── dashboard.blade.php   # Admin Dashboard
│   │   └── ...                   # Other CMS Views
│   ├── public/                   # Web Root (Publicly Accessible)
│   │   ├── index.php             # Laravel Entry Point
│   │   ├── storage/              # Symlinked Storage
│   │   └── ...                   # Public Assets
│   ├── routes/                   # Route Definitions
│   ├── config/                   # Configuration Files
│   ├── storage/                  # Runtime Storage
│   ├── bootstrap/                # Framework Bootstrap
│   ├── vendor/                   # Dependencies (Composer)
│   ├── artisan                   # Laravel CLI Tool
│   ├── composer.json             # PHP Dependencies
│   ├── package.json              # Node Dependencies
│   └── vite.config.js            # Build Configuration
│
├── frontend/                     # Static Frontend Files
│   ├── *.html                    # Static HTML Pages
│   ├── images/                   # Static Images
│   ├── style.css                 # Static Stylesheet
│   └── ...                       # Other Static Assets
│
├── docs/                         # Documentation
│   ├── ARCHITECTURE.md           # System Architecture
│   ├── FILE_ORGANIZATION_GUIDE.md # File Organization Guide
│   ├── PROJECT_STRUCTURE.md      # This File
│   ├── README.md                 # Project README
│   └── SETUP_CHECKLIST.md        # Setup Instructions
│
└── [Root Files]                  # General Project Files
    ├── .env                      # Environment Variables
    ├── .env.example              # Environment Template
    ├── .git/                     # Git Repository
    ├── .gitignore                # Git Ignore Rules
    └── README.md                 # Project Overview
```

```

## 🎯 Layer Organization

### Backend (app/)
- **Models** - Database schema representations
- **Controllers** - Business logic & request handling
- **Services** - Business layer logic
- **Middleware** - Request/response middleware

### Frontend (resources/views/)
- **auth/** - Login pages
- **layouts/** - Master templates
- **dashboard/** - Admin dashboard
- **pages/** - CMS Pages CRUD
- **posts/** - Blog/News CRUD
- **departments/** - Department CRUD
- **alumni/** - Alumni CRUD
- **media/** - Media management
- **settings/** - Site settings

### Static Assets (public/)
- **css/** - Global & component styles
- **js/** - Frontend JavaScript
- **images/** - Public images
- **fonts/** - Web fonts

### Storage (storage/)
- **uploads/** - User-uploaded files (posts, media)
- **logs/** - Application logs
- **cache/** - Cached data

## 🚀 Next Steps

1. **Frontend styles** - Link public/css/app.css in layouts/app.blade.php
2. **Images** - Move images to public/images/
3. **User uploads** - Configured to storage/uploads/
4. **.env setup** - Configure database & app settings
5. **Run migrations** - php artisan migrate
6. **Create admin user** - php artisan tinker

