# MediTrack - Clinic Management System

**Slogan:** "Your clinic, organized and at your fingertips."

MediTrack is a comprehensive clinic management system built with Laravel and Tailwind CSS. It provides all the essential features needed to manage a medical clinic efficiently.

## Features

### 🏥 Core Functionality
- **Patient Management** - Complete patient records with contact information, medical history, and notes
- **Appointment Scheduling** - Schedule, manage, and track patient appointments with doctors
- **Billing & Invoicing** - Generate invoices, track payments, and manage outstanding bills
- **Inventory Management** - Track medical supplies, medications, and equipment
- **Staff Management** - Manage doctors, nurses, and administrative staff with role-based access

### 📊 Dashboard
- Real-time statistics and metrics
- Recent patient activity
- Appointment overview
- Billing status

### 🔐 User Management
- Role-based access control (Admin, Doctor, Nurse, Receptionist)
- Secure authentication with Laravel Breeze
- User profiles with specializations

## Technology Stack

- **Backend:** PHP 8.1+ with Laravel 11
- **Frontend:** Blade Templates with Tailwind CSS
- **Database:** SQLite (development) / MySQL (production)
- **Authentication:** Laravel Breeze
- **Styling:** Tailwind CSS with custom brand colors

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd MediTrack
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Build assets**
   ```bash
   npm run build
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

## Default Login Credentials

The system comes with pre-seeded users:

- **Admin:** sarah.williams@meditrack.com / password
- **Doctor:** michael.brown@meditrack.com / password
- **Nurse:** jennifer.wilson@meditrack.com / password
- **Receptionist:** lisa.johnson@meditrack.com / password

## Sample Data

The system includes sample data:
- 5 sample patients with complete information
- 5 staff members with different roles
- Ready-to-use appointment and billing data

## Features Overview

### Patient Management
- Add, edit, and view patient information
- Track medical history and notes
- Emergency contact information
- Complete address and contact details

### Appointment System
- Schedule appointments with specific doctors
- Track appointment status (scheduled, confirmed, completed, etc.)
- Add diagnosis and treatment notes
- Fee tracking per appointment

### Billing & Invoicing
- Generate professional invoices
- Track payment status
- Multiple invoice items support
- Tax calculation
- PDF-ready invoice format

### Inventory Management
- Track medical supplies and equipment
- Low stock alerts
- Expiry date monitoring
- Supplier information
- Category-based organization

### Staff Management
- Role-based user accounts
- Specialization tracking
- Contact information
- Secure password management

## Customization

### Brand Colors
The system uses custom brand colors defined in `resources/css/app.css`:
- Primary: #B54C3D
- Dark: #7A2F25
- Accent: #D36B5B

### Logo
Replace `public/brand/logo.png` with your clinic's logo.

## Requirements

- PHP 8.1 or higher
- Composer
- Node.js and NPM
- SQLite or MySQL
- Web server (Apache/Nginx) or Laravel's built-in server

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support and questions, please contact the development team or create an issue in the repository.
