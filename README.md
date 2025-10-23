# Multi-Tenant SaaS Platform

A comprehensive Laravel-based multi-tenant SaaS platform with role-based access control, team management, and product inventory management.

## 🚀 Features

### Admin Capabilities
- **Team Management**: Create, edit, and delete teams
- **User Management**: Manage all users, assign roles, and team assignments
- **Role Assignment**: Promote users to Team Admin or demote to Team User
- **System Overview**: View statistics across all teams, users, products, and categories

### Team Admin Capabilities
- **Team User Management**: Manage users within their team, change roles
- **Product Management**: Full CRUD operations for all team products
- **Category Viewing**: Browse all product categories
- **Team Overview**: Statistics for team users and products

### Team User Capabilities
- **Browse Team Products**: View all products in the team with advanced search and filters
- **My Products Management**: Create, edit, and delete own products
- **Search & Filter**: Search by name, description, SKU; filter by category and creator
- **Category Viewing**: Browse all available categories

## 🎨 Design Highlights

- **Role-Specific Themes**: Each role has a distinct color scheme
  - Admin: Dark blue/slate corporate theme
  - Team Admin: Fresh emerald/teal vibrant theme
  - Team User: Purple/pink/fuchsia creative gradient theme
- **Responsive Design**: Mobile-friendly interface using Tailwind CSS
- **Modern UI**: Card-based layouts, hover effects, smooth transitions
- **Intuitive Navigation**: Role-based navigation with quick action buttons

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js >= 16.x
- NPM or Yarn
- SQLite (default) or MySQL/PostgreSQL

## 🛠️ Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd multi-tenant-app
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup

The project uses SQLite by default. Make sure your `.env` file has:
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Create the SQLite database file:
```bash
# Windows (PowerShell)
New-Item database/database.sqlite -ItemType File

# Linux/Mac
touch database/database.sqlite
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Seed Test Data
```bash
php artisan db:seed --class=TestSeeder
```

This will create:
- 1 Team (Acme Corporation)
- 3 Users (Admin, Team Admin, Team User)
- 2 Categories (Electronics, Furniture)
- 3 Products

### 7. Build Frontend Assets
```bash
npm run build
```

### 8. Start Development Server
```bash
php artisan serve
```

The application will be available at: `http://127.0.0.1:8000`

## 👥 Test User Accounts

After seeding, you can login with these accounts:

| Role | Email | Password | Capabilities |
|------|-------|----------|-------------|
| **Admin** | admin@example.com | password | Full system access |
| **Team Admin** | team-admin@example.com | password | Manage team users & products |
| **Team User** | team-user@example.com | password | Manage own products |

## 📁 Project Structure

```
multi-tenant-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php          # Admin features
│   │   │   ├── TeamAdminController.php      # Team Admin features
│   │   │   ├── TeamUserController.php       # Team User features
│   │   │   ├── AuthController.php           # Authentication
│   │   │   └── DashboardController.php      # Role-based routing
│   │   └── Middleware/
│   │       └── RoleMiddleware.php           # Role-based access control
│   └── Models/
│       ├── User.php                         # User model with role
│       ├── Team.php                         # Team model
│       ├── Product.php                      # Product model
│       └── Category.php                     # Category model
├── database/
│   ├── migrations/                          # Database schema
│   └── seeders/
│       └── TestSeeder.php                   # Test data
├── resources/
│   ├── views/
│   │   ├── admin/                          # Admin views
│   │   ├── team-admin/                     # Team Admin views
│   │   ├── team-user/                      # Team User views
│   │   ├── auth/                           # Login/Register views
│   │   └── layouts/                        # Layout templates
│   ├── css/
│   │   └── app.css                         # Tailwind CSS
│   └── js/
│       └── app.js                          # Frontend JavaScript
└── routes/
    └── web.php                             # Application routes
```

## 🔐 Role-Based Access Control

