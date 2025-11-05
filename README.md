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
   ```
   OPENAI_API_KEY=
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
