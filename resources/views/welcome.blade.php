<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Say Their Names API</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
    <pre>
    GET People
    List all
    https://saytheirnames.dev/api/people

    Get Single
    https://saytheirnames.dev/api/people/{firstname-lastname}

    Filter by name
    https://saytheirnames.dev/api/people?name=george-floyd

    Filter by country
    https://saytheirnames.dev/api/people?country=united-states

    Filter by city
    https://saytheirnames.dev/api/people?city=minnesota

    GET Donations
    List Types
    https://saytheirnames.dev/api/donation-types

    List all
    https://saytheirnames.dev/api/donations

    Get Single
    https://saytheirnames.dev/api/donations/{id}

    Filter by Type
    https://saytheirnames.dev/api/donations?type=victims

    Filter by Victim
    https://saytheirnames.dev/api/donations?name=george-floyd

    GET Petitions
    List Types
    https://saytheirnames.dev/api/petition-types

    List All
    https://saytheirnames.dev/api/petitions

    Get Single
    https://saytheirnames.dev/api/petitions/{id}

    Filter by Type
    https://saytheirnames.dev/api/petitions?type=victims

    Filter by Person
    https://saytheirnames.dev/api/petitions?name=george-floyd
    </pre>
    </body>
</html>
