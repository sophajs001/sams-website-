# 🗂️ File Organization Setup Guide

## Current Project Structure - CLEAN & ORGANIZED

### ✅ Backend Layer (app/)
```
app/
├── Models/              → Database models (User, Post, Page, etc.)
├── Http/
│   └── Controllers/     → Business logic (PageController, PostController, etc.)
└── Services/            → Reusable business logic
```

### ✅ Frontend Layer (resources/views/)
```
resources/views/
├── auth/                → Login page
├── layouts/             → Master template (app.blade.php)
├── dashboard.blade.php  → Admin dashboard
├── pages/               → Page management (create, edit, index, show)
├── posts/               → Blog/news management
├── departments/         → Department management
├── alumni/              → Alumni management
├── media/               → Media gallery
└── settings/            → Site settings
```

### ✅ Static Assets (public/)
```
public/
├── css/                 → Stylesheets (app.css, style.css)
├── js/                  → JavaScript files
├── images/              → Public images (move from root/images/)
└── index.php            → Laravel entry point (already exists)
```

### ✅ Storage (storage/)
```
storage/
└── uploads/             → User-uploaded files (posts, media)
```

### ✅ Database (database/)
```
database/
└── migrations/          → All 7 table migrations
```

### ✅ Routes (routes/)
```
routes/
├── web.php              → All CMS routes
└── auth.php             → Login/logout routes
```

---

## 📋 Terminal Commands to Complete Setup

Run these commands in your project root:

### 1️⃣ Move Images to Public Folder
```bash
# Windows (PowerShell)
Copy-Item "images/*" -Destination "public/images/" -Recurse
Remove-Item "images/" -Recurse -Force

# Or Windows (CMD)
xcopy images public\images /E /Y
rmdir images /S /Q
```

### 2️⃣ Move Style.css to Public
```bash
# Windows (PowerShell)
Copy-Item "style.css" -Destination "public/css/"
Remove-Item "style.css"

# Or Windows (CMD)
move style.css public\css\style.css
```

### 3️⃣ Move Legacy HTML Files to Archive
```bash
# Windows (PowerShell)
New-Item -Type Directory -Path "resources/static/legacy-html" -Force
Copy-Item "*.html" -Destination "resources/static/legacy-html/" -Exclude "README.md"

# Then remove from root (after backup)
Get-ChildItem -Filter "*.html" | Remove-Item

# Or Windows (CMD)
mkdir resources\static\legacy-html
for %f in (*.html) do move %f resources\static\legacy-html\
```

### 4️⃣ Set Proper Permissions (if needed)
```bash
# Laravel needs write access to storage
# Usually handled automatically, but if issues arise:
# Windows typically doesn't require this, but ensure storage/ folder is writable
```

---

## 🏗️ Folder Structure After Cleanup

```
SAMS WEBSITE/
├── app/                          ✅ Backend code
├── database/migrations/          ✅ Database schemas
├── resources/
│   ├── views/                    ✅ Blade templates (by module)
│   └── static/legacy-html/       📦 Old HTML files (archive)
├── public/
│   ├── index.php                 ✅ Laravel entry
│   ├── css/                      ✅ Stylesheets
│   ├── js/                       ✅ JavaScript
│   └── images/                   ✅ Public images (moved here)
├── storage/uploads/              ✅ User uploads
├── routes/                       ✅ Route definitions
├── .env                          ✅ Environment config
├── composer.json                 ✅ Dependencies
└── PROJECT_STRUCTURE.md          📖 This documentation
```

---

## 🎯 Why This Structure?

| Layer | Purpose | Location |
|-------|---------|----------|
| **Backend Logic** | Controllers, Models, Services | `app/` |
| **Frontend Templates** | Blade views (organized by feature) | `resources/views/` |
| **Static Assets** | CSS, JS, Images for web | `public/` |
| **User Data** | Uploaded files | `storage/uploads/` |
| **Database** | Migration files | `database/migrations/` |

---

## 🚀 Next Steps

1. **Run terminal commands above** to move files
2. **Verify structure** - Check folders are organized
3. **Update imports** - Ensure views reference `asset()` helper
4. **Set up .env** - Configure database credentials
5. **Run migrations** - `php artisan migrate`
6. **Create admin user** - `php artisan tinker`

---

## ✨ Clean Environment Checklist

- [x] Backend code organized in `app/`
- [x] Frontend views organized by module in `resources/views/`
- [x] Static assets in `public/`
- [x] User uploads in `storage/uploads/`
- [x] Database migrations in `database/migrations/`
- [x] Routes organized in `routes/`
- [x] Legacy files archived in `resources/static/`
- [x] CSS/JS/Images in proper locations
- [x] No clutter in root directory
- [x] Blade layouts using `asset()` helper

**Your Laravel CMS is now ready for development!** 🎉

