# E-Commerce Loyalty API

An API for recording user purchases, unlocking achievements, awarding badges, and processing cashback rewards.

## Requirements

- PHP 8.3+
- Composer
- MySQL

## Setup

1. Clone the repository.
2. Install PHP dependencies:

```bash
composer install
```

3. Create your environment file:

```bash
copy .env.example .env
```

4. Generate the application key:

```bash
php artisan key:generate
```

5. Update `.env` with your database credentials.

Example:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_commerce_loyalty
DB_USERNAME=root
DB_PASSWORD=
```

6. Run the database migrations:

```bash
php artisan migrate
```

7. Run the database seeder:

```bash
php artisan db:seed
```

8. Start the local development server:

```bash
php artisan serve
```

The application will usually be available at:

```text
http://127.0.0.1:8000
```

## Running the Application

Once the server is running, you can test the API with Postman, Insomnia, or `curl`.

All API routes are prefixed with:

```text
/api
```

## API Endpoints

### Record a Purchase

`POST /api/users/{user}/purchase`

Records a purchase for a user and triggers the loyalty flow:

- purchase recorded
- achievements checked
- badge checked
- cashback payment of `300 Naira` processed if a badge is newly unlocked

Cashback is simulated using a mock payment flow through Laravel logging.

Example request body:

```json
{
    "item_name": "Laptop Bag",
    "amount": 15000
}
```

Example URL:

```text
POST http://127.0.0.1:8000/api/users/1/purchase
```

### Get a User's Achievements and Badge Progress

`GET /api/users/{user}/achievements`

Returns:

- unlocked achievements
- next available achievements
- current badge
- next badge
- how many achievements remain before the next badge

Example URL:

```text
GET http://127.0.0.1:8000/api/users/1/achievements
```

## Notes

- Cashback is a fixed `300 Naira` reward when a new badge is unlocked.
- Cashback is simulated with a mock payment provider using application logs.
- Run the seeder before testing so users, achievements, and badges are available.
