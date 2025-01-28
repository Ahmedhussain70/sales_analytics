<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Sales Analytics

The **Sales Analytics** project is a real-time data visualization and reporting tool built using Laravel. This project aims to provide insightful analytics for sales data, leveraging real-time event broadcasting, AI recommendations, and WebSocket support for live updates.

### Key Features

- **Real-Time Reporting:** Live updates on new orders and analytics using WebSockets.
- **AI Integration:** AI-based recommendations for product promotions.
- **Customizable Reports:** Generate detailed sales reports based on multiple filters.

---

## Prerequisites

- PHP 8.2+
- Composer
- Laravel 11
- OpenWeather API Key
- OpenAI API Key

---

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/sales-analytics.git
   cd sales-analytics
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Configure the environment:
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update `.env` with your database, OpenAI API key, and other settings.

4. Run migrations:
   ```bash
   php artisan migrate
   ```

5. Serve the application:
   ```bash
   php artisan serve
   ```

---

## API Endpoints

### AI Recommendations

- **Endpoint:** `GET ai/recommendations`
- **Description:** Sends recent sales data to the AI system and retrieves recommendations for product promotion.
- **Response:** JSON object containing recommendations.

---

## Usage

1. Access the application via `http://localhost:8000/api`.
2. Monitor real-time analytics updates as new orders are placed.
3. Use the `/recommendations` endpoint to fetch AI-generated insights for product promotions.

---

### Open weather API

- **Endpoint:** `GET weather/recommendations`
- **Description:** Sends recent sales data to the AI system and retrieves recommendations for product promotion.
- **Response:** JSON object containing recommendations.

---

## Usage

1. Access the application via `http://localhost:8000/api`.
2. Monitor real-time analytics updates as new orders are placed.
3. Use the `/recommendations` endpoint to fetch AI-generated insights for product promotions.

---

## License

The Sales Analytics project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
