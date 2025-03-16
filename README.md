# MSc Web Application

This project is a web application built using the Laravel framework. The application is designed to provide a collaborative platform for chat rooms, where users can interact and share content in real-time.

## Table of Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Key Features](#key-features)
- [Contributing](#contributing)
- [License](#license)

## Installation

To install and set up the application, follow these steps:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/acse-tl1820/MSc.git
   cd MSc
   ```

2. **Install dependencies:**

   - Install PHP dependencies using Composer:

     ```bash
     composer install
     ```

   - Install JavaScript dependencies using npm:

     ```bash
     npm install
     ```

3. **Set up the environment:**

   - Copy the example environment file and update the necessary configuration values:

     ```bash
     cp .env.example .env
     ```

   - Generate an application key:

     ```bash
     php artisan key:generate
     ```

4. **Run database migrations:**

   ```bash
   php artisan migrate
   ```

## Configuration

The main configuration file for the application is `config/app.php`. Key configuration options include:

- Application name
- Environment (development, production, etc.)
- Debug mode
- URL
- Timezone
- Locale
- Encryption key
- Maintenance mode driver

Ensure you update the `.env` file with your specific configuration values.

## Usage

To start the development server, run:

```bash
php artisan serve
```

Additionally, you can run the front-end development server using Vite:

```bash
npm run dev
```

Access the application in your web browser at `http://localhost:8000`.

## Project Structure

The project follows the standard Laravel project structure. Key directories and files include:

- **app/Http/Controllers/**: Contains the application's controllers, including the main `Controller.php` file.
- **config/**: Contains configuration files for the application.
- **routes/web.php**: Defines the web routes for the application.
- **resources/views/**: Contains the Blade templates for the application's views.
- **public/**: Contains the publicly accessible files, including the main entry point (`index.php`).

## Key Features

- **Chat Rooms**: Users can create, join, and interact in chat rooms.
- **Real-Time Messaging**: Messages are sent and received in real-time using Laravel Echo and Pusher.
- **Profile Management**: Users can edit their profiles, update information, and manage their accounts.
- **Video Synchronization**: Users can sync and change videos within chat rooms.

## Contributing

We welcome contributions from the community. To contribute, follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Commit your changes and push the branch to your fork.
4. Create a pull request to the main repository.

## License

This project is open-source and available under the [MIT License](LICENSE).
