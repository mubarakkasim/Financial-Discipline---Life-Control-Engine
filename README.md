# Financial Discipline & Life Control Engine 🚀

A high-performance, security-first personal finance application designed to engineer long-term financial discipline through behavioral AI and military-grade data protection.

![Premium Design](https://img.shields.io/badge/Design-Glassmorphism-blueviolet)
![Security](https://img.shields.io/badge/Security-AES--256--Encrypted-green)
![Framework](https://img.shields.io/badge/Framework-Laravel%2012-FF2D20)

## 🎯 Core Mission
Most finance apps just track money; this engine **controls it**. It is built for individuals who want to eliminate "lifestyle drift" and achieve aggressive savings goals through a data-driven pulse check of their financial health.

---

## 💎 Premium Features

### 1. Behavioral AI Insight Engine
- **Health Score (0-100)**: A real-time calculation based on savings consistency, spending discipline, and goal adherence.
- **Leak Detection**: Automatically identifies categories consuming more than 20% of your income.
- **Predictive Balance**: Foresees your month-end financial state based on current daily spending velocity.
- **Drift Warnings**: Alerts you if your current behavior puts your long-term goals at risk.

### 2. Military-Grade Security & Privacy
- **Encryption at Rest**: Sensitive financial data (amounts, savings, goals) are encrypted using **AES-256-CBC**. Even with database access, your raw numbers remain unreadable.
- **Audit Logging**: Every sensitive action (login shifts, data changes, unauthorized attempts) is captured in a tamper-evident security log.
- **Role-Based Access**: Multi-tier authorization logic pre-built for future scaling.

### 3. Financial Goal Locking
- **Vault System**: Create and lock savings goals (e.g., "₦500k Emergency Fund").
- **Smart Progress Tracking**: Visual progress bars with dynamic deadline calculations.
- **Dynamic Goals**: Easily adjust your targets and dates as your financial situation evolves.

### 4. Zero-Vite Architecture
- Optimized for high performance without complex frontend build steps.
- Uses a custom-engineered **Glassmorphism UI** system for a sleek, dark-mode native feel.

---

## 🛠 Tech Stack
- **Backend**: Laravel 12 (PHP 8.2+)
- **Database**: SQLite (Zero-config, fast, and secure)
- **Frontend**: Blade with Vanila CSS (Premium Custom Design System)
- **Security**: Laravel Encryption Services + custom `Auditable` Trait

---

## 🚦 Quick Start

### Installation
1. **Clone the repository**
2. **Install dependencies**:
   ```bash
   composer install
   ```
3. **Configure Environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Setup Database**:
   ```bash
   php artisan migrate
   ```

### Running Locally
```bash
php artisan serve
```
Access the application at `http://localhost:8000`.

---

## 📂 Project Structure Highlights
- `app/Services/FinancialEngine.php`: The "brain" behind the health scores and insights.
- `app/Traits/Auditable.php`: Handles automatic security logging for all financial models.
- `app/Models/`: Advanced models with encrypted casting for data protection.
- `resources/views/layout/app.blade.php`: The core premium design foundation.

---

## 🛡 Security Philosophy
"Financial data is more sensitive than social data."
This engine assumes breach attempts will happen and is built with the principle of **Least Privilege** and **Database Opacity**.

---

## 📝 License
Proprietary. Built for the disciplined.
