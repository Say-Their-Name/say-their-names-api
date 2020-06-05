# STN Installation alternatives

This document lists alternative ways to setup STN API (without Taskfile, or even without Docker) 

## Initial setup,without Taskfile *(less recommended)*
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
