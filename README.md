# saffron assignment demo

## Installation:

1. Clone the repository

    ```bash
    git clone git@github.com:amit001/saffron.git
    ```

2. Install the requirements

    ```bash
    composer update
    ```

3. Create a database and update the `.env` file with the database credentials.

4. Run the migrations

    ```bash
    php artisan migrate
    ```

5. Run the seeders

    ```bash
    php artisan db:seed --class=CategorySeeder
    php artisan db:seed --class=ProjectSeeder
    php artisan db:seed --class=ProjectCategoriesFakerSeeder
    ```

6. Run the server

    ```bash
    php artisan serve
    ```

7. Navigate to "Projects" in the dashboard (homepage).

8. Navigate to "Categories-Projects" and select a category to view the projects in that category.

You can also create a new project or update an existing project.
