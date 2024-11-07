# API

## Endpoints

### Authentication

All header use Accept: application/json

1. Login
   Endpoint: /api/login
   Method: POST
   Description: Authenticate user and return a JWT token.
   Request Body:
   email (string) : User email.
   password (string) : User password.
   Response:
   status (boolean) : True.
   message (string) : Login successfully.
   token (string) : JWT token for authentication.
   user (object) : Authenticated user's details.
2. Register
   Endpoint: /api/register
   Method: POST
   Description: Register a new user.
   Request Body:
   name (string) : User name.
   age (muneric) : User age.
   email (string) : User email.
   password (string) : User password.
   Response:
   status (boolean) : True.
   message (string) : Register account success, login please.
3. Logout
   Endpoint: /api/logout
   Method: POST
   Description: Log out the authenticated user by invalidating their token.
   Headers:
   Authorization: Bearer {token}
   Response:
   status (boolean) : True.
   message (string) : Logout successfully.

### User Management

4. Get All Users
   Endpoint: /api/users
   Method: GET
   Description: List of all users.
   Headers:
   Authorization: Bearer {token}
   Response:
   status (boolean) : True.
   users (object) : Object users.
5. Get User by ID
   Endpoint: /api/users/{id}
   Method: GET
   Description: Retrieve details of a specific user.
   Headers:
   Authorization: Bearer {token}
   Response:
   status (boolean) : True.
   users (object) : Object user with the specified ID.
6. Create User
   Endpoint: /api/users
   Method: POST
   Description: Create a new user.
   Headers:
   Authorization: Bearer {token}
   Request Body:
   name (string) : User name.
   age (numeric) : User age.
   email (string) : User email.
   password (string) : User password.
   Response:
   status (boolean) : True.
   message (string) : Users create success.
7. Update User
   Endpoint: /api/users/{id}
   Method: PUT
   Description: Update an existing user's information.
   Headers:
   Authorization: Bearer {token}
   Request Body:
   name (string) : User name.
   age (numeric) : User age.
   email (string) : User email.
   Sometimes Body:
   password (string) : User password.
   Response:
   status (boolean) : True.
   message (string) : User Update success.
   data (object) : Object user.
8. Delete User
   Endpoint: /api/users/{id}
   Method: DELETE
   Description: Delete a user by ID.
   Headers:
   Authorization: Bearer {token}
   Response:
   status (boolean) : True.
   message (string) : User delete success.

### Post Management

9. Get All Posts
   Endpoint: /api/posts
   Method: GET
   Description: Retrieve a list of all posts.
   Headers:
   Authorization: Bearer {token}
   Response:
   status (boolean) : True.
   posts (object) : Object posts.
10. Get Post by ID
    Endpoint: /api/posts/{id}
    Method: GET
    Description: Retrieve details of a specific post.
    Headers:
    Authorization: Bearer {token}
    Response:
    status (boolean) : True.
    posts (object) : Object post with the specified ID.
11. Create Post
    Endpoint: /api/posts
    Method: POST
    Description: Create a new post.
    Headers:
    Authorization: Bearer {token}
    Request Body:
    title (string) : Name or title post.
    body (string) : Content post.
    user_id (numeric) : User id.
    Response:
    status (boolean) : True.
    message (string) : Posts create success.
    data (object) : Post object.
12. Update Post
    Endpoint: /api/posts/{id}
    Method: PUT
    Description: Update an existing post's information.
    Headers:
    Authorization: Bearer {token}
    Request Body:
    title (string) : Name or title post.
    body (string) : Content post.
    user_id (numeric) : User id.
    Response:
    status (boolean) : True.
    message (string) : Post update success.
    data (object) : Post object.
13. Delete Post
    Endpoint: /api/posts/{id}
    Method: DELETE
    Description: Delete a post by ID.
    Headers:
    Authorization: Bearer {token}
    Response:
    status (boolean) : True.
    message (string) : Post delete success.
