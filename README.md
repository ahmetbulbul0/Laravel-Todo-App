# Todo-App-Laravel-VueJs

A functional and well-structured Todo application built with Laravel for the backend and Vue.js for the frontend. This application provides a comprehensive system for managing tasks, including user authentication and CRUD operations for todos.

Key Features:

- User Registration and Login: Secure user authentication system to manage individual user sessions.
- Todo Management:
  - List all todos in a clean and organized view.
  - Mark todos as completed or incomplete with a simple toggle.
  - Add new todos, edit existing ones, or delete unwanted tasks.
- Backend:
  - Built with Laravel using a RESTful API to handle all server-side operations efficiently.
- Frontend:
  - Developed with Vue.js for a dynamic and interactive user interface.
  - Consistent design with a modern dark theme for an appealing look.
- Responsive: Not optimized for mobile devices but designed for desktop use.

This project is ideal for showcasing CRUD operations, RESTful API integration, and a seamless connection between the Laravel backend and Vue.js frontend.

## Technologies (languages & frameworks)

- Html
- Css
- JavaScript
- Php
- VueJs
- Laravel
- MySql

## Packages & Libraries

- Sanctum
- Vue-Loader
- Vue-Router
- Vuex
- Vuex-Persistedstate

## Setup

1. Install Php Packages
```sh
composer install
```
2. Create .env File
```sh
1. duplicate the ".env.example" in main folder
2. rename the file you copied to ".env"
3. configure the ".env" file you renamed
```
3. Create App Key
```sh
php artisan key:generate
```
4. Run Migrations
```sh
php artisan migrate
```
5. Run Seeders (For Test Datas)
```sh
php artisan db:seed
```
6. Run Admin Seeder (For Admin User)
```sh
php artisan db:seed --class=AdminSeeder
```
7. Run Laravel Project
```sh
php artisan serve
```
8. Install JavaScript Packages
```sh
npm install
```
9.  Run VueJs Project
```sh
npm run dev
```

## Essential Terminal Commands

- Type-Check, Compile and Minify for Production (for VuejS)

```sh
npm run build
```

## Pages

- Home [localhost:8000/](http://localhost:8000/)
- Login [localhost:8000/login](http://localhost:8000/login)
- Register [localhost:8000/register](http://localhost:8000/register)
- Dashboard [localhost:8000/dashboard](http://localhost:8000/dashboard)
- New Item [localhost:8000/dashboard/create](http://localhost:8000/dashboard/create)
- Home [localhost:8000/](http://localhost:8000/)
- Register [localhost:8000/register](http://localhost:8000/register)
- Login [localhost:8000/login](http://localhost:8000/login)
- Log Out [localhost:8000/log-out](http://localhost:8000/log-out) 
- My Todo's [localhost:8000/my-todos](http://localhost:8000/my-todos)
- All Todo's [localhost:8000/all-todos](http://localhost:8000/all-todos)
- New Todo [localhost:8000/new-todo](http://localhost:8000/new-todo)
- Todo Detail [localhost:8000/todo-detail/{todoId}](http://localhost:8000/todo-detail/{todoId})
- Complete Todo [localhost:8000/is-complete/{todoId}](http://localhost:8000/is-complete/{todoId})
- Edit Todo [localhost:8000/todo-edit/{todoId}](http://localhost:8000/todo-edit/{todoId})
- Delete Todo [localhost:8000/todo-delete/{todoId}](http://localhost:8000/todo-delete/{todoId})

## Endpoints

- Login [localhost:8000/api/login](http://localhost:8000/api/login) Method: POST
- Register [localhost:8000/api/register](http://localhost:8000/api/register) Method: POST
- Todo's [localhost:8000/api/todos](http://localhost:8000/api/todos) Method: GET
- Todo Detail [localhost:8000/api/todos/{todoId}](http://localhost:8000/api/todos/{todoId}) Method: GET
- Todo Create [localhost:8000/api/todos](http://localhost:8000/api/todos) Method: POST
- Todo Update [localhost:8000/api/todos/{todoId}](http://localhost:8000/api/todos/{todoId}) Method: PUT|PATCH
- Todo Delete [localhost:8000/api/todos/{todoId}](http://localhost:8000/api/todos/{todoId}) Method: DELETE
- User's [localhost:8000/api/user](http://localhost:8000/api/user) Method: GET
- User Detail [localhost:8000/api/user/{userId}](http://localhost:8000/api/user/{userId}) Method: GET
- User Create [localhost:8000/api/user](http://localhost:8000/api/user) Method: POST
- User Update [localhost:8000/api/user/{userId}](http://localhost:8000/api/user/{userId}) Method: PUT|PATCH
- User Delete [localhost:8000/api/user/{userId}](http://localhost:8000/api/user/{userId}) Method: DELETE
