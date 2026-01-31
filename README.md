
## Installation Guide

To set up this Laravel 8 project locally, follow these steps:

1. **Clone the Repository**
    ```bash
    git clone https://github.com/hasiofficesits/curasys-ccms.git
    cd curasys-ccms
    ```

2. **Install Dependencies**
    ```bash
    composer install
    ```

3. **Setup Environment**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configure Database**
    - Update `.env` with your database credentials
    ```bash
    php artisan migrate
    php artisan db:seed
    ```

5. **Run the Application**
    ```bash
    php artisan serve
    ```

Access the application at `http://localhost:8000`
