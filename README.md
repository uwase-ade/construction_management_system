# Construction Management System (CMS)

**TVET Integrated Situation — Competence 33**  
A construction company in **Kigali** manages projects, workers, and materials. This web application is built with **PHP Laravel 9** to address tracking, materials usage, worker assignments, and project delays.

## Functional Requirements Implemented

| Requirement | Implementation |
|-------------|----------------|
| Authentication | Login with `username` and `password` (session-based) |
| CRUD operations | Projects, Workers, Materials, Assignments |
| Track project progress | Status, progress %, materials used per project |
| Generate project reports | Summary reports + printable per-project reports |

## Database Structure (`construction_db`)

| Table | Primary Key | Fields |
|-------|-------------|--------|
| users | user_id | username, password |
| projects | project_id | name, location, status, progress_percent, dates |
| workers | worker_id | name, role, phone |
| materials | material_id | name, quantity, unit |
| assignments | assign_id | project_id (FK), worker_id (FK) |
| project_material | id | project_id, material_id, quantity_used |

See `database/sql/construction_db.sql` for the full SQL schema.

## Requirements

- PHP 8.0+
- Composer
- MySQL (XAMPP recommended)
- Apache or `php artisan serve`

## Installation (XAMPP)

1. **Create the database** in phpMyAdmin or MySQL CLI:
   ```sql
   CREATE DATABASE construction_db;
   ```

2. **Configure `.env`** (already set for XAMPP defaults):
   ```
   DB_DATABASE=construction_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Install and migrate** from the project folder:
   ```bash
   composer install
   php artisan migrate --seed
   ```

4. **Run the application**:
   ```bash
   php artisan serve
   ```
   Open: http://127.0.0.1:8000

   Or point Apache document root to the `public` folder.

## Default Login

| Username | Password |
|----------|----------|
| admin | password123 |

## Project Structure

```
app/
  Http/Controllers/   # Auth, CRUD, Reports
  Models/             # User, Project, Worker, Material, Assignment
database/
  migrations/         # Laravel migrations
  seeders/            # Sample Kigali construction data
  sql/                # construction_db.sql
resources/views/      # Blade templates
public/css/           # Application styles
routes/web.php        # All web routes
```

## Modules

- **Dashboard** — Overview statistics and recent projects
- **Projects** — Full CRUD + progress tracking
- **Workers** — Manage construction staff and roles
- **Materials** — Inventory quantities and units
- **Assignments** — Link workers to projects
- **Reports** — Company-wide summary and printable project reports

## TVET Assessment Notes

This project demonstrates:

1. **Design Backend System** — MVC architecture, Eloquent ORM, RESTful routing
2. **PHP / Laravel** — Controllers, migrations, validation, Blade views
3. **Database** — Normalized schema, foreign keys, pivot table for materials usage
4. **Security** — Password hashing, CSRF protection, authentication middleware

## License

Educational project for TVET IAP program.
