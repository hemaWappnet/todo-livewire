## About This Project

This is a **To-Do Application** built with the [Laravel](https://laravel.com) framework and [Livewire](https://laravel-livewire.com). It allows users to manage their tasks efficiently with features like task creation, editing, and deletion, all powered by Livewire's reactive components.

## Features

-   Add, edit, and delete tasks.
-   Real-time updates using Livewire.
-   Responsive design with [Tailwind CSS](https://tailwindcss.com).
-   Built-in authentication using [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze).

## Requirements

-   PHP 8.3 or higher
-   Composer
-   Node.js and npm
-   A database (e.g., MySQL, SQLite)

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/hemaWappnet/todo-livewire.git
    cd todo-livewire
    ```

2. Install dependencies:

    ```bash
    composer install
    npm install
    ```

3. Copy the `.env.example` file to `.env` and configure your environment variables:

    ```bash
    cp .env.example .env
    ```

4. Generate the application key:

    ```bash
    php artisan key:generate
    ```

5. Run database migrations:

    ```bash
    php artisan migrate
    ```

6. Build frontend assets & Start the development server:
    ```bash
    composer run dev
    ```

## Usage

Visit `http://localhost:8000` in your browser to start using the application.
