# 🎨 SAMS CMS - Architecture Diagram

## Clean Layered Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                    PUBLIC WEB LAYER                         │
│              (Accessible via Browser/HTTP)                  │
│                                                              │
│  public/index.php → public/css/ → public/js/ → public/images/
└────────────────────────────┬────────────────────────────────┘
                             │
                             ↓
┌─────────────────────────────────────────────────────────────┐
│                  PRESENTATION LAYER                         │
│         (Blade Templates - resources/views/)                │
│                                                              │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐         │
│  │   Auth      │  │   Pages     │  │   Posts     │         │
│  │ (login)     │  │ (CRUD)      │  │ (CRUD)      │         │
│  └─────────────┘  └─────────────┘  └─────────────┘         │
│                                                              │
│  ┌─────────────┐  ┌─────────────┐  ┌─────────────┐         │
│  │ Departments │  │   Alumni    │  │   Media     │         │
│  │ (CRUD)      │  │ (CRUD)      │  │ (CRUD)      │         │
│  └─────────────┘  └─────────────┘  └─────────────┘         │
│                                                              │
│             ┌─────────────────────────┐                     │
│             │    Site Settings        │                     │
│             │       (CRUD)            │                     │
│             └─────────────────────────┘                     │
└────────────────────────────┬────────────────────────────────┘
                             │
                             ↓
┌─────────────────────────────────────────────────────────────┐
│              APPLICATION LOGIC LAYER                        │
│        (Controllers - app/Http/Controllers/)                │
│                                                              │
│  PageController    PostController    DepartmentController   │
│  MediaController   AlumniController  SettingsController     │
│  AuthenticationSessionController                            │
└────────────────────────────┬────────────────────────────────┘
                             │
                             ↓
┌─────────────────────────────────────────────────────────────┐
│                   BUSINESS LOGIC LAYER                      │
│           (Models - app/Models/)                            │
│                                                              │
│  User    Page    Post    Department    Media    Alumni     │
│                         Setting                             │
└────────────────────────────┬────────────────────────────────┘
                             │
                             ↓
┌─────────────────────────────────────────────────────────────┐
│              DATABASE PERSISTENCE LAYER                     │
│         (Migrations - database/migrations/)                 │
│                                                              │
│  users   pages   posts   departments   media   alumni       │
│                          settings                           │
│                                                              │
│              (MySQL/MariaDB Database)                       │
└─────────────────────────────────────────────────────────────┘
```

---

## Request Flow Diagram

```
┌──────────────┐
│  User/Admin  │
│   Browser    │
└──────┬───────┘
       │ HTTP Request
       ↓
┌─────────────────────────────────────────────────┐
│          public/index.php (Entry Point)         │
│     (Routes requests through Laravel)            │
└──────┬───────────────────────────────────────────┘
       │
       ↓
┌─────────────────────────────────────────────────┐
│  routes/web.php or routes/auth.php (Router)    │
│     (Match URL to Controller@Action)            │
└──────┬───────────────────────────────────────────┘
       │
       ↓
┌─────────────────────────────────────────────────┐
│    Middleware (Auth Check, CSRF, etc.)         │
│    (Protect routes, validate requests)          │
└──────┬───────────────────────────────────────────┘
       │
       ↓
┌─────────────────────────────────────────────────┐
│  Controllers (app/Http/Controllers/)            │
│  (Process request, call models, return view)    │
└──────┬───────────────────────────────────────────┘
       │
       ↓
┌──────────────────┬──────────────────────────────┐
│                  │                              │
↓                  ↓                              ↓
┌──────────────────────────┐  ┌────────────────────────┐
│   Models (Query DB)      │  │  Views (Render HTML)   │
│   app/Models/            │  │  resources/views/      │
│                          │  │                        │
│ • Read/Write Data        │  │ • Use @blade syntax    │
│ • Validate              │  │ • Display data         │
│ • Relationships         │  │ • User interaction     │
└────────────┬─────────────┘  └──────────┬─────────────┘
             │                          │
             ↓                          ↓