### Admin
- Can access `/admin/*` routes
- Full CRUD on teams and users
- Can assign any role to any user
- System-wide overview

### Team Admin
- Can access `/team-admin/*` routes
- Manage users within their team only
- Full CRUD on team products
- Can promote team users to team admin within their team

### Team User
- Can access `/team-user/*` routes
- View all team products with search/filter
- Create, edit, delete only their own products
- Browse categories

## 💾 Database Schema

### Users Table
- `id`, `name`, `email`, `password`
- `role`: admin, team_admin, team_user
- `team_id`: Foreign key to teams table

### Teams Table
- `id`, `name`, `slug`, `description`

### Products Table
- `id`, `name`, `slug`, `description`
- `price`, `sku`, `stock`
- `team_id`: Foreign key to teams
- `category_id`: Foreign key to categories
- `user_id`: Foreign key to users (creator)

### Categories Table
- `id`, `name`, `slug`, `description`

## 🧪 Testing the Application

1. **Login as Admin**:
   - Email: `admin@example.com`
   - Test creating teams, managing users, assigning roles

2. **Login as Team Admin**:
   - Email: `team-admin@example.com`
   - Test managing team users, creating/editing team products

3. **Login as Team User**:
   - Email: `team-user@example.com`
   - Test browsing products with filters, creating own products

## 🛡️ Security Features

- **Role-based middleware**: Prevents unauthorized access
- **Team-scoped access**: Users can only access their team's data
- **Ownership validation**: Team users can only modify their own products
- **CSRF protection**: All forms include CSRF tokens
- **Password hashing**: Secure password storage
- **SQL injection prevention**: Using Eloquent ORM

## 🎯 Key Functionalities

### Search & Filter (Team User)
- Search products by name, description, or SKU
- Filter by category
- Filter by product creator
- Real-time results

### Product Management
- Automatic slug generation
- SKU uniqueness validation
- Stock tracking
- Category assignment
- Price management

### User Management
- Role promotion/demotion
- Team assignment
- User statistics
- Prevent self-deletion

### Team Management
- Automatic slug generation
- Team statistics (users, products)
- Prevent deletion of teams with users

## 🎨 Technology Stack

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, Tailwind CSS
- **Build Tool**: Vite
- **Database**: SQLite (default) / MySQL / PostgreSQL
- **Authentication**: Laravel built-in auth
- **Asset Compilation**: PostCSS, Autoprefixer

## 📝 Development Notes

### Adding New Features
1. Create routes in `routes/web.php`
2. Add controller methods
3. Create Blade views in appropriate role directory
4. Run `npm run build` to compile assets
5. Test with appropriate role user

### Modifying Styles
1. Edit `resources/css/app.css` or Blade templates
2. Run `npm run build` or `npm run dev`
3. Clear browser cache with Ctrl+Shift+R

### Database Changes
1. Create migration: `php artisan make:migration <name>`
2. Run migration: `php artisan migrate`
3. For fresh start: `php artisan migrate:fresh --seed`

## 🐛 Troubleshooting

### Styles not loading
```bash
npm run build
php artisan view:clear
php artisan config:clear
# Hard refresh browser (Ctrl+Shift+R)
```

### Database errors
```bash
# Ensure database file exists (SQLite)
touch database/database.sqlite

# Or recreate database
php artisan migrate:fresh --seed
```

### Permission errors
```bash
# Windows: Run as Administrator
# Linux/Mac: Set permissions
chmod -R 775 storage bootstrap/cache
```

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

This is a demonstration project for a technical assessment. For production use, consider adding:
- Unit and feature tests
- API endpoints with authentication
- Email verification
- Password reset functionality
- Activity logging
- File uploads for products
- Advanced reporting
- Export functionality

## 📧 Support

For questions or issues, please create an issue in the repository or contact the development team.

---

**Built with ❤️ using Laravel & Tailwind CSS**
