# Wanderlust Guides

Wanderlust Guides is a responsive, feature-rich travel guide application built with Laravel. It empowers users to explore curated travel destinations, discover rich cultural and culinary content, and plan their next adventure through an interactive and visually stunning web interface.

## Key Features

- **Explore Destinations:** Browse a comprehensive directory of travel locations categorized by different interests.
- **Rich Media Galleries:** Every destination includes a carefully curated 3-image gallery to showcase authentic photography.
- **Culinary & Food Guides:** Dedicated sections for food-focused destinations featuring famous local dishes and recommended restaurant cards.
- **Search & Filtering:** Robust functionality for finding specific destinations quickly and easily.
- **Newsletter Subscription:** Allows users to subscribe and stay updated with the latest travel guides and news.
- **Administrative CMS:** Secure backend administration interface for managing destinations, categories, and site content.
- **Fully Responsive:** Sleek, dynamic, and mobile-friendly UI built with modern styling practices.

## Technologies Used

- **Backend:** Laravel Framework (PHP)
- **Frontend:** HTML, Vanilla CSS, JS, Blade Templates, Vite
- **Database:** MySQL / SQLite

## Requirements

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL or other supported database

## Installation Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd travel-guide
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   Copy the example environment file and generate the application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Update the `.env` file with your database credentials (DB_DATABASE, DB_USERNAME, etc.).*

5. **Run Migrations & Seeders**
   Set up the database tables and populate them with dummy data (categories, destinations, culinary info):
   ```bash
   php artisan migrate --seed
   ```

6. **Start the Development Servers**
   Run the Laravel local development server:
   ```bash
   php artisan serve
   ```
   Compile frontend assets by running Vite:
   ```bash
   npm run dev
   ```

## License

This project relies on the Laravel framework and its ecosystem, open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Contributors

Asra Arshad
Hazam liaqat
