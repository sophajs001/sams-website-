# 📋 SAMS CMS - Setup & Deployment Checklist

## Phase 1: Project Structure ✅ COMPLETE

- [x] Backend organized in `app/` (Models, Controllers, Services)
- [x] Frontend views organized in `resources/views/` (by module)
- [x] Static assets configured in `public/`
- [x] Database migrations created in `database/migrations/`
- [x] Routes defined in `routes/` (web.php, auth.php)
- [x] Layouts created with proper asset linking
- [x] All CRUD views created (pages, posts, departments, alumni, media, settings)

---

## Phase 2: File Organization Tasks

### 🔄 Required Terminal Commands (Run Once)

Run these in order:

```bash
# 1. Move images to public folder
Copy-Item "images/*" -Destination "public/images/" -Recurse -Force

# 2. Move CSS to public
Copy-Item "style.css" -Destination "public/css/style.css"

# 3. Archive legacy HTML files
New-Item -Type Directory -Path "resources/static/legacy-html" -Force
Copy-Item "*.html" -Destination "resources/static/legacy-html/" -Exclude "README.md"

# 4. Clean root (after backup - ONLY run after above are done)
Get-ChildItem -Filter "*.html" | Remove-Item -Force
Remove-Item "style.css" -Force
Remove-Item "images/" -Recurse -Force
```

### ✅ Verification Checklist

After running commands above, verify:

- [ ] `public/images/` contains all image files
- [ ] `public/css/app.css` and `public/css/style.css` exist
- [ ] `resources/static/legacy-html/` contains all old HTML files
- [ ] Root directory has NO `.html` files
- [ ] Root directory has NO `style.css`
- [ ] Root directory has NO `images/` folder

---

## Phase 3: Laravel Setup

### Environment Configuration

- [ ] Copy `.env.example` to `.env` (if not done)
- [ ] Generate app key: `php artisan key:generate`
- [ ] Configure database in `.env`:
  ```
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=sams_cms
  DB_USERNAME=root
  DB_PASSWORD=
  ```

### Database Setup

- [ ] Create database: `CREATE DATABASE sams_cms;`
- [ ] Run migrations: `php artisan migrate`
- [ ] Verify all 7 tables created:
  - [x] users
  - [x] pages
  - [x] departments
  - [x] posts
  - [x] media
  - [x] alumni
  - [x] settings

### Admin Account

- [ ] Create admin user via Tinker:
  ```bash
  php artisan tinker
  > User::create(['name' => 'Admin', 'email' => 'admin@sams.com', 'password' => Hash::make('password')])
  ```
- [ ] Or run seeder (create if needed)

---

## Phase 4: Testing

### Access Points

- [ ] `http://localhost/` → Landing page (public)
- [ ] `http://localhost/login` → Login form
- [ ] Login with admin credentials
- [ ] `http://localhost/dashboard` → Admin dashboard

### Module Testing

- [ ] **Pages** - Create, read, update, delete pages
- [ ] **Posts** - Manage blog posts
- [ ] **Departments** - Manage departments
- [ ] **Alumni** - Manage alumni records
- [ ] **Media** - Upload and manage media
- [ ] **Settings** - Configure site settings

### File Upload Testing

- [ ] Upload image to post
- [ ] Verify file in `storage/uploads/`
- [ ] File accessible via public link

---

## Phase 5: Security

- [ ] Change APP_KEY in `.env`
- [ ] Set proper file permissions on `storage/` and `bootstrap/cache/`
- [ ] Remove `DEBUG=true` from production `.env`
- [ ] Enable HTTPS (production)
- [ ] Secure `.env` file (not publicly accessible)
- [ ] Run `php artisan config:cache`

---

## Phase 6: Deployment

### Development Environment

```bash
# Start Laravel dev server
php artisan serve
# Access at http://localhost:8000
```

### Production Environment

- [ ] Configure web server (Apache/Nginx)
- [ ] Point DocumentRoot to `public/` folder
- [ ] Set proper ownership (web server user)
- [ ] Enable mod_rewrite (Apache) or equivalent
- [ ] Configure SSL/TLS certificates
- [ ] Set up error logging
- [ ] Configure backup strategy

### Sample Apache Configuration

```apache
<VirtualHost *:80>
    ServerName sams.local
    DocumentRoot /path/to/SAMS WEBSITE/public

    <Directory /path/to/SAMS WEBSITE/public>
        AllowOverride All
        Require all granted
        
        <IfModule mod_rewrite.c>
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteRule ^ index.php [QSA,L]
        </IfModule>
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/sams-error.log
    CustomLog ${APACHE_LOG_DIR}/sams-access.log combined
</VirtualHost>
```

---

## 📊 Final Project Structure

```
SAMS WEBSITE/
├── app/                        ✅ Backend
│   ├── Models/
│   └── Http/Controllers/
├── database/
│   └── migrations/             ✅ 7 tables
├── resources/
│   ├── views/                  ✅ All views organized
│   └── static/legacy-html/     📦 Archive
├── public/                     ✅ Web root
│   ├── index.php
│   ├── css/
│   ├── js/
│   └── images/
├── storage/
│   └── uploads/                ✅ User files
├── routes/                     ✅ web.php, auth.php
├── .env                        ✅ Configuration
├── composer.json
└── PROJECT_STRUCTURE.md
```

---

## 🎯 Success Criteria

- ✅ All backend code in `app/`
- ✅ All views in `resources/views/` (organized by module)
- ✅ All static assets in `public/`
- ✅ Database migrations runnable
- ✅ Admin login working
- ✅ CRUD operations working for all modules
- ✅ File uploads to `storage/uploads/`
- ✅ Public can access landing page
- ✅ Authenticated users can access dashboard
- ✅ No clutter in root directory

---

## 🚀 Quick Start

```bash
# 1. Install Composer dependencies (if needed)
composer install

# 2. Set up environment
cp .env.example .env
php artisan key:generate

# 3. Configure database in .env

# 4. Run migrations
php artisan migrate

# 5. Create admin user
php artisan tinker
> User::create(['name' => 'Admin', 'email' => 'admin@sams.com', 'password' => Hash::make('password')])
> exit

# 6. Start development server
php artisan serve

# 7. Visit http://localhost:8000
```

---

## 📞 Troubleshooting

| Issue | Solution |
|-------|----------|
| 404 errors | Ensure `public/` is DocumentRoot |
| Database errors | Check `.env` database config |
| File permissions | Run `chmod -R 775 storage bootstrap/cache` |
| Missing assets | Check `asset()` helper in views |
| CSRF token errors | Clear cache: `php artisan cache:clear` |
| Migrations failed | Check database connection & syntax |

