<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Real Estate Manager

Real Estate Manager is a Laravel-based web application designed for managing real estate properties, including residences and apartments. It offers both an admin and commercial interface, allowing users to efficiently handle property listings and client requests.

## Features

- **Residence Management**: Easily add, update, and delete residence properties.

- **Apartment Management**: Create and manage apartments within each residence.

- **Client Requests**: Clients can submit requests for specific apartments, and these requests are tracked in a special request table.

- **Admin Interface**: Administrators have access to a powerful dashboard to manage properties and client requests.

- **Commercial Interface**: Commercial users can also add and manage property listings.

## Getting Started

These instructions will help you get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

- [PHP](https://www.php.net/) (>=7.4)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) (for asset compilation)
- [Laravel](https://laravel.com/) (>= 8.x)
- [MySQL](https://www.mysql.com/) or [PostgreSQL](https://www.postgresql.org/)

### Installation

1. Clone the repository:

   ```bash
   https://github.com/boucettaRachid/RealEstate_Manager.git

2. Change directory to the project folder:
    ```bash
     cd real-estate-manager
3. Install Composer dependencies:

    ```bash
     composer install
4. Create a copy of the .env.example file and configure your environment variables, including database connection settings:

    ```bash
     cp .env.example .env

5. Generate an application key:

    ```bash
     php artisan key:generate

6. Run migrations to set up the database schema:

   ```bash
    php artisan migrate
   
7. Seed the database with initial data (including users) using the following command:

   ```bash
    php artisan db:seed --class=CreateUsersSeeder
   
8. Install Node.js dependencies:

   ```bash
    npm install
   
9. Build assets for development:

   ```bash
    npm run dev

10. Start the development server:

    ```bash
      php artisan serve

11. You can now access the site at 'http://localhost:8000' .

### Login Credentials

Use the following login credentials to access the admin and commercial interfaces:

**Admin:**

- Email: admin@admin.com
- Password: 1111

**Commercial User:**

- Email: normal@user.com
- Password: 1111


### Usage

Access the admin interface at /admin and log in with your admin credentials.

Access the commercial interface at /commercial and log in with your commercial user credentials.

Add, update, and delete residences and apartments via the interfaces.

Clients can submit requests for apartments.

### Contributing

Contributions are welcome! If you would like to contribute to this project, please follow these guidelines:

Fork the repository on GitHub.

Clone your forked repository to your local machine.

Create a new branch for your feature or bug fix.

Make your changes and commit them with descriptive commit messages.

Push your branch to your forked repository on GitHub.

Create a pull request from your branch to the main repository.

### License

This project is licensed under the MIT License - see the LICENSE file for details.

Acknowledgments
Laravel community and contributors for creating a powerful PHP framework.

Your organization or team members for supporting and using this project.

### Contact

If you have any questions or need further assistance, feel free to contact us at 
    hassanessalmi5@gmail.com

    

