![Code Tests](https://github.com/Say-Their-Name/say-their-names-api/workflows/Code%20Tests/badge.svg)

# STN Backend API

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

### Adminer (Web UI for MySQL DB)  
It's accessible at http://localhost:48080  
Login using the user/password from the .env.example (should be `stn`/`stn`)  


---
[Other (not recommended) ways to setup are available here](docs/install_alternatives.md)

## Endpoints Available

```
GET People
List all
http://localhost:8000/api/people

Get Single
http://localhost:8000/api/people/{firstname-lastname}

Filter by name
http://localhost:8000/api/people?name=george-floyd

Filter by country
http://localhost:8000/api/people?country=united-states

Filter by city
http://localhost:8000/api/people?city=minnesota

GET Donations
List Types
http://localhost:8000/api/donation-types

List all
http://localhost:8000/api/donations

Get Single
http://localhost:8000/api/donations/{id}

Filter by Type
http://localhost:8000/api/donations?type=victims

Filter by Victim
http://localhost:8000/api/donations?name=george-floyd

GET Petitions
List Types
http://localhost:8000/api/petition-types

List All
http://localhost:8000/api/petitions

Get Single
http://localhost:8000/api/petitions/{id}

Filter by Type
http://localhost:8000/api/petitions?type=victims

Filter by Person
http://localhost:8000/api/petitions?name=george-floyd
```

## Developer tooling
