# Cahaya Ad Din Registration System - Setup Guide

## Prerequisites
- **Docker Desktop** installed and running.
- **Git**.

## Installation

1. **Clone the repository** (if you haven't already):
   ```bash
   git clone <repository-url>
   cd cahaya-ad-din
   ```

2. **Start the Application**:
   Since we use Laravel Sail (Docker), you don't need PHP installed locally.
   ```bash
   ./vendor/bin/sail up -d
   ```
   *Note: The first time you run this, it may take a few minutes to build the Docker images.*

3. **Install Dependencies**:
   ```bash
   ./vendor/bin/sail composer install
   ./vendor/bin/sail npm install
   ```

4. **Environment Setup**:
   ```bash
   cp .env.example .env
   ./vendor/bin/sail artisan key:generate
   ```

5. **Database Migration**:
   Create the tables in the database:
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

6. **Build Frontend Assets**:
   ```bash
   ./vendor/bin/sail npm run build
   ```

## Usage

- **Access the Site**: Open [http://localhost](http://localhost) in your browser.
- **Mailpit (Emails)**: Open [http://localhost:8025](http://localhost:8025).

## Common Commands

- **Stop the server**:
  ```bash
  ./vendor/bin/sail stop
  ```
- **Run Tests**:
  ```bash
  ./vendor/bin/sail test
  ```
- **Access Container Shell**:
  ```bash
  ./vendor/bin/sail shell
  ```
