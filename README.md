# ASSESSMENT 1 - BASIC APPLICATION

This is my idea of answering the first question for a company.

## Requirements
1. User can choose multiple of item to purchase
2. Store details of purchase into database, includes user details (name, email, mobile number)
3. Show details of purchase in new page

## Assumptions
1. There's no **roles and permissions** involved. If required, can always implement Spatie's [package](https://github.com/spatie/laravel-permission) and enforce Laravel's Resource Policies.
2. Item details are simple. Full detail should also include `measurement_unit, currency_code & image_url`.
3. Item's quantity does not have **stock management** involved, so user will ways be able to purchase any of the item. If required, these columns are required: `current_stock, min_stock_level, max_stock_level, reorder_point, reorder_quantity & last_restock_date`.
4. There's no **pessimistic lock** involved, so multiple users will be able to edit and update a record for example an item. Only the last update will be reflected on the database. If required for example this becomes big and an ecommerce, `sharedLock()` & `lockForUpdate()` from Eloquent can be used.

## AI Involvement
The basic idea came by myself, but I'm using AI tool such as [Claude](https://claude.ai/chats) to discuss on fine-tuning or improvement on the basic idea such as pessimistic lock.

Aside from idea for backend, I'm also using AI to generate the basic or complex layout for frontend.

## Requirements

- PHP 8.2+
- NodeJS 20.0+

## Installation

1. Clone the repository:
   ```
   git clone https://github.com/azri-cs/assesment-1.git
   ```

2. Navigate to the project directory:
   ```
   cd assesment-1
   ```
   
3. Change repository branch to `basic-application`:
   ```
   git checkout basic-application
   ```

4. Install dependencies:
   ```
   composer install && npm install && npm run build
   ```

5. Copy the `.env.example` file to `.env` and configure your database settings.
   ```
   cp .env.example .env
   ```

6. Generate application key:
   ```
   php artisan key:generate
   ```

7. Run migrations and optionally seed the database:
   ```
   php artisan migrate --seed
   ```

8. Start the development server:
   ```
   php artisan serve
   ```

## Usage

1. Access the application at `http://localhost:8000`
2. Login with the default credential:
    - Email: `test@example.com`
    - Password: `password`
