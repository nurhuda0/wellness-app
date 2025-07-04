# 🧪 Manual Testing Guide - Wellness App Booking System

## 🚀 Quick Start

1. **Start the server**: `php artisan serve`
2. **Setup test data**: Visit `http://localhost:8000/test-setup.php`
3. **Access the app**: Visit `http://localhost:8000`

## 👤 Test Credentials

- **Regular User**: `user@test.com` / `password`
- **Admin User**: `admin@test.com` / `password`

---

## 📋 Test Case 1: User Authentication

### **Objective**: Verify user login functionality

**Test Steps**:
1. Navigate to `http://localhost:8000`
2. Click "Log in" link
3. Enter email: `user@test.com`
4. Enter password: `password`
5. Click "Log in" button

**Expected Result**: User should be redirected to dashboard with navigation menu visible

**Verification**: 
- ✅ User is logged in
- ✅ Navigation shows user name
- ✅ Dashboard is accessible

---

## 📋 Test Case 2: Partner Directory Browsing

### **Objective**: Verify partner listing and filtering

**Test Steps**:
1. Login as `user@test.com`
2. Click "Partners" in navigation
3. Verify partner list is displayed
4. Test city filter dropdown
5. Test type filter dropdown
6. Click on a partner name

**Expected Result**: 
- Partners should be listed with details
- Filters should work correctly
- Partner details page should load

**Verification**:
- ✅ 3 test partners are visible
- ✅ Filter options work
- ✅ Partner details page loads

---

## 📋 Test Case 3: Partner Details View

### **Objective**: Verify partner information display

**Test Steps**:
1. From partner list, click "Fitness First Gym"
2. Review partner information displayed
3. Check contact details
4. Look for booking button

**Expected Result**: Complete partner information should be displayed

**Verification**:
- ✅ Partner name, type, city shown
- ✅ Description is visible
- ✅ Contact information displayed
- ✅ "Book Now" button present

---

## 📋 Test Case 4: Create New Booking

### **Objective**: Verify booking creation process

**Test Steps**:
1. From partner details, click "Book Now"
2. Fill in booking form:
   - Date: Select tomorrow's date
   - Time: Select 10:00 AM
   - Service: Select "Gym Session"
   - Notes: "Test booking"
3. Click "Create Booking"

**Expected Result**: Booking should be created and user redirected to booking list

**Verification**:
- ✅ Form accepts input
- ✅ Booking is created
- ✅ Success message shown
- ✅ Redirected to bookings page

---

## 📋 Test Case 5: Booking Calendar View

### **Objective**: Verify calendar functionality

**Test Steps**:
1. Login as `user@test.com`
2. Click "Bookings" in navigation
3. Click "Calendar View" tab
4. Navigate through months
5. Look for booking indicators

**Expected Result**: Calendar should display bookings visually

**Verification**:
- ✅ Calendar loads correctly
- ✅ Month navigation works
- ✅ Bookings are visible on calendar
- ✅ Booking details accessible via calendar

---

## 📋 Test Case 6: Booking Management

### **Objective**: Verify booking editing and cancellation

**Test Steps**:
1. From booking list, click "Edit" on a booking
2. Change the time to 2:00 PM
3. Click "Update Booking"
4. Verify booking is updated
5. Try to cancel a booking

**Expected Result**: Booking should be editable and cancellable

**Verification**:
- ✅ Edit form loads with current data
- ✅ Changes are saved
- ✅ Cancellation works
- ✅ Success messages shown

---

## 📋 Test Case 7: Admin Panel Access

### **Objective**: Verify admin functionality

**Test Steps**:
1. Login as `admin@test.com`
2. Check navigation for admin links
3. Click "Admin Dashboard"
4. Review admin features

**Expected Result**: Admin should have access to management features

**Verification**:
- ✅ Admin navigation visible
- ✅ Dashboard accessible
- ✅ User management available
- ✅ Booking management available

---

## 📋 Test Case 8: Responsive Design

### **Objective**: Verify mobile compatibility

**Test Steps**:
1. Open app in browser
2. Open Developer Tools (F12)
3. Toggle device toolbar
4. Test on mobile viewport
5. Navigate through key features

**Expected Result**: App should be usable on mobile devices

**Verification**:
- ✅ Navigation works on mobile
- ✅ Forms are usable
- ✅ Text is readable
- ✅ Buttons are tappable

---

## 📋 Test Case 9: Error Handling

### **Objective**: Verify error scenarios

**Test Steps**:
1. Try to access `/bookings` without login
2. Try to create booking with invalid date
3. Try to edit non-existent booking
4. Test form validation

**Expected Result**: Appropriate error messages should be shown

**Verification**:
- ✅ Redirected to login when unauthorized
- ✅ Validation errors displayed
- ✅ 404 errors for invalid resources
- ✅ User-friendly error messages

---

## 📋 Test Case 10: Data Persistence

### **Objective**: Verify data is saved correctly

**Test Steps**:
1. Create a new booking
2. Logout and login again
3. Check if booking still exists
4. Verify all booking details are preserved

**Expected Result**: Data should persist between sessions

**Verification**:
- ✅ Booking remains after logout/login
- ✅ All details are preserved
- ✅ Status is maintained
- ✅ Relationships work correctly

---

## 🐛 Bug Reporting Template

When you find issues, document them with:

```
**Bug Title**: [Brief description]

**Steps to Reproduce**:
1. [Step 1]
2. [Step 2]
3. [Step 3]

**Expected Result**: [What should happen]

**Actual Result**: [What actually happened]

**Browser/Device**: [Chrome/Firefox/Safari, Desktop/Mobile]

**Screenshot**: [If applicable]
```

---

## ✅ Testing Checklist

- [ ] User authentication works
- [ ] Partner directory displays correctly
- [ ] Partner filtering works
- [ ] Partner details page loads
- [ ] Booking creation works
- [ ] Booking calendar displays correctly
- [ ] Booking editing works
- [ ] Booking cancellation works
- [ ] Admin panel accessible
- [ ] Mobile responsive design
- [ ] Error handling works
- [ ] Data persistence verified

---

## 🎯 Performance Testing

**Load Time**: App should load within 3 seconds
**Form Submission**: Should respond within 2 seconds
**Navigation**: Should be instant between pages

---

## 🔧 Troubleshooting

**Common Issues**:
- **Server not starting**: Check if port 8000 is available
- **Database errors**: Run `php artisan migrate:fresh --seed`
- **Styling issues**: Run `npm run dev` for CSS compilation
- **Permission errors**: Check file permissions on storage directory

**Useful Commands**:
```bash
php artisan serve                    # Start development server
php artisan migrate:fresh --seed    # Reset database with test data
php artisan route:clear             # Clear route cache
php artisan config:clear            # Clear config cache
npm run dev                         # Compile assets
```