┌──────────────────────────┐  ┌────────────────────────┐
│   Database               │  │   HTML Response        │
│   (MySQL Tables)         │  │   (Send to Browser)    │
│                          │  │                        │
│ • users                  │  │ • Includes CSS/JS      │
│ • pages                  │  │ • Renders in Browser   │
│ • posts                  │  │ • User sees page       │
│ • departments            │  │                        │
│ • media                  │  │ ←──────────────────────┤
│ • alumni                 │  └────────────────────────┘
│ • settings               │
└──────────────────────────┘
```

---

## File Organization - Before vs After

### ❌ BEFORE (Messy)
```
SAMS WEBSITE/
├── *.html              ← Loose HTML files (confusing)
├── style.css           ← CSS at root (hard to maintain)
├── images/             ← Images at root (no organization)
├── app/                ← Laravel backend (mixed)
├── database/           ← Migrations
├── resources/views/    ← Views (no structure)
└── routes/
```

### ✅ AFTER (Clean)
```
SAMS WEBSITE/
├── app/                          # 🔧 Backend code (separated)
│   ├── Models/
│   └── Http/Controllers/
├── database/
│   └── migrations/               # 🗄️ Database schemas
├── resources/
│   ├── views/                    # 📄 Frontend (organized by feature)
│   │   ├── auth/
│   │   ├── pages/
│   │   ├── posts/
│   │   ├── departments/
│   │   ├── alumni/
│   │   ├── media/
│   │   └── settings/
│   └── static/legacy-html/       # 📦 Archive (organized)
├── public/                       # 🌐 Web root (accessible)
│   ├── index.php
│   ├── css/                      # All styles
│   ├── js/                       # All scripts
│   └── images/                   # All images
├── storage/uploads/              # 💾 User files
└── routes/
    ├── web.php
    └── auth.php
```

---

## Module Organization (resources/views/)

```
resources/views/
│
├── layouts/
│   ├── app.blade.php       ← Master template (all pages extend this)
│   └── footer.blade.php    ← Footer component
│
├── auth/
│   └── login.blade.php     ← Admin login page
│
├── dashboard.blade.php     ← Admin dashboard (links to modules)
│
├── pages/                  ← Page Management Module
│   ├── index.blade.php     ← List all pages
│   ├── create.blade.php    ← Create new page
│   ├── edit.blade.php      ← Edit page
│   ├── landing.blade.php   ← Public landing page
│   └── about.blade.php     ← Public about page
│
├── posts/                  ← Blog/News Module
│   ├── index.blade.php     ← List all posts
│   ├── create.blade.php    ← Create new post
│   ├── edit.blade.php      ← Edit post
│   └── show.blade.php      ← Display single post
│
├── departments/            ← Department Module
│   ├── index.blade.php     ← List all departments
│   ├── create.blade.php    ← Create department
│   └── edit.blade.php      ← Edit department
│
├── alumni/                 ← Alumni Module
│   ├── index.blade.php     ← List all alumni
│   ├── create.blade.php    ← Add alumni
│   └── edit.blade.php      ← Edit alumni
│
├── media/                  ← Media Module
│   └── index.blade.php     ← Media gallery
│
└── settings/               ← Settings Module
    ├── index.blade.php     ← View settings
    ├── create.blade.php    ← Create settings
    └── edit.blade.php      ← Edit settings
```

---

## URL Route Mapping

```
Public Routes:
GET /                       → PageController@showLanding      (Landing page)
GET /login                  → AuthenticatedSessionController@create

Protected Routes (Admin Only):
GET /dashboard              → View dashboard
GET /pages                  → PageController@index            (List)
POST /pages                 → PageController@store            (Create)
GET /pages/create           → PageController@create           (Form)
GET /pages/{id}/edit        → PageController@edit             (Edit Form)
PUT /pages/{id}             → PageController@update           (Save)
DELETE /pages/{id}          → PageController@destroy          (Delete)

