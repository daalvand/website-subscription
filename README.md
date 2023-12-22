# Website Subscription Platform

This is a simple subscription platform implemented in Laravel, allowing users to subscribe to websites and receive email notifications for new posts.

## Setup

1. Clone the repository:

   ```bash
   git clone https://github.com/daalvand/website-subscription.git
   ```

2. Install dependencies:

   ```bash
   composer install
   ```

3. Configure your database in the `.env` file

4. Run migrations:

   ```bash
   php artisan migrate
   ```

5. (Optional) Seed the database with sample data:

   ```bash
   php artisan db:seed
   ```

## Usage

### API Endpoints

- **Create Post for a Website:**
  ```http
  POST /api/websites/{website}/posts
  ```

- **Subscribe User to a Website:**
  ```http
  POST /api/websites/{website}/subscriptions
  ```

### Artisan Command

- **Send Emails for New Posts:**
  ```bash
  php artisan email:send-posts
  ```
