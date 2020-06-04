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
        <h1>Say Their Names API</h1>
        <p> Available Links</p>

        <code>
            https://saytheirnames.dev/api/people
        </code>
        <br>
        <code>
            https://saytheirnames.dev/api/people/{id}
        </code>
        <br>
        <code>
            https://saytheirnames.dev/api/petitions
        </code>
        <br>
        <code>
            https://saytheirnames.dev/api/petitions/{id}
        </code>
        <br>
        <code>
            https://saytheirnames.dev/api/donations
        </code>
        <br>
        <code>
            https://saytheirnames.dev/api/donations/{id}
        </code>
        <br>
        <p>(Must be Authenticated)</p>
        <code>
            https://saytheirnames.dev/api/bookmarks
        </code>
        <hr />
        <p>Authentication</p>
        <br>
        <code>
            https://saytheirnames.dev/api/login
        </code>
        <pre>
            <br>
            email *
            <br>
            password *
        </pre>
        <br>
        <code>
            https://saytheirnames.dev/api/register
        </code>
        <pre>
            <br>
            name *
            <br>
            email *
            <br>
            password *
            <br>
            password_confirmation *
        </pre>
        <br>
        <code>
            https://saytheirnames.dev/api/request/password-reset
        </code>
        <pre>
            <br>
            email *
        </pre>
        <br>
        <code>
            https://saytheirnames.dev/api/password/reset
        </code>
        <pre>
            <br>
            token *
            <br>
            email *
            <br>
            password *
            <br>
            password_confirmation *
        </pre>
        <hr />
    </body>
</html>
