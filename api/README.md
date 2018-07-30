# fortbrasil-test
This project be part of the test of FortBrasil company

Enter in `API` folder.
```
cd /api
```

Install all dependencies.
```
composer install
```

Configure the database file with the credentials from your server.
```
src/FortBrasil/ConfigModule/Resource/Database.php

$this->credentials = [
    'dbname' => 'fortbrasil-db',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];
```

Open your preferred MySQL client and created a database with the name setted up on the previous step.

Create the schema in database.
```
vendor/bin/doctrine orm:schema-tool:create
```

Run the server
```
php -S 127.0.0.1:8000 web/api.php
```

Enjoy it! :)
