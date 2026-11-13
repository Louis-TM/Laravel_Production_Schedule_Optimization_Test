# Laravel_Production_Schedule_Optimization_Test

A simple production scheduling application built with Laravel, Blade, Bootstrap, and PostgreSQL.

Overview:
This application allows users to create production orders and generate a basic production schedule based on customer deadlines, product types, and production speeds.

Features:
    Create orders with a customer name and required completion date.
    Store orders and order items in PostgreSQL.
    Generate a production schedule ordered by customer deadlines.
    Calculate estimated production times based on quantity and production speed.
    Include a 30-minute changeover delay when switching product types.
    Display the schedule in a Bootstrap table.

Technologies:
    PHP / Laravel
    PostgreSQL
    Blade Templates
    Bootstrap
    JavaScript

Installation:

1. Clone the repository

git clone <https://github.com/Louis-TM/Laravel_Production_Schedule_Optimization_Test.git>
cd <Laravel_Production_Schedule_Optimization_Test>

2. Install dependencies

composer install

3. Configure the environment

Copy .env.example to .env and configure your PostgreSQL connection:

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=production_scheduler
DB_USERNAME=your_username
DB_PASSWORD=your_password

4. Generate the application key

php artisan key:generate

5. Run database migrations

php artisan migrate

6. Seed the product catalog

php artisan db:seed --class=ProductCatalogSeeder

7. Start the application

php artisan serve

Current Limitations:

Multiple products per order: The database structure supports multiple order items, but the form functionality is not fully reliable.

Scheduling optimization: Orders are scheduled by deadline rather than using an optimization algorithm to minimize changeovers or lateness.

Schedule recalculation: Opening the schedule page recalculates the schedule starting from the current time, so scheduled times change between visits.

Production availability: The scheduler assumes continuous operation and does not account for working hours, weekends, maintenance, or downtime.

Order management: The application supports basic order creation but does not include editing, deleting, or rescheduling individual orders.

Validation: Basic field validation is implemented. Product-type consistency validation is not currently enforced server-side.

Testing: Functionality was tested manually. Automated tests have not been implemented.


Assumptions and Design Decisions:

Order priority: Orders are scheduled by their need-by date to prioritize earlier deadlines.
Continuous production: Production is assumed to run 24/7 without breaks or downtime. Since working hours weren't specified
Changeover time: Switching product types adds a fixed 30-minute delay, as suggested in the requirements.
Production time: All products in an order are assumed to share the same type and production speed. Their quantities are combined to calculate production duration.
Sceduling start: Scheduling begins at the current time, since no fixed production start date was provided.