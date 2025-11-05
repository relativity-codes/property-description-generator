# Property Description Generator

This project is a Laravel application designed to generate AI-optimized property descriptions for real estate listings. It utilizes Livewire for dynamic form handling and Tailwind CSS for responsive design.

## Features

- Input property details including title, type, location, price, and key features.
- Generate SEO-friendly property descriptions using AI.
- Regenerate descriptions for alternative versions.
- Copy generated descriptions to the clipboard.
- Mobile-responsive design.

## Requirements

- PHP 8.0 or higher
- Laravel 11.x
- Composer
- Node.js and npm (for front-end dependencies)

## Installation

1. Clone the repository:
   ```
   git clone https://github.com/relativity-codes/property-description-generator.git
   cd property-description-generator
   ```

2. Install PHP dependencies:
   ```
   composer install
   ```

3. Install front-end dependencies:
   ```
   npm install
   ```

4. Set up your environment file:
   ```
   cp .env.example .env
   php artisan key:generate
   ```

5. Run migrations to set up the database:
   ```
   php artisan migrate
   ```

6. Start the development server:
   ```
   php artisan serve
   ```

## Usage

- Navigate to `http://localhost:8000` in your web browser.
- Fill out the property details in the form.
- Click "Generate Description" to create an AI-optimized property description.
- Use the "Regenerate" button for alternative descriptions or "Copy Description" to copy the text to your clipboard.

## Testing

To run the tests, use the following command:
```
php artisan test
```

## Contributing

Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bugs.

## License

This project is licensed under the MIT License. See the LICENSE file for more details.

## Screenshot-ready (for interviews)

If you need a quick screenshot of the app for an interview or portfolio, follow these steps to produce a clean, production-like snapshot:

1. Build frontend assets (creates optimized files in `public/build`):

   npm install
   npm run build

2. Ensure the app key and database are set up:

   cp .env.example .env
   php artisan key:generate
   php artisan migrate --seed

3. Serve the app locally and open the root URL:

   php artisan serve --host=127.0.0.1 --port=8000

4. Open your browser at http://127.0.0.1:8000, set the viewport to 1200x800, and capture the landing page or the demo card. The landing page includes a demo of the Livewire property form ready for screenshots.

Notes:
- If you want to highlight tone variations, select the Tone dropdown in the form before generating the description.
- The README includes quick run steps; for a full dev experience use `npm run dev` and `php artisan serve` while developing.