POST /logout                → AuthenticatedSessionController@destroy

(Same pattern for posts, departments, alumni, media, settings)
```

---

## Data Flow Example (Creating a Post)

```
┌─────────────────────────────────────────────────────────────┐
│ 1. Admin fills form & clicks "Create Post"                  │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ↓
┌─────────────────────────────────────────────────────────────┐
│ 2. Form submits POST /posts                                 │
│    (with CSRF token, title, body, category, user_id)       │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ↓
┌─────────────────────────────────────────────────────────────┐
│ 3. routes/web.php matches route → PostController@store      │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ↓
┌─────────────────────────────────────────────────────────────┐
│ 4. PostController@store (app/Http/Controllers/)             │
│    • Validates input                                         │
│    • Calls Post::create()                                   │
│    • Redirects to index                                     │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ↓
┌─────────────────────────────────────────────────────────────┐
│ 5. Post Model (app/Models/Post.php)                         │
│    • Creates new record                                     │
│    • Inserts into database                                  │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ↓
┌─────────────────────────────────────────────────────────────┐
│ 6. Database (posts table)                                   │
│    • Stores: id, title, body, category, user_id            │
│    • Returns created record                                 │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ↓
┌─────────────────────────────────────────────────────────────┐
│ 7. PostController redirects to /posts                       │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ↓
┌─────────────────────────────────────────────────────────────┐
│ 8. routes/web.php matches → PostController@index            │
│    Gets all posts from database                             │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ↓
┌─────────────────────────────────────────────────────────────┐
│ 9. PostController@index renders view                        │
│    Passes $posts to resources/views/posts/index.blade.php   │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ↓
┌─────────────────────────────────────────────────────────────┐
│ 10. Blade Template                                          │
│     • Loops through posts                                   │
│     • Renders HTML                                          │
│     • Includes CSS/JS from public/                          │
└────────────────────┬────────────────────────────────────────┘
                     │
                     ↓
┌─────────────────────────────────────────────────────────────┐
│ 11. HTML Response sent to Browser                           │
│     Admin sees new post in the list!                        │
└─────────────────────────────────────────────────────────────┘
```

---

## Environment Variables (Separation of Concerns)

```
.env (Gitignored - Never committed)
│
├── APP Settings
│   ├── APP_NAME="SAMS CMS"
│   ├── APP_ENV=production
│   ├── APP_DEBUG=false
│   └── APP_URL=https://sams.edu
│
├── Database Settings
│   ├── DB_CONNECTION=mysql
│   ├── DB_HOST=db.example.com
│   ├── DB_DATABASE=sams_cms
│   ├── DB_USERNAME=user
│   └── DB_PASSWORD=secure_password
│
├── Mail Settings
│   ├── MAIL_MAILER=smtp
│   ├── MAIL_HOST=smtp.mailtrap.io
│   ├── MAIL_USERNAME=***
│   └── MAIL_PASSWORD=***
│
└── Custom Settings
    ├── ADMIN_EMAIL=admin@sams.edu
    ├── SITE_NAME="Seminary of the Assumption"
    └── SITE_DESCRIPTION="Catholic Seminary"
```

---

## Summary

✅ **Clean Layer Separation**
- Backend (app/) isolated from frontend
- Database logic separated via Migrations
- Views organized by feature modules

✅ **Easy Maintenance**
- Each module (pages, posts, etc.) in its own folder
- Easy to find and modify features
- Consistent naming and structure

✅ **Security**
- `public/` is only accessible folder
- `.env` contains secrets (never committed)
- Static files organized and easily served

✅ **Scalability**
- New modules can be added following same pattern
- New controllers/models/views easy to create
- Database migrations version-controlled

✅ **Professional Structure**
- Follows Laravel conventions
- Compatible with standard hosting
- Easy for new developers to understand

