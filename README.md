# Backend API

```bash
git clone project
cd into project

// Copy Your Environment files
cp .env.example .env

// Create an SQLITE Database
touch database/database.sqlite

// Install Composer Dependancies
composer install 

// Generate an encryption key
php artisan key:generate

// Create database and insert 10 People for testing
// Each Person has
// 1 Donation Link
// 1 Petition Link
// 3 Media Articles
// 4 Images
php artisan migrate:fresh --seed

// Run the application
php artisan serve
```

Endpoints Available

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

TODO 

1. Build an API For Searching Through People Model
2. Build The Ability to Filter By Location On People Model
3. Unit Test
4. Admin Panel to manage the people

