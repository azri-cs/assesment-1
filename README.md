# ASSESSMENT 1 - CODE OPTIMIZATION

This is my idea of answering the second question for a company.

## Requirements
1. Create a page that can import the Excel records into database
2. User experience of upload cannot be more than 2 seconds

## Assumptions
1. Only single file upload required and only accept `XLSX` format.
2. No file size limit.
3. Error handling when upload failed or during import is ignored.
4. Process monitor such as Supervisor is not required to monitor queue.
5. Email notification is not implemented.

## AI Involvement
The basic idea came by myself, but I'm using AI tool such as [Claude](https://claude.ai/chats) to discuss on fine-tuning or improvement on the importing Excel.

Aside from idea for backend, I'm also using AI to generate the basic or complex layout for frontend.

## Strategies
1. Using queued reading to process the import in the background.
2. Using batch insert to limit the amount of queries per batch with batch size of 5000.
3. Using chunk reading to read the spreadsheets in chunks with chunk size of 5000.
4. Inserting the data in chunks of 5000 records at a time.
5. Using query builder `DB` instead of Eloquent ORM.
6. Using `map()` function instead of `foreach` loop.
7. Manually setting `created_at` & `updated_at` columns instead of relying on Eloquent.

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

3. Change repository branch to `code-optimization`:
   ```
   git checkout code-optimization
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

9. Start the queue worker:
   ```
   php artisan queue:work
   ```

## Usage

1. Access the application at `http://localhost:8000`
2. Login with the default credential:
    - Email: `test@example.com`
    - Password: `password`
