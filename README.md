# Online Shop (EBUS)

A web-based online shop application built with PHP and MySQL. This project allows users to browse products, manage a shopping cart, and simulate purchases. Admin users can manage products through a dedicated dashboard.

## Features

- **User Registration & Login:** Secure registration and login system with password hashing.
- **User Roles:** Supports both customers and admin users.
- **Product Catalog:** Browse all available products with images and prices.
- **Shopping Cart:** Add, view, and remove products from the cart.
- **Checkout & Payment:** Simulated payment process requiring card details.
- **Admin Dashboard:** Admins can add, update, and delete products.
- **Responsive Design:** Styled with CSS for a modern look.

## File Structure

- [`index.php`](index.php): Home page, product listing, add-to-cart.
- [`login.php`](login.php): User login form and logic.
- [`register.php`](register.php): User registration form and logic.
- [`cart.php`](cart.php): Shopping cart management.
- [`payment.php`](payment.php): Checkout and payment simulation.
- [`admin.php`](admin.php): Admin dashboard.
- [`products.php`](products.php): Admin product management.
- [`addProduct.php`](addProduct.php): Add new products (admin only).
- [`updateProduct.php`](updateProduct.php): Update existing products (admin only).
- [`deleteProduct.php`](deleteProduct.php): Delete products (admin only).
- [`database.php`](database.php): Database connection settings.
- [`style.css`](style.css): Main stylesheet.
- `images/`: Product and UI images.

## Database Setup

1. Import the provided SQL file (e.g., `ebus (4).sql`) into your MySQL server to create the required tables and sample data.
2. Database connection settings are in [`database.php`](database.php). Default credentials:
    - Host: `localhost`
    - User: `root`
    - Password: *(empty)*
    - Database: `EBUS`

## Installation & Usage

1. Copy the `EBUS` folder to your XAMPP `htdocs` directory.
2. Import the SQL file into your MySQL database using phpMyAdmin or the MySQL CLI.
3. Start Apache and MySQL from the XAMPP control panel.
4. Open your browser and navigate to [http://localhost/EBUS/](http://localhost/EBUS/).

## Admin Access

- Register a new user via the registration page.
- In your database (`users` table), set the `userType` field to `1` for that user to grant admin privileges.

## Screenshots
![image](https://github.com/user-attachments/assets/d12bf291-e75d-4678-a643-3288b3f68079)

![image](https://github.com/user-attachments/assets/110bba32-80e2-4428-9157-3d91f9ff8ab4)

![image](https://github.com/user-attachments/assets/6f7e133c-2be0-478b-9d04-685a82f3cd9c)

![image](https://github.com/user-attachments/assets/6a804e70-7249-41e1-b9e1-30718dd4b9ca)

![image](https://github.com/user-attachments/assets/577af508-41c9-478a-a202-fb192b60539f)








## Contributors
- [Sameh](https://github.com/sameh625)
- [White](https://github.com/Elabyad247)
- [Tarek](https://github.com/Tarek-Mahm0ud)
