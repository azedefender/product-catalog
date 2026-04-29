
# Каталог товаров (Product Catalog)

Тестовое задание для позиции **Junior Full-Stack Developer (Laravel + Vue.js)**.  
Простое веб-приложение с публичным каталогом товаров, фильтрацией по категориям и административной панелью.

![PHP 8.2+](https://img.shields.io/badge/PHP-8.2%2B-blue)
![Laravel 12](https://img.shields.io/badge/Laravel-12-red)
![Vue 3](https://img.shields.io/badge/Vue-3-green)
![Inertia](https://img.shields.io/badge/Inertia.js-1.x-9553e9)

---

## Функциональность

- Публичный каталог товаров с бесконечной пагинацией.
- Фильтрация товаров по категории (AJAX-запрос без перезагрузки).
- Страница отдельного товара с подробностями.
- Административная панель (доступ только после входа):
  - Управление товарами: создание, редактирование, удаление.
  - Форма создания/редактирования с выбором категории.
  - Удаление с предварительным подтверждением.
- Простая аутентификация по токену (Sanctum) с предустановленным пользователем.

---

## Стек технологий

### Бэкенд
- **Laravel 12** (PHP 8.2+)
- **RESTful API** с использованием API Resources и Form Requests
- **Аутентификация:** Laravel Sanctum (токены)
- **База данных:** PostgreSQL (или SQLite для локальной разработки)
- **Мягкое удаление (Soft Deletes)** для товаров

### Фронтенд
- **Vue 3** (Composition API)
- **InertiaJS** (связь без API-роутов на фронте)
- **Tailwind CSS** (стилизация)
- **Vite** (сборка)

### Дополнительно (бонус)
- Docker Compose для быстрого развёртывания.
- Сидеры для наполнения тестовыми данными.
- Базовые feature-тесты API.

---

## Установка и запуск

### Предварительные требования
- PHP 8.2 или выше (с расширениями `curl`, `openssl`, `mbstring`, `sqlite`, `pdo_pgsql` — если используется PostgreSQL).
- Composer (рекомендуется глобальная установка).
- Node.js 18+ и npm.
- PostgreSQL (или SQLite для упрощённого запуска).

### Клонирование репозитория
```bash
git clone https://github.com/твой-логин/твой-репо.git product-catalog
cd product-catalog
```

### Настройка окружения
Создайте файл `.env` из примера:
```bash
cp .env.example .env
```
В `.env` укажите подключение к базе данных. По умолчанию используется **SQLite**:
```
DB_CONNECTION=sqlite
```
Для PostgreSQL:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=product_catalog
DB_USERNAME=postgres
DB_PASSWORD=secret
```

### Установка зависимостей
```bash
composer install
npm install
```

### Подготовка базы данных и наполнение
Сгенерируйте ключ приложения, выполните миграции и загрузку тестовых данных:
```bash
php artisan key:generate
php artisan migrate --seed
```

Данные для входа администратора:
- **Email:** `admin@mail.com`
- **Пароль:** `password`

### Сборка фронтенда
```bash
npm run build   # production
# или
npm run dev     # разработка с горячей перезагрузкой
```

### Запуск сервера
```bash
php artisan serve
```
Приложение доступно по адресу [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## Запуск через Docker (бонус)

Убедитесь, что в корне проекта есть `docker-compose.yml` и `Dockerfile`.  
Запуск контейнеров:
```bash
docker-compose up -d
```
Примените миграции внутри контейнера:
```bash
docker-compose exec app php artisan migrate --seed
```
Приложение будет доступно на [http://localhost:8000](http://localhost:8000).

---

## Структура проекта

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/           # REST API контроллеры
│   │   │   ├── Admin/         # Административные Inertia-контроллеры
│   │   │   └── Auth/          # Контроллеры аутентификации
│   │   ├── Middleware/        # HandleInertiaRequests
│   │   ├── Requests/          # Form Requests (валидация)
│   │   └── Resources/         # API Resources
│   └── Models/                # Eloquent модели (Product, Category, User)
├── database/
│   ├── factories/             # Фабрики для тестовых данных
│   ├── migrations/            # Миграции таблиц
│   └── seeders/               # Database Seeder
├── resources/
│   └── js/                    # Vue 3 + Inertia фронтенд
│       ├── Composables/       # useAuth, useProductApi
│       ├── Layouts/           # AppLayout, AdminLayout
│       └── Pages/             # Компоненты страниц
├── routes/
│   ├── api.php                # API маршруты
│   └── web.php                # Web маршруты (Inertia)
├── tests/
│   └── Feature/               # Тесты API (ProductApiTest)
└── docker-compose.yml         # Docker окружение
```

---

## Тесты

Для запуска тестов выполните:
```bash
php artisan test
```

---

## Задание

Реализовано согласно [Тестовому заданию для Junior Full-Stack Developer (Laravel + Vue.js)](#).  
Включает все базовые требования и несколько бонусных пунктов:
- Soft Deletes
- Сидеры и фабрики
- Docker Compose
- Тесты API
- Подтверждение удаления (модальное окно на фронте)
- Debounce для поля поиска (опционально)


Проект выполнен в рамках тестового задания и не предназначен для коммерческого использования.
