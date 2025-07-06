# 🚗 Vehicle Rental Management System

A modern web application built with Laravel for managing vehicle rentals. This system allows users to browse available vehicles, make reservations, and provides admin functionality for managing vehicles, users, and reservations.

## ✨ Features

### 🏠 Public Features
- **Vehicle Catalog**: Browse all available vehicles with detailed information
- **Vehicle Details**: View comprehensive vehicle information including images, specifications, and pricing
- **User Registration & Authentication**: Secure user registration and login system

### 👤 User Features
- **Profile Management**: Update personal information and view profile
- **Reservation System**: Create, edit, and manage vehicle reservations
- **Reservation History**: View past and current reservations
- **Real-time Status**: Track reservation approval status

### 🔧 Admin Features
- **Dashboard**: Overview of system statistics and recent activities
- **Vehicle Management**: Add, edit, and delete vehicles with image upload
- **Reservation Management**: Approve, reject, or cancel user reservations
- **User Management**: Manage user accounts and permissions
- **System Monitoring**: Track vehicle availability and reservation status

## 🛠️ Technology Stack

- **Backend**: Laravel 10.x (PHP 8.1+)
- **Frontend**: Blade Templates, Bootstrap, CSS3
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel UI with built-in authentication
- **File Storage**: Local file system for vehicle images
- **Development Tools**: XAMPP, Composer, Git

## 📋 Prerequisites

Before running this application, make sure you have the following installed:

- **PHP**: 8.1 or higher
- **Composer**: Latest version
- **MySQL**: 5.7 or higher (or PostgreSQL)
- **Web Server**: Apache/Nginx (or use Laravel's built-in server)
- **XAMPP**: For local development (recommended)

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/selzzaf/vehicle-rental-system.git
cd vehicle-rental-system
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database
Edit the `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vehicle_rental
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migrations and Seeders
```bash
php artisan migrate
php artisan db:seed
```

### 6. Create Storage Link
```bash
php artisan storage:link
```

### 7. Start the Application
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## 👥 Default Users

After running the seeders, you'll have these default accounts:

### Admin User
- **Email**: admin@example.com
- **Password**: password
- **Role**: Administrator

### Regular User
- **Email**: user@example.com
- **Password**: password
- **Role**: User

## 📁 Project Structure

```
location_vehicule/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   └── Middleware/          # Custom middleware
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   └── views/              # Blade templates
├── routes/
│   └── web.php             # Web routes
└── public/
    └── pictures/           # Vehicle images
```

## 🔐 Authentication & Authorization

The system uses Laravel's built-in authentication with custom middleware:

- **Admin Middleware**: Restricts access to admin-only routes
- **Authentication**: Required for reservation and profile features
- **Guest Access**: Public vehicle browsing

## 🗄️ Database Schema

### Users Table
- Basic user information and authentication details

### Vehicles Table
- Vehicle details (brand, model, price, license plate)
- Status tracking (available, reserved, maintenance)
- Image path for vehicle photos

### Reservations Table
- User-vehicle relationships
- Date ranges for rentals
- Status tracking (pending, approved, rejected, cancelled)
- Admin notes for reservation management

## 🎨 UI/UX Design

The application features a clean, modern interface with:
- **Color Scheme**: Black, white, and blue theme
- **Responsive Design**: Works on desktop, tablet, and mobile
- **User-Friendly Navigation**: Intuitive menu structure
- **Bootstrap Components**: Modern UI elements

## 🔧 Configuration

### Environment Variables
Key configuration options in `.env`:
- Database connection settings
- Mail configuration
- File storage settings
- Application URL

### Customization
- Vehicle categories and statuses can be modified in migrations
- Admin permissions can be adjusted in middleware
- UI colors and styling can be customized in CSS files

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

## 📝 API Documentation

The application provides RESTful endpoints for:
- Vehicle management (CRUD operations)
- Reservation management
- User management
- Authentication

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

**Selzzaf**
- GitHub: [@selzzaf](https://github.com/selzzaf)

## 🙏 Acknowledgments

- Laravel framework and community
- Bootstrap for UI components
- All contributors and testers

## 📞 Support

If you encounter any issues or have questions:
1. Check the [Issues](https://github.com/selzzaf/vehicle-rental-system/issues) page
2. Create a new issue with detailed information
3. Review our [Security Guide](SECURITY.md) for deployment best practices

---

**Note**: This is a demo project for educational purposes. For production use, ensure proper security measures, data validation, and error handling are implemented.
