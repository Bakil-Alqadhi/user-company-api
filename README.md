# user-company-api

Welcome to the Project user-company-api!

## Prerequisites

Make sure you have the following installed before proceeding:

- [PHP](https://www.php.net/) = 8.1
- [Composer](https://getcomposer.org/)
=======
# user-company API Documentation

## Table of Contents
- [Setup](#setup)
- [API Endpoints](#api-endpoints)
  - [Users](#users)
  - [Companies](#companies)
  - [Comments](#comments)

### Setup
1. Clone the repository: https://github.com/Bakil-Alqadhi/user-company-api.git
2. Navigate to the project directory: cd user-company-api
3. Install PHP dependencies: composer install
4. Configuration:
- Copy the Environment  Copy the .env.example file to .env 
- Update the `.env` file with your database credentials and other configuration options.
5. Run Migrations: php artisan migrate
6. Run the Development Server: php artisan serve
Access your application in your browser at http://localhost:8000 (or the specified port).

## API Endpoints
### Users
- Create a User
    - Endpoint: POST api/v1/users
    - Request:
        - body{
                "first_name": string,
                "last_name": string,
                "phone_number": string,
                "avatar": (image file в форматах PNG и JPG, с максимальным размером файла 2 МБ)
            }
    - Response: 
        - body {
                "data": {
                    "id": int,
                    "first_name": string,
                    "last_name": stirng,
                    "phone_number": string,
                    "avatar": string,
                }
            }
        - Headers: StatusCode
        
- Get a List of Users
    - Endpoint: GET api/v1/users
    - Response: 
        - body{   
                "data": {
                    "current_page": int,
                    "data": [
                        {
                            "id": int,
                            "first_name": string,
                            "last_name": string,
                            "phone_number": string,
                            "avatar": string,
                            "created_at": stirng,
                            "updated_at": string
                        },
                    ],
                    "first_page_url": string,
                    "from": int,
                    "last_page": int,
                    "last_page_url": string,
                    "links": [
                        {
                            "url": null,
                            "label": "&laquo; Previous",
                            "active": false
                        },
                        {
                            "url": string,
                            "label": number(string),
                            "active": boolean
                        },
                        {
                            "url": string,
                            "label": "Next &raquo;",
                            "active": boolean
                        }
                    ],
                    "next_page_url": string,
                    "path": string,
                    "per_page": int,
                    "prev_page_url": boolean,
                    "to": int,
                    "total": int
                }
            }
        - Headers: StatusCode
- Get user by Id
    - Endpoint: GET /api/v1/users/{id} 
    - Params { id: string; }
    - Response: 
        - body {
                "data": {
                    "id": int,
                    "first_name": string,
                    "last_name": stirng,
                    "phone_number": string,
                    "avatar": string,
                }
            }
        - Headers: StatusCode
- Update user by Id
    - Endpoint: PUT/PATCH /api/v1/users/{id} 
    - Params { id: string; }
    - Request:
        - body{
                "first_name": string,
                "last_name": string,
                "phone_number": string,
                "avatar": (image file в форматах PNG и JPG, с максимальным размером файла 2 МБ)
            }
    - Response: 
        - body {
                "message": "User's data updated successfully",
                "data": {
                    "id": int,
                    "first_name": string,
                    "last_name": stirng,
                    "phone_number": string,
                    "avatar": string,
                }
            }
        - Headers: StatusCode
- Delete user by Id
    - Endpoint: DELETE /api/v1/users/{id} 
    - Params { id: string; }
    - Response: 
        - body {
                "message" : "User deleted successfully"
            }
        - Headers: StatusCode

### Companies
- Create a Company
    - Endpoint: POST api/v1/copmanies
    - Request:
        - body{
                "name": string,
                "description": string,
                "logo": (image file в формате PNG, с максимальным размером файла 3 МБ)
            }
    - Response: 
        - body {
                "data": {
                    "id": int,
                    "name": string,
                    "description": stirng,
                    "logo": string,
                    "updated_at": string,
                    "created_at": string
                }
            }
        - Headers: StatusCode
        
- Get a List of Companies
    - Endpoint: GET api/v1/companies
    - Response: 
        - body{   
                "data": {
                    "current_page": int,
                    "data": [
                        {
                            "id": int,
                            "name": string,
                            "description": stirng,
                            "logo": string,
                            "updated_at": string,
                            "created_at": string
                        },
                    ],
                    "first_page_url": string,
                    "from": int,
                    "last_page": int,
                    "last_page_url": string,
                    "links": [
                        {
                            "url": null,
                            "label": "&laquo; Previous",
                            "active": false
                        },
                        {
                            "url": string,
                            "label": number(string),
                            "active": boolean
                        },
                        {
                            "url": string,
                            "label": "Next &raquo;",
                            "active": boolean
                        }
                    ],
                    "next_page_url": string,
                    "path": string,
                    "per_page": int,
                    "prev_page_url": boolean,
                    "to": int,
                    "total": int
                }
            }
        - Headers: StatusCode
- Get company by Id
    - Endpoint: GET /api/v1/companies/{id} 
    - Params { id: string; }
    - Response: 
        - body {
                "data": {
                    "id": int,
                    "name": string,
                    "description": stirng,
                    "logo": string,
                }
            }
        - Headers: StatusCode
- Update company by Id
    - Endpoint: PUT/PATCH /api/v1/companies/{id} 
    - Params { id: string; }
    - Request:
        - body{
                "name": string,
                "description": string,
                "logo": (image file в формате PNG, с максимальным размером файла 3 МБ)
            }
    - Response: 
        - body {
                "message": "Company updated successfully",
                "data": {
                    "id": int,
                    "name": string,
                    "description": stirng,
                    "logo": string,
                }
            }
        - Headers: StatusCode

- Delete company by Id
    - Endpoint: DELETE /api/v1/companies/{id} 
    - Params { id: string; }
    - Response: 
        - body {
                "message" : "Company deleted successfully"
            }
        - Headers: StatusCode

- Get The Company's Comments  by Id
- Endpoint: GET /api/v1/companies/{id}/comments
    - Params { id: string; }
    - Response: 
        - body {
                "data" : {
                    "id": int,
                    "content": string,
                    "rating": int,
                    "user": {
                        "id": int,
                        "first_name": string,
                        "last_name": string,
                        "phone_number": string,
                        "avatar": string
                    },
                }
            }
        - Headers: StatusCode

- Get The Company's Rating  by Id
- Endpoint: GET /api/v1/companies/{id}/overall-rating 
    - Params { id: string; }
    - Response: 
        - body {
                "overall_rating" : string
            }
        - Headers: StatusCode

- Get The 10 Top Companies By Rating 
- Endpoint: GET /api/v1/companies/top-rated 
    - Response: 
        - body {
                "top_rated_companies" : [
                    "id": int,
                    "name": string,
                    "description": stirng,
                    "logo": string,
                    "updated_at": string,
                    "created_at": string
                    "comments_avg_rating": string
                ]
            }
        - Headers: StatusCode

### Comments
- Create a Comment
    - Endpoint: POST /api/v1/comments
    - Request:
        - body{
                "content": string,
                "rating": int,
                "user_id": int,
                "company_id": int
            }
    - Response: 
        - body {
                "data": {
                    "id": int,
                    "content": string,
                    "rating": int,
                    "user": {
                        "id": int,
                        "first_name": string,
                        "last_name": string,
                        "phone_number": string,
                        "avatar": string
                    },
                    "company": {
                        "id": int,
                        "name": string,
                        "description": string,
                        "logo": string
                    }
                }
            }
        - Headers: StatusCode
        
- Get a List of comments
    - Endpoint: GET /api/v1/comments
    - Response: 
        - body{   
                "data": {
                    "current_page": int,
                    "data": [
                        {
                            "id": int,
                            "content": string,
                            "rating": int,
                            "user_id": int,
                            "company_id": int,
                            "created_at": string,
                            "updated_at": string
                        },
                    ],
                    "first_page_url": string,
                    "from": int,
                    "last_page": int,
                    "last_page_url": string,
                    "links": [
                        {
                            "url": null,
                            "label": "&laquo; Previous",
                            "active": false
                        },
                        {
                            "url": string,
                            "label": number(string),
                            "active": boolean
                        },
                        {
                            "url": string,
                            "label": "Next &raquo;",
                            "active": boolean
                        }
                    ],
                    "next_page_url": string,
                    "path": string,
                    "per_page": int,
                    "prev_page_url": boolean,
                    "to": int,
                    "total": int
                }
            }
        - Headers: StatusCode
- Get comment by Id
    - Endpoint: GET /api/v1/comments/{id} 
    - Params { id: string; }
    - Response: 
        - body {
                "data": {
                    "id": int,
                    "content": string,
                    "rating": int,
                    "user": {
                        "id": int,
                        "first_name": string,
                        "last_name": string,
                        "phone_number": string,
                        "avatar": string
                    },
                    "company": {
                        "id": int,
                        "name": string,
                        "description": string,
                        "logo": string
                    }
                }
            }
        - Headers: StatusCode
- Update comment by Id
    - Endpoint: PUT/PATCH  /api/v1/comments/{id} 
    - Params { id: string; }
    - Request:
        - body{
                "content": string,
                "rating": int,
                "user_id": int,
                "company_id": int
            }
    - Response: 
        - body {
                "message": "Comment's data updated successfully",
                "data": {
                    "id": int,
                    "content": string,
                    "rating": int,
                    "user": {
                        "id": int,
                        "first_name": string,
                        "last_name": string,
                        "phone_number": string,
                        "avatar": string
                    },
                    "company": {
                        "id": int,
                        "name": string,
                        "description": string,
                        "logo": string
                    }
                }
            }
        - Headers: StatusCode

- Delete comments by Id
    - Endpoint: DELETE /api/v1/comments/{id} 
    - Params { id: string; }
    - Response: 
        - body {
                "message" : "Comment deleted successfully"
            }
        - Headers: StatusCode

=======
