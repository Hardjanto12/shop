# Winnnstore

Winnnstore is a web-based application for an online store, designed to sell digital goods such as game credits. This application is built using the Laravel framework and provides features for both customers and administrators.

## Features

- **User Authentication:** Secure user registration and login system.
- **Admin Dashboard:** A comprehensive dashboard for administrators to manage products, categories, and orders.
- **Sales Reporting:** View sales reports to track the store's performance.
- **Product Management:** Easily add, edit, and remove products from the store.
- **Category Management:** Organize products into categories for better navigation.
- **Shopping Cart:** A simple and intuitive shopping cart for customers to add products to.
- **Checkout System:** A seamless checkout process with payment integration.
- **Payment Gateway:** Integrated with Midtrans for secure online payments.

## Installation

To get started with Winnnstore, follow these steps:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/winnnstore.git
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Set up the environment:**
   - Copy the `.env.example` file to `.env`.
   - Configure your database and other environment variables in the `.env` file.

4. **Generate the application key:**
   ```bash
   php artisan key:generate
   ```

5. **Run database migrations:**
   ```bash
   php artisan migrate
   ```

6. **(Optional) Seed the database:**
   ```bash
   php artisan db:seed
   ```

7. **Start the development server:**
   ```bash
   php artisan serve
   npm run dev
   ```

## API Endpoints

The following are some of the key API endpoints available in the application:

- `GET /`: Home page
- `GET /admin/login`: Admin login page
- `POST /admin/signout`: Admin logout
- `GET /admin/dashboard`: Admin dashboard
- `GET /mobile-legends`: Mobile Legends products page
- `GET /valorant`: Valorant products page
- `POST /mobile-legends/order`: Place an order for Mobile Legends products
- `POST /valorant/order`: Place an order for Valorant products

## Dependencies

This project relies on the following main dependencies:

- **Laravel:** A web application framework with expressive, elegant syntax.
- **Guzzle:** An HTTP client to make API requests.
- **Midtrans:** A payment gateway for online payments.
- **Tailwind CSS:** A utility-first CSS framework for rapid UI development.
- **Vite:** A build tool that provides a faster and leaner development experience for modern web projects.

## License

This project is licensed under the MIT License.