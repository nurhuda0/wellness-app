# 🧪 Module Testing Guide - Wellness App

Quick testing guide for each module of the Wellness App. Use this alongside the existing `API_TESTING_GUIDE.md` and `MANUAL_TESTING_GUIDE.md`.

## 🚀 Quick Setup
```bash
php artisan serve
# Visit: http://localhost:8000/test-setup.php (for test data)
```

---

## 📋 Module 1: User & Company Registration

### Test Credentials
- **Employee**: `user@test.com` / `password`
- **HR Admin**: `admin@test.com` / `password`
- **Super Admin**: `superadmin@test.com` / `password`

### Test Cases

#### 1.1 User Registration
- **URL**: `http://localhost:8000/register`
- **Test**: Create new user account
- **Verify**: Email verification, role assignment

#### 1.2 Company Registration
- **URL**: `http://localhost:8000/companies/register`
- **Test**: Register new company
- **Verify**: Company appears in admin panel

#### 1.3 Role-Based Access
- **Test**: Login with different roles
- **Verify**: Navigation changes based on role
- **Expected**: Admin users see admin panel link

---

## 📋 Module 2: Partner Directory

### Test Cases

#### 2.1 Partner Listing
- **URL**: `http://localhost:8000/partners`
- **Test**: Browse all partners
- **Verify**: Partners display with details

#### 2.2 Search & Filtering
- **Test**: Use city and type filters
- **Filters**: `?city=New York&type=gym`
- **Verify**: Results update correctly

#### 2.3 Partner Details
- **URL**: `http://localhost:8000/partners/{id}`
- **Test**: Click on partner name
- **Verify**: Complete partner information
- **Check**: Contact details, booking button

#### 2.4 Admin Partner Management
- **URL**: `http://localhost:8000/admin/partners` (Admin only)
- **Test**: CRUD operations on partners
- **Verify**: Create, edit, delete partners

---

## 📋 Module 3: Booking System

### Test Cases

#### 3.1 Create Booking
- **URL**: `http://localhost:8000/bookings/create`
- **Test**: Select partner, date, time
- **Verify**: Booking confirmation
- **Check**: Calendar integration

#### 3.2 Booking Calendar
- **URL**: `http://localhost:8000/bookings/calendar`
- **Test**: Navigate months, click dates
- **Verify**: Bookings show on calendar
- **Check**: Booking details on click

#### 3.3 Booking Management
- **URL**: `http://localhost:8000/bookings`
- **Test**: Edit existing booking
- **Test**: Cancel booking (within 2 hours)
- **Verify**: Status updates correctly

#### 3.4 API Booking
```bash
# Create booking via API
POST /api/booking
Authorization: Bearer {token}
{
    "partner_id": 1,
    "booking_time": "2024-06-25 14:00:00"
}
```

---

## 📋 Module 4: Membership Management

### Test Cases

#### 4.1 Membership Plans
- **URL**: `http://localhost:8000/memberships`
- **Test**: View available plans
- **Verify**: Pricing, features, duration

#### 4.2 Admin Membership Management
- **URL**: `http://localhost:8000/admin/memberships` (Admin only)
- **Test**: Create new membership plan
- **Test**: Edit existing plans
- **Verify**: Feature assignment

#### 4.3 User Membership Assignment
- **URL**: `http://localhost:8000/admin/assign-membership`
- **Test**: Assign membership to user
- **Verify**: Expiration date set
- **Check**: Booking limits applied

#### 4.4 Membership Status
- **Test**: Check user dashboard
- **Verify**: Membership status display
- **Check**: Days remaining counter

---

## 📋 Module 5: Admin Panel

### Test Cases

#### 5.1 Dashboard Access
- **URL**: `http://localhost:8000/admin` (Admin login required)
- **Test**: Access admin dashboard
- **Verify**: Analytics and overview

#### 5.2 User Management
- **URL**: `http://localhost:8000/admin/users`
- **Test**: View all users
- **Test**: Assign roles
- **Test**: Manage memberships

#### 5.3 Booking Oversight
- **URL**: `http://localhost:8000/admin/bookings`
- **Test**: View all bookings
- **Test**: Update booking status
- **Verify**: Filter by status/date

#### 5.4 Company Management
- **URL**: `http://localhost:8000/admin/companies`
- **Test**: View registered companies
- **Test**: Manage company details

#### 5.5 System Settings
- **URL**: `http://localhost:8000/admin/settings`
- **Test**: Update system configuration
- **Verify**: Changes persist

---

## 📋 Module 6: API & Mobile Readiness

### Test Cases

#### 6.1 Authentication API
```bash
# Register
POST /api/register
{
    "name": "Test User",
    "email": "test@example.com",
    "password": "password123"
}

# Login
POST /api/login
{
    "email": "test@example.com",
    "password": "password123"
}
```

#### 6.2 Public API Endpoints
```bash
# Get partners
GET /api/partners
GET /api/partners?city=New York&type=gym

# Expected: JSON response with partner data
```

#### 6.3 Protected API Endpoints
```bash
# Get user bookings
GET /api/my-bookings
Authorization: Bearer {token}

# Create booking
POST /api/booking
Authorization: Bearer {token}
{
    "partner_id": 1,
    "booking_time": "2024-06-25 14:00:00"
}

# Cancel booking
DELETE /api/booking/1
Authorization: Bearer {token}
```

#### 6.4 Mobile Responsiveness
- **Test**: Open in mobile browser
- **Test**: Use responsive design mode
- **Verify**: All features work on mobile
- **Check**: Touch-friendly interface

---

## 🔧 Common Test Scenarios

### Error Handling
- **401 Unauthorized**: Try accessing protected routes without login
- **422 Validation**: Submit forms with invalid data
- **404 Not Found**: Access non-existent resources

### Performance Testing
- **Load**: Test with multiple concurrent users
- **Database**: Check query performance
- **API**: Test response times

### Security Testing
- **CSRF**: Verify form protection
- **XSS**: Test input sanitization
- **SQL Injection**: Test database queries

---

## 📱 Mobile Testing Tools

### Browser Testing
- Chrome DevTools Device Simulation
- Firefox Responsive Design Mode
- Safari Web Inspector

### API Testing
- **Postman**: Full API testing
- **cURL**: Command line testing
- **Insomnia**: Alternative to Postman

### Mobile Emulators
- **iOS Simulator**: For iOS testing
- **Android Emulator**: For Android testing
- **BrowserStack**: Cross-platform testing

---

## ✅ Test Checklist

- [ ] All modules accessible
- [ ] User roles working correctly
- [ ] CRUD operations functional
- [ ] API endpoints responding
- [ ] Mobile responsive design
- [ ] Error handling working
- [ ] Admin panel secure
- [ ] Booking system complete
- [ ] Membership management working
- [ ] Search/filter functionality

---

**💡 Tip**: Use the existing `API_TESTING_GUIDE.md` for detailed API testing and `MANUAL_TESTING_GUIDE.md` for comprehensive manual testing scenarios. 