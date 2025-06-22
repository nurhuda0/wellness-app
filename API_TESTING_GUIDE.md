# Wellness App API Testing Guide

This guide shows you how to test all the API endpoints using different tools.

## Base URL
```
http://localhost:8000/api
```

## 1. Authentication Endpoints

### Register a New User
**POST** `/api/register`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "role": "user"
}
```

**Expected Response:**
```json
{
    "token": "1|abc123...",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "role": "user"
    }
}
```

### Login
**POST** `/api/login`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body:**
```json
{
    "email": "john@example.com",
    "password": "password123"
}
```

**Expected Response:**
```json
{
    "token": "1|abc123...",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    }
}
```

## 2. Public Endpoints

### Get Partners
**GET** `/api/partners`

**Optional Query Parameters:**
- `city` - Filter by city
- `type` - Filter by category (gym, spa, etc.)

**Examples:**
```
GET /api/partners
GET /api/partners?city=New York
GET /api/partners?type=gym
GET /api/partners?city=New York&type=spa
```

**Expected Response:**
```json
[
    {
        "id": 1,
        "name": "Fitness First",
        "city": "New York",
        "category": "gym",
        "description": "Premium fitness center"
    }
]
```

## 3. Protected Endpoints (Require Authentication)

### Create a Booking
**POST** `/api/booking`

**Headers:**
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer YOUR_TOKEN_HERE
```

**Body:**
```json
{
    "partner_id": 1,
    "booking_time": "2024-06-25 14:00:00"
}
```

**Expected Response:**
```json
{
    "id": 1,
    "user_id": 1,
    "partner_id": 1,
    "booking_time": "2024-06-25T14:00:00.000000Z",
    "status": "pending",
    "created_at": "2024-06-23T10:00:00.000000Z"
}
```

### Get My Bookings
**GET** `/api/my-bookings`

**Headers:**
```
Authorization: Bearer YOUR_TOKEN_HERE
```

**Expected Response:**
```json
[
    {
        "id": 1,
        "partner": {
            "name": "Fitness First"
        },
        "booking_time": "2024-06-25T14:00:00.000000Z",
        "status": "pending"
    }
]
```

### Cancel a Booking
**DELETE** `/api/booking/1`

**Headers:**
```
Authorization: Bearer YOUR_TOKEN_HERE
```

**Expected Response:**
```json
{
    "message": "Booking cancelled"
}
```

## 4. Testing with Different Tools

### A. Postman Setup

1. **Create a Collection:**
   - Open Postman
   - Click "New" → "Collection"
   - Name it "Wellness App API"

2. **Set up Environment Variables:**
   - Click "Environments" → "New"
   - Add variables:
     - `base_url`: `http://localhost:8000/api`
     - `token`: (leave empty, will be set after login)

3. **Create Requests:**
   - Right-click collection → "Add Request"
   - Use `{{base_url}}/login` for the URL
   - Set method to POST
   - Add JSON body

4. **Automate Token Setting:**
   - In the login request, go to "Tests" tab
   - Add this script:
   ```javascript
   if (pm.response.code === 200) {
       const response = pm.response.json();
       pm.environment.set("token", response.token);
   }
   ```

### B. cURL Examples

**Register:**
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
  }'
```

**Login:**
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

**Get Partners (with filter):**
```bash
curl -X GET "http://localhost:8000/api/partners?city=New%20York&type=gym"
```

**Create Booking (with token):**
```bash
curl -X POST http://localhost:8000/api/booking \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "partner_id": 1,
    "booking_time": "2024-06-25 14:00:00"
  }'
```

### C. Browser Testing (GET requests only)

Open your browser and navigate to:
```
http://localhost:8000/api/partners
http://localhost:8000/api/partners?city=New%20York
```

## 5. Common Error Responses

### 401 Unauthorized
```json
{
    "message": "Unauthenticated."
}
```
**Solution:** Include valid Authorization header with Bearer token

### 422 Validation Error
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email field is required."],
        "password": ["The password field is required."]
    }
}
```
**Solution:** Check request body format and required fields

### 404 Not Found
```json
{
    "error": "Booking not found"
}
```
**Solution:** Check if the resource ID exists

## 6. Testing Workflow

1. **Start the server:**
   ```bash
   php artisan serve
   ```

2. **Test registration:**
   - POST to `/api/register`
   - Save the returned token

3. **Test login:**
   - POST to `/api/login`
   - Verify you get a token

4. **Test public endpoints:**
   - GET `/api/partners`
   - Try different filters

5. **Test protected endpoints:**
   - Use the token in Authorization header
   - Create a booking
   - List your bookings
   - Cancel a booking

## 7. Mobile App Testing

For mobile app development, you can use:
- **iOS:** Postman for iOS, or build a simple test app
- **Android:** Postman for Android, or build a simple test app
- **React Native:** Use fetch() or axios in your app
- **Flutter:** Use http package

## 8. Troubleshooting

### Server not running
```bash
php artisan serve
```

### Database issues
```bash
php artisan migrate
php artisan db:seed
```

### CORS issues
Check if your frontend domain is allowed in `config/cors.php`

### Token expired
Get a new token by logging in again

## 9. Sample Test Data

You can use these test accounts:
- Email: `admin@test.com`, Password: `password` (Admin)
- Email: `user@test.com`, Password: `password` (User)

Or create new accounts using the register endpoint. 