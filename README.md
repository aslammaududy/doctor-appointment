# Doctor Appointment Management System

This is a Laravel-based web application for managing doctor appointments. It allows administrators, doctors, and patients to interact with the system for scheduling and managing appointments.

## Features

- User roles: Admin, Doctor, and Patient.
- Appointment scheduling and management.
- Doctor and patient profiles.
- Secure authentication using Laravel Sanctum.
- RESTful API endpoints for managing appointments and schedules.

## Prerequisites

This project assumes that there is already a Hospital Information System (HIS) in place for patient registration and doctor management.

## Requirements

- PHP >= 8.4
- Composer
- A database (e.g., MySQL, SQLite)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/aslammaududy/doctor-appointment.git
   cd doctor-appointment
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Set up the environment file:
   ```bash
   cp .env.example .env
   ```
   Update the `.env` file with your database and other configuration details.

4. Generate the application key:
   ```bash
   php artisan key:generate
   ```

5. Run database migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

6. Start the development server:
   ```bash
   php artisan serve
   ```

7. Access the documentation:
    ```
    /docs/api
    ```

## Usage

- Admins can manage users, doctors, and appointments.
- Doctors can manage their schedules and view appointments.
- Patients can book and manage their appointments.

## API Endpoints

- `POST /api/register` - Register a new user.
- `POST /api/login` - Log in to the system.
- `POST /api/logout` - Log out of the system.
- `GET /api/appointments` - List all appointments (role-based access).
- `POST /api/appointments` - Create a new appointment.
- `PUT /api/appointments/{id}` - Update an appointment.
- `DELETE /api/appointments/{id}` - Cancel an appointment.

## Dependencies

- Laravel Framework 12
- Laravel Sanctum for API authentication

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request.

## License

This project is open-source and available under the [MIT License](https://opensource.org/licenses/MIT).
