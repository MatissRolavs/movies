# Movies 🎬

An application for watching, browsing, searching, and managing movie data - built with Laravel, Tailwind, API and JavaScript.  

Explore films, view details, filter by genres, and more - all in a sleek, responsive UI.

---

## ✨ Features

- Browse a catalog of movies with details (title, description, rating, etc.)  
- Search and filter by title, genre, etc.   
- User authentication (login / registration)    
- Responsive UI for desktop and mobile  
- RESTful API to serve movie data  

---

## 🧰 Tech Stack

| Layer | Technology |
|---|---|
| Backend / Server | Laravel (PHP) |
| Frontend / UI | Vue.js, Vite, Tailwind CSS |
| Database | MySQL |
| APIs / External Data | themoviedbAPI |

---

## 🚀 Installation & Setup

1. **Clone the repository**  
    ```bash
    git clone https://github.com/MatissRolavs/movies.git
    cd movies
    ```

2. **Install backend dependencies**  
    ```bash
    composer install
    ```

3. **Install frontend dependencies**  
    ```bash
    npm install
    ```

4. **Copy environment file**  
    ```bash
    cp .env.example .env
    ```

5. **Configure `.env`**  
    Fill in database credentials. Example:
    ```text
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=movies_db
    DB_USERNAME=root
    DB_PASSWORD=secret
    ```

6. **Generate application key**  
    ```bash
    php artisan key:generate
    ```

7. **Run migrations & seeders**  
    ```bash
    php artisan migrate
    php artisan db:seed --class=RandomMovieSeeder2
    ```

8. **Build frontend / serve assets**  
    ```bash
    npm run dev
    ```

9. **Start the backend server**  
    ```bash
    php artisan serve
    ```

Browse to `http://localhost:8000` to view the app.

---
