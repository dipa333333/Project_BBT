# 💧 Smart Meter Water Monitoring System

A web-based **Smart Meter Water Monitoring System** designed to monitor water usage and provide structured information about water flow, total volume, sensor status, and monitoring data through a centralized dashboard.

The system is built using **Laravel** as the backend framework with a modern frontend stack consisting of **Vite, Tailwind CSS, and Alpine.js**.

> This project was developed as part of a project-based development process to implement a web-based monitoring system for water meter data.

---

## 📌 Table of Contents

* [Overview](#-overview)
* [Problem Statement](#-problem-statement)
* [Project Objectives](#-project-objectives)
* [Key Features](#-key-features)
* [System Workflow](#-system-workflow)
* [Technology Stack](#-technology-stack)
* [Project Structure](#-project-structure)
* [Database](#-database)
* [Installation](#-installation)
* [Environment Configuration](#-environment-configuration)
* [Running the Application](#-running-the-application)
* [Testing](#-testing)
* [Development Notes](#-development-notes)
* [Future Improvements](#-future-improvements)
* [Project Information](#-project-information)
* [License](#-license)

---

## 🔎 Overview

**Smart Meter Water Monitoring System** is a web application for managing and monitoring water meter data.

The application provides a centralized interface where monitoring-related information can be stored and managed through a Laravel-based backend. The project includes data models and database structures for:

* Water sensors
* Monitoring records
* Flow rate
* Total water volume
* Sensor status
* Notifications
* Application settings
* User accounts and roles

The monitoring data structure was extended to support **flow rate** and **total volume**, allowing the system to represent water usage data in a more meaningful way.

---

## ❗ Problem Statement

Traditional water meter monitoring can require manual observation and recording of meter readings.

This approach can make it difficult to:

* Monitor water usage continuously
* Organize historical monitoring data
* Identify sensor conditions
* Present monitoring information in a centralized interface
* Manage notifications related to monitoring conditions

This project explores a web-based approach to make water meter monitoring more structured and accessible.

---

## 🎯 Project Objectives

The main objectives of this project are:

1. Build a web-based platform for water meter monitoring.
2. Store monitoring data in a structured database.
3. Manage sensor information and sensor status.
4. Record water flow rate and total water volume.
5. Provide a foundation for notification and monitoring management.
6. Provide an organized interface for users to interact with monitoring information.
7. Apply a modern MVC-based web application architecture using Laravel.

---

## ✨ Key Features

### 📊 Water Monitoring

The system provides a structure for storing and managing water monitoring data.

Monitoring records support information such as:

* Flow rate
* Total water volume
* Monitoring data
* Associated sensor information

---

### 📡 Sensor Management

The application provides sensor-related data management.

Each sensor can have information related to its status and monitoring relationship.

The project includes a dedicated `Sensor` model and database table.

---

### 📈 Flow Rate & Total Volume

Monitoring data supports:

* **Flow Rate** — representing the rate at which water flows.
* **Total Volume** — representing accumulated water volume.

These fields were added to the monitoring database structure to provide more useful water usage information.

---

### 🔔 Notification Management

The application contains a dedicated notification model and database structure for handling monitoring-related notifications.

This provides a foundation for informing users when certain monitoring conditions require attention.

---

### ⚙️ System Settings

The project includes a dedicated settings model and database table, allowing application-related configuration to be managed separately from monitoring data.

---

### 👤 User & Role Management

The application uses Laravel's user authentication structure and includes support for user roles.

This allows different types of users to potentially have different access levels within the application.

---

## 🔄 System Workflow

The general workflow of the application can be represented as follows:

```text
                    ┌──────────────────┐
                    │   Water Sensor   │
                    └────────┬─────────┘
                             │
                             │ Monitoring Data
                             ▼
                    ┌──────────────────┐
                    │ Laravel Backend  │
                    │   Application    │
                    └────────┬─────────┘
                             │
                ┌────────────┼────────────┐
                │            │            │
                ▼            ▼            ▼
           Sensor Data   Monitoring   Notification
                │            │            │
                └────────────┼────────────┘
                             │
                             ▼
                    ┌──────────────────┐
                    │     Database     │
                    └────────┬─────────┘
                             │
                             ▼
                    ┌──────────────────┐
                    │ Web Dashboard /  │
                    │ Monitoring UI    │
                    └──────────────────┘
```

### Basic Data Flow

1. A water sensor provides monitoring-related information.
2. The application processes and stores the information.
3. Monitoring records are stored in the database.
4. Sensor status and monitoring information can be managed through the application.
5. Notification data can be stored for monitoring-related events.
6. Users access the information through the web interface.

---

## 🛠️ Technology Stack

| Technology         | Purpose                          |
| ------------------ | -------------------------------- |
| **PHP 8.2+**       | Backend programming language     |
| **Laravel 12**     | Web application framework        |
| **MySQL / SQLite** | Database support                 |
| **Vite**           | Frontend asset bundling          |
| **Tailwind CSS**   | UI styling                       |
| **Alpine.js**      | Frontend interactions            |
| **Axios**          | HTTP requests                    |
| **Composer**       | PHP dependency management        |
| **NPM**            | JavaScript dependency management |
| **PHPUnit**        | Application testing              |
| **Git & GitHub**   | Version control                  |

The project's `composer.json` specifies PHP `^8.2` and Laravel `^12.0`. The frontend uses Vite, Tailwind CSS, Alpine.js, Axios, and related development tooling.

---

## 📁 Project Structure

The project follows the standard Laravel application structure.

```text
Project_BBT/
│
├── app/
│   ├── Http/
│   ├── Models/
│   │   ├── Monitoring.php
│   │   ├── Notifikasi.php
│   │   ├── Sensor.php
│   │   ├── Setting.php
│   │   └── User.php
│   └── Providers/
│
├── bootstrap/
│
├── config/
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── public/
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│
├── routes/
│
├── storage/
│
├── tests/
│
├── .env.example
├── artisan
├── composer.json
├── package.json
├── phpunit.xml
├── tailwind.config.js
└── vite.config.js
```

The repository currently separates application logic, models, database migrations, frontend resources, routes, storage, and tests according to the Laravel project structure.

---

## 🗄️ Database

The application uses Laravel migrations to manage its database schema.

The project contains migration tables for:

* Users
* Cache
* Jobs
* Sensors
* Notifications
* Monitorings
* Settings
* User roles

The monitoring table was subsequently extended with:

* `flowrate`
* `totalvolume`

This allows monitoring records to store more detailed water usage information.

### Main Data Entities

```text
User
 │
 ├── Role
 │
 └── Application Access
       
Sensor
 │
 └── Monitoring
       ├── Flow Rate
       └── Total Volume

Monitoring
 │
 └── Notification

Setting
 └── System Configuration
```

---

# 🚀 Installation

## 1. Clone the Repository

```bash
git clone https://github.com/dipa333333/Project_BBT.git
```

Move into the project directory:

```bash
cd Project_BBT
```

---

## 2. Install PHP Dependencies

Make sure **PHP 8.2 or newer** and **Composer** are installed.

Then run:

```bash
composer install
```

---

## 3. Install Frontend Dependencies

Install the required Node.js packages:

```bash
npm install
```

---

## 4. Create Environment File

Copy the example environment configuration:

```bash
cp .env.example .env
```

On Windows PowerShell:

```powershell
copy .env.example .env
```

---

## 5. Generate Application Key

```bash
php artisan key:generate
```

---

## 6. Configure Database

Open the `.env` file and configure your database connection.

Example:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smart_meter
DB_USERNAME=root
DB_PASSWORD=
```

Make sure the database has already been created before running the migrations.

---

## 7. Run Database Migration

```bash
php artisan migrate
```

If the project requires seed data:

```bash
php artisan db:seed
```

---

# ▶️ Running the Application

## Development Server

Start the Laravel development server:

```bash
php artisan serve
```

The application will normally be accessible at:

```text
http://127.0.0.1:8000
```

In another terminal, start the Vite development server:

```bash
npm run dev
```

---

## Alternative: Laravel Development Script

The project also defines a Composer development script that can run the Laravel server, queue listener, logs, and Vite development server together.

Run:

```bash
composer run dev
```

This behavior is defined in the project's Composer configuration.

---

# 🧪 Testing

The project includes PHPUnit/Laravel testing support.

Run the test suite using:

```bash
php artisan test
```

Or:

```bash
composer run test
```

The project configuration includes PHPUnit 11 and a Composer test script that executes Laravel's test suite.

---

# 🏗️ Development Notes

This project follows the **Model-View-Controller (MVC)** architecture provided by Laravel.

### Model

Models represent application entities and their relationships with the database.

Current monitoring-related models include:

* `Sensor`
* `Monitoring`
* `Notifikasi`
* `Setting`
* `User`

### View

The user interface is organized under:

```text
resources/views/
```

Frontend assets are organized under:

```text
resources/css/
resources/js/
```

### Controller / HTTP Layer

Application request handling is organized through Laravel's HTTP layer under:

```text
app/Http/
```

### Database

Database schema changes are managed through Laravel migrations:

```text
database/migrations/
```

This approach makes database changes reproducible across development environments.

---

# 🔮 Future Improvements

Several improvements can be considered for future development:

* [ ] Real-time sensor data integration
* [ ] Real-time dashboard updates
* [ ] Historical water usage charts
* [ ] More detailed consumption analytics
* [ ] Automatic abnormal-usage detection
* [ ] Configurable notification thresholds
* [ ] Email or messaging notifications
* [ ] Export monitoring data to CSV/PDF
* [ ] More granular user permissions
* [ ] API integration for external IoT devices
* [ ] Improved automated testing coverage
* [ ] Deployment to a production server
* [ ] Mobile-friendly monitoring interface

---

# 📷 Screenshots

Add application screenshots here to make the repository easier to understand.

Example:

```markdown
## Dashboard

![Dashboard](docs/images/dashboard.png)

## Monitoring

![Monitoring](docs/images/monitoring.png)

## Sensor Management

![Sensor Management](docs/images/sensor-management.png)
```

> **Recommended:** Add screenshots of the main dashboard, monitoring page, sensor page, and notification interface. This is especially useful when this repository is used as a portfolio project.

---

# 📌 Project Information

**Project:** Smart Meter Water Monitoring System

**Repository:** [Project_BBT](https://github.com/dipa333333/Project_BBT)

**Type:** Web-based Monitoring System

**Architecture:** MVC

**Backend:** Laravel / PHP

**Frontend:** Vite / Tailwind CSS / Alpine.js

**Database:** Relational Database

**Version Control:** Git / GitHub

---

# 👨‍💻 Developer

**Dipa AA**

GitHub: [@dipa333333](https://github.com/dipa333333)

---

# 📄 License

This project is licensed under the **MIT License** unless otherwise specified.

---

## ⭐ Project Purpose

This repository serves as both a functional web application project and a learning/portfolio project demonstrating the implementation of a Laravel-based monitoring system with structured database management, frontend asset tooling, authentication/user management, sensor management, and water monitoring data.

If you find this project useful or interesting, feel free to explore the repository and its development history.
