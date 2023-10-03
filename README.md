# About Mattress Shop App

A laravel application that sells mattress, distributors can sign up and view available mattresses and order them

# requirements
1. php 8.2 or higher
2. composer
3. mysql or xampp
4. pindo account (https://pindo.io/)

# to run the application:
1. clone the application
2. run composer i
3. cp .env.example .env, provide the name of the DB, host, port, connection and these variables
     - SMS_TOKEN=your pindo token
     - SMS_URL="https://api.pindo.io/v1/sms"
4. php artisan key:generate
5. php artisan storage:link
6. php artisan migrate
7. php artisan db:seed
8. php artisan serve
9. in other terminal run php artisan queue:listen for the job queues

The project is ready on port 8000
