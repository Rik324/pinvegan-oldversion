# Fruit Shop - Promotion & Quotation Web Application

<p align="center">
<img src="https://img.shields.io/badge/Laravel-12.0-red" alt="Laravel Version">
<img src="https://img.shields.io/badge/PHP-8.2-blue" alt="PHP Version">
<img src="https://img.shields.io/badge/Tailwind-3.0-teal" alt="Tailwind Version">
</p>

## About Fruit Shop

Fruit Shop is a professional web application designed for fruit vendors to showcase their products and allow customers to request quotes. The platform provides a visually appealing interface for browsing fruits, viewing detailed product information, and submitting quote requests.

## Features

### Customer Features

- **Fruit Showcase**: Browse all available fruits with filtering by category
- **Detailed Product Information**: View fruit details including origin, seasonality, and descriptions
- **Quote Request System**: Add fruits to a quote request and specify quantities
- **Contact Form**: Easily get in touch with the business
- **Multilingual Support**: Full translation support in English, Thai, and Chinese

### Admin Features

- **Secure Dashboard**: Manage all aspects of the website
- **Product Management**: Add, edit, and delete fruit listings
- **Category Management**: Organize fruits into categories
- **Quote Request Management**: View and manage customer quote requests
- **User Management**: Manage admin accounts and permissions

## Technology Stack

- **Framework**: Laravel 12
- **Frontend**: 
  - Blade templates
  - Tailwind CSS for styling
  - Alpine.js for interactive UI components
- **Authentication**: Laravel Breeze
- **Database**: SQLite
- **Translations**: Astrotomic/laravel-translatable package for model translations and Laravel's built-in localization for UI strings

## Installation

1. Clone the repository
   ```bash
   git clone https://github.com/yourusername/fruit-shop.git
   ```

2. Navigate to the project directory
   ```bash
   cd fruit-shop
   ```

3. Install dependencies
   ```bash
   composer install
   npm install
   ```

4. Copy the environment file
   ```bash
   cp .env.example .env
   ```

5. Generate application key
   ```bash
   php artisan key:generate
   ```

6. Run migrations and seed the database
   ```bash
   php artisan migrate --seed
   ```

7. Run migrations and seed the database with sample fruits
   ```bash
   php artisan migrate:fresh --seed
   ```

8. Start the development server with all services (recommended)
   ```bash
   composer run dev
   ```

   Or start individual services:
   ```bash
   # Start only the web server
   php artisan serve
   
   # Compile assets with Vite
   npm run dev
   ```

## Queue Configuration

The application uses Laravel's queue system with the database driver for processing background jobs, including emails.

### Setup Queue Tables

1. Configure your `.env` file to use the database queue driver:

   ```env
   QUEUE_CONNECTION=database
   ```

2. Run the migrations to create the queue tables in your local database:

   ```bash
   php artisan queue:table
   php artisan migrate
   ```

### Processing Queues

#### Local Development

For local development, you can process queues using the scheduler:

```bash
php artisan schedule:work
```

This will run the scheduler, which processes the queue every minute with the `queue:work --stop-when-empty` command as configured in `routes/console.php`.

Alternatively, you can manually process jobs in the queue:

```bash
php artisan queue:work
```

#### Production Environment

Set Up the Cron Job: This is the key to processing your queues on shared hosting.
In hPanel, go to Advanced -> Cron Jobs.

Under Create a New Cron Job, select Custom.

In the Command to run field, enter the following command, replacing yourdomain.com with your actual domain:

```bash
/usr/bin/php /home/uXXXXXX/domains/yourdomain.com/artisan schedule:run >> /dev/null 2>&1

```

## Usage

### Customer Interface

- Visit the home page to see featured fruits
- Browse all fruits or filter by category
- Click on a fruit to view detailed information
- Add fruits to your quote request
- Fill out the quote request form with your contact information
- Submit your request and receive a confirmation
- Switch between English, Thai, and Chinese languages using the language selector

### Admin Interface

- Access the admin dashboard at `/login`
- Default admin credentials:
  - Email: admin@example.com
  - Password: password
- Manage fruits, categories, and quote requests
- Update site content and settings

## Translation System

The application uses a comprehensive translation system with two main components:

### 1. Model Translations (Astrotomic/laravel-translatable)

The application uses the [Astrotomic/laravel-translatable](https://github.com/Astrotomic/laravel-translatable) package for model translations. This enables content to be stored in multiple languages.

**Translatable Models:**
- **Fruits**: name, description, origin, seasonality
- **Categories**: name, description

**Translation Tables:**
- `fruit_translations`: Contains translatable fields for fruits
- `category_translations`: Contains translatable fields for categories

### 2. UI String Translations

UI elements are translated using Laravel's built-in localization system with language files:
- `resources/lang/en/frontend.php`
- `resources/lang/th/frontend.php`
- `resources/lang/zh/frontend.php`

These files contain translations for navigation, buttons, labels, and other UI elements.

## Contributing

We welcome contributions to the Fruit Shop project! Here's how you can contribute:

### Proposing New Features

1. **Fork the repository**
   - Visit the GitHub repository page
   - Click on the 'Fork' button in the top-right corner
   - This creates a copy of the repository in your GitHub account

2. **Clone your fork**
   ```bash
   git clone https://github.com/your-username/fruit-shop.git
   cd fruit-shop
   ```

3. **Create a new branch**
   ```bash
   git checkout -b feature/your-feature-name
   ```

4. **Make your changes**
   - Implement your feature or fix
   - Add appropriate tests if applicable
   - Update documentation as needed

5. **Commit your changes**
   ```bash
   git add .
   git commit -m "Add feature: your feature description"
   ```

6. **Push to your fork**
   ```bash
   git push origin feature/your-feature-name
   ```

7. **Open a Pull Request**
   - Go to the original repository on GitHub
   - Click on 'Pull Requests' and then 'New Pull Request'
   - Select 'compare across forks'
   - Select your fork and branch as the source
   - Write a clear description of your changes
   - Submit the pull request

### Pull Request Guidelines

- Ensure your code follows the project's coding standards
- Include tests for new features
- Update documentation as necessary
- Keep pull requests focused on a single feature or fix
- Reference any related issues in your pull request description

## Screenshots

### Homepage

![Fruit Shop Homepage](https://github.com/Ekaluk52003/laravel_fruitshop/blob/master/screenshots/homepage.png?raw=true)

The homepage features a vibrant yellow hero section with the tagline "The Best of Thailand, Delivered Worldwide" and showcases the clean, professional navigation design with the green header.

## License

The Fruit Shop application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
