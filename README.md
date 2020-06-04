# Backend API

**Live API can be found here:**  

[https://saytheirnames.dev](https://saytheirnames.dev)

## Get the code
```
git clone https://github.com/Say-Their-Name/api.git
cd api
```

## Setup with Docker
This is the recommended setup,as it prevents many PHP or dependency issues 
(compatibility, missing PHP extension...).

### Requirements
* [Docker](https://docs.docker.com/get-docker/)  
* [Docker Compose](https://docs.docker.com/compose/install/)  
* [Taskfile](https://taskfile.dev/#/installation) *(optional,but much recommended)*

### Initial setup,with Taskfile *(recommended)*
```
git clone https://github.com/Say-Their-Name/api.git
cd api

# Build the development Docker image
task build

# Start the stack
task

# Install vendor dependencies
task vendor

# Prepare the database
task dbreset

# Run shell in the running container
task sh

## from shell you can run composer, artisan, etc
```
Go to http://localhost:8000

### Initial setup,without Taskfile *(less recommended)*
You can still avoid installing and using Taskfile,but it would make your life easier ;)  
Anyway: 
```
# Build the development Docker image
docker-compose build

# Start the stack
docker-compose up

# Install vendor dependencies
docker-compose exec app composer install

# Prepare the database
docker-compose exec app php artisan migrate:fresh --seed

# Run shell in the running container
docker-compose exec app bash

## from shell you can run composer, artisan, etc
```
Go to http://localhost:8000

## Setup without Docker *(not recommended)*  
This is the last resort setup. Normally using Docker is easier.  
Also you're exposing yourself to inconsistencies.  
That being said:  
```bash
git clone https://github.com/Say-Their-Name/api.git
cd api

// Copy Your Environment files
cp .env.example .env

// Create an SQLITE Database
touch database/database.sqlite

// Install Composer Dependancies
composer install 

// Generate an encryption key
php artisan key:generate

// Generate a JWT secret
php artisan jwt:secret

// Create database and insert 10 People for testing
// Each Person has
// 1 Donation Link
// 1 Petition Link
// 1 Media Articles
// 1 Image
// Test User
// email: test-user@test.com
// password: password
// 2 Bookmarks
php artisan migrate:fresh --seed

// Run tests
php artisan test

// Run the application
php artisan serve
```

## Endpoints Available

```
GET People
http://localhost:8000/api/people
http://localhost:8000/api/people/{id}

GET Donations
http://localhost:8000/api/donations
http://localhost:8000/api/donations/{id}

GET Petitions
http://localhost:8000/api/petitions
http://localhost:8000/api/petitions/{id}
```

## TODO 
4. Admin Panel to manage the people

