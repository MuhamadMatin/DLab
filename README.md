# Installation Laravel API with JWT Setup Guide

## Server Requirements

-   **PHP** >= 8.1
-   **Composer**
-   **MySQL**
-   **Laravel** = 11

## Installation Steps

## 1. Clone Repository

```bash
git clone https://github.com/MuhamadMatin/DLab.git
cd DLab
```

## 2. Install Dependencies

```bash
composer install
```

## 3. Environment Setup

```bash
# Copy .env file
cp .env.example .env

# Generate application key
php artisan key:generate
```

## 4. Configure Database

Edit **.env** file and update these lines:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

JWT_SECRET=token
JWT_ALGO=token
```

## 5. JWT Configuration

```bash
# Install JWT package
composer require php-open-source-saver/jwt-auth

# Generate JWT secret
php artisan jwt:secret
```

## 6. Run Migrations

```bash
php artisan migrate --seed
```

## 7. Start Development Server

```bash
php artisan serve
```

Server will run at **http://localhost:8000**

## Testing API

You can use tools like:

-   **Postman**
-   **Insomnia**
-   **curl**

# API

## Base URL

```

https://localhost:8000/{endpoint}

```

## Authentication

All **Users, Posts, Logout** endpoints require an **Authorization** header with a Bearer token:

```

Authorization: Bearer {your_jwt_token}

```

## Common Headers

```

Accept: application/json

```

## Endpoints

### Authentication

All header use Accept: application/json

1.  Login

    ```http
    POST /api/login
    ```

    -   Description: Authenticate user and return a JWT token.
    -   Request Body:
        1. email (string) : User email.
        2. password (string) : User password.
    -   Response:

    ```json
    {
        "status": true,
        "message": "Login successfully",
        "token": "string",
        "user": {}
    }
    ```

2.  Register

    ```http
    POST /api/register
    ```

    -   Description: Register a new user.
    -   Request Body:
        1. name (string) : User name.
        2. age (muneric) : User age.
        3. email (string) : User email.
        4. password (string) : User password.
    -   Response:

    ```json
    {
        "status": true,
        "message": "Register account success, login please"
    }
    ```

3.  Logout
    ```http
    POST /api/logout
    ```
    -   Description: Log out the authenticated user by invalidating their token.
    -   Headers:
        Authorization: Bearer {token}
    -   Response:
    ```json
    {
        "status": true,
        "message": "Logout successfully"
    }
    ```

### User Management

4. Get All Users

    ```http
    GET /api/users
    ```

    - Description: List of all users.
    - Headers:
      Authorization: Bearer {token}
    - Response:

    ```json
    {
        "status": true,
        "users": {}
    }
    ```

5. Get User by ID

    ```http
    GET /api/users/{id}
    ```

    - Description: Retrieve details of a specific user.
    - Headers:
      Authorization: Bearer {token}
    - Response:

    ```json
    {
        "status": true,
        "users": {}
    }
    ```

6. Create User

    ```http
    POST /api/users/{id}
    ```

    - Description: Create a new user.
    - Headers:
      Authorization: Bearer {token}
    - Request Body:
        1. name (string) : User name.
        2. age (numeric) : User age.
        3. email (string) : User email.
        4. password (string) : User password.
    - Response:

    ```json
    {
        "status": true,
        "message": "Users create success"
    }
    ```

7. Update User

    ```http
    PUT /api/users/{id}
    ```

    - Description: Update an existing user's information.
    - Headers:
      Authorization: Bearer {token}
    - Request Body:

    1. name (string) : User name.
    2. age (numeric) : User age.
    3. email (string) : User email.

    - Sometimes Body:

    1. password (string) : User password.

    - Response:

    ```json
    {
        "status": true,
        "message": "Users create success",
        "data": {}
    }
    ```

8. Delete User

    ```http
    DELETE /api/users/{id}
    ```

    - Description: Delete a user by ID.
    - Headers:
      Authorization: Bearer {token}
    - Response:

    ```json
    {
        "status": true,
        "message": "User delete success"
    }
    ```

### Post Management

9. Get All Posts

    ```http
    GET /api/posts
    ```

    - Description: Retrieve a list of all posts.
    - Headers:
      Authorization: Bearer {token}
    - Response:

    ```json
    {
        "status": true,
        "posts": {}
    }
    ```

10. Get Post by ID
    ```http
    GET /api/posts/{id}
    ```
    - Description: Retrieve details of a specific post.
    - Headers:
      Authorization: Bearer {token}
    - Response:
    ```json
    {
        "status": true,
        "posts": {}
    }
    ```
11. Create Post

    ```http
    POST /api/posts
    ```

    - Description: Create a new post.
    - Headers:
      Authorization: Bearer {token}
    - Request Body:

    1. title (string) : Name or title post.
    2. body (string) : Content post.
    3. user_id (numeric) : User id.

    - Response:

    ```json
    {
        "status": true,
        "message": "Posts create success",
        "posts": {}
    }
    ```

12. Update Post

    ```http
    PUT /api/posts/{id}
    ```

    - Description: Update an existing post's information.
    - Headers:
      Authorization: Bearer {token}
    - Request Body:

    1. title (string) : Name or title post.
    2. body (string) : Content post.
    3. user_id (numeric) : User id.

    - Response:

    ```json
    {
        "status": true,
        "message": "Post update success",
        "posts": {}
    }
    ```

13. Delete Post

    ```http
    DELETE /api/posts/{id}
    ```

    - Description: Delete a post by ID.
    - Headers:
      Authorization: Bearer {token}
    - Response:

    ```json
    {
        "status": true,
        "message": "Post delete success"
    }
    ```

## Error Handling

The API returns appropriate HTTP status codes along with error messages:

-   **200**: Success
-   **201**: Created
-   **400**: Bad Request
-   **401**: Unauthorized
-   **403**: Forbidden
-   **404**: Not Found
-   **500**: Internal Server Error
