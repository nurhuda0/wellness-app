# 🏃‍♂️ Wellness App - Corporate Wellness Booking Platform

A comprehensive Laravel-based wellness booking platform that connects employees with wellness partners (gyms, spas, sports clubs) through an intuitive booking system with membership management and admin controls.

## ✨ Features

### 🔐 **Module 1: User & Company Registration**
- Multi-role user system (Employee, HR Admin, Super Admin)
- Company registration and management
- Email verification and authentication
- Profile management with membership status

### 🏢 **Module 2: Partner Directory**
- Complete CRUD operations for wellness partners
- Advanced search and filtering (by city, type, status)
- Partner categories: Gym, Sports Club, Spa, Wellness Center
- Detailed partner profiles with contact information

### 📅 **Module 3: Booking System**
- Interactive calendar integration
- Real-time availability checking
- Booking management (create, edit, cancel)
- Status tracking (Pending, Confirmed, Cancelled, Completed)
- Time-based cancellation rules

### 💳 **Module 4: Membership Management**
- Flexible membership plans with billing cycles
- Feature-based membership tiers
- Automatic expiration tracking
- Monthly booking limits per membership
- Membership assignment and management

### ⚙️ **Module 5: Admin Panel**
- Comprehensive dashboard with analytics
- User management and role assignment
- Company and partner management
- Booking oversight and reporting
- System settings and configuration

### 📱 **Module 6: API & Mobile Readiness**
- RESTful API endpoints with Sanctum authentication
- Mobile-optimized responsive design
- JSON API responses for mobile apps
- CORS configuration for cross-platform access

## 🚀 Quick Start

### Prerequisites
- PHP 8.1+
- Composer
- MySQL/PostgreSQL
- Node.js & NPM

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd wellness-app
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Build assets**
   ```bash
   npm run build
   ```

6. **Start the server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to access the application.

## 🧪 Testing Guide

### Manual Testing

#### **1. User Authentication**
- **URL**: `http://localhost:8000/login`
- **Test Credentials**:
  - Regular User: `user@test.com` / `password`
  - Admin User: `admin@test.com` / `password`
- **Expected**: Successful login with role-based navigation

#### **2. Partner Directory**
- **URL**: `http://localhost:8000/partners`
- **Test Steps**:
  1. Browse partner list
  2. Test city/type filters
  3. Click partner for details
  4. Verify "Book Now" functionality
- **Expected**: Filtered results and detailed partner pages

#### **3. Booking System**
- **URL**: `http://localhost:8000/bookings`
- **Test Steps**:
  1. Create new booking with partner
  2. Select date/time from calendar
  3. Add notes and submit
  4. Edit existing booking
  5. Cancel booking (if within time limit)
- **Expected**: Full booking lifecycle management

#### **4. Calendar View**
- **URL**: `http://localhost:8000/bookings/calendar`
- **Test Steps**:
  1. Navigate through months
  2. Click on booking dates
  3. View booking details
  4. Test responsive design
- **Expected**: Interactive calendar with booking indicators

#### **5. Admin Panel**
- **URL**: `http://localhost:8000/admin` (Admin login required)
- **Test Sections**:
  - Dashboard analytics
  - User management
  - Partner management
  - Booking oversight
  - Membership management
- **Expected**: Full administrative control

### API Testing

#### **Base URL**: `http://localhost:8000/api`

#### **Authentication Endpoints**
```bash
# Register
POST /api/register
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
}

# Login
POST /api/login
{
    "email": "john@example.com",
    "password": "password123"
}
```

#### **Public Endpoints**
```bash
# Get partners (with filters)
GET /api/partners
GET /api/partners?city=New York&type=gym
```

#### **Protected Endpoints** (Require Bearer token)
```bash
# Create booking
POST /api/booking
Authorization: Bearer YOUR_TOKEN
{
    "partner_id": 1,
    "booking_time": "2024-06-25 14:00:00"
}

# Get user bookings
GET /api/my-bookings
Authorization: Bearer YOUR_TOKEN

# Cancel booking
DELETE /api/booking/1
Authorization: Bearer YOUR_TOKEN
```

### Automated Testing
```bash
# Run all tests
php artisan test

# Run specific test suites
php artisan test --filter=BookingTest
php artisan test --filter=PartnerDirectoryTest
```

## 📁 Project Structure

```
wellness-app/
├── app/
│   ├── Http/Controllers/
│   │   ├── Api/           # API controllers
│   │   ├── AdminController.php
│   │   ├── BookingController.php
│   │   ├── PartnerController.php
│   │   └── MembershipController.php
│   ├── Models/
│   │   ├── User.php       # Multi-role user model
│   │   ├── Partner.php    # Wellness partner model
│   │   ├── Booking.php    # Booking system model
│   │   ├── Membership.php # Membership plans
│   │   └── Company.php    # Company registration
│   └── Http/Middleware/
│       └── CheckAdmin.php # Admin access control
├── database/
│   ├── migrations/        # Database schema
│   ├── seeders/          # Test data
│   └── factories/        # Model factories
├── resources/views/
│   ├── admin/            # Admin panel views
│   ├── bookings/         # Booking system views
│   ├── partners/         # Partner directory views
│   └── memberships/      # Membership management
└── routes/
    ├── api.php           # API endpoints
    └── web.php           # Web routes
```

## 🔧 Configuration

### Environment Variables
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wellness_app
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Key Features Configuration
- **Booking cancellation window**: 2 hours before booking time
- **Membership expiration**: Automatic tracking with email notifications
- **Admin roles**: HR Admin and Super Admin with different permissions
- **API rate limiting**: Built-in Laravel Sanctum protection

## 🚀 Deployment

### Using Docker
```bash
docker build -t wellness-app .
docker run -p 8000:8000 wellness-app
```

### Manual Deployment
1. Set up production environment variables
2. Run `composer install --optimize-autoloader --no-dev`
3. Run `npm run build`
4. Set up web server (Apache/Nginx)
5. Configure database and run migrations

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

- **Documentation**: Check the `API_TESTING_GUIDE.md` and `MANUAL_TESTING_GUIDE.md`
- **Issues**: Create an issue in the repository
- **Email**: support@wellness-app.com

---

**Built with ❤️ using Laravel, Tailwind CSS, and Alpine.js**
