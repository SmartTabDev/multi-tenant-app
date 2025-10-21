# Laravel Application

A basic Laravel application setup.

## Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM

## Installation

1. Install PHP dependencies:
```bash
composer install
```

2. Install Node.js dependencies:
```bash
npm install
```

3. Copy environment file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Run database migrations:
```bash
php artisan migrate
```

## Development

Start the development server:
```bash
php artisan serve
```

Build assets:
```bash
npm run dev
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
