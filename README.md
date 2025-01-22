# Task List

For official docs on setting up the project, see [here](https://laravel.com/docs/11.x/installation#creating-a-laravel-project).

## PHP.ini

PHP startup configuration is defined in php.ini.

```
$ php --ini
```

## PHP extensions

You may need to enable the PHP curl and dom (via xml) extensions. Use:

```bash
sudo apt install php-curl
```

```bash
sudo apt install php-xml
```

...and then restart Apache:

```bash
sudo service apache2 restart
```

Check the PHP modules ```curl``` and ```dom``` are installed with:

```bash
php -m
```

## NPM

The project utilises Node. Install Node and Node Package Manager from
[here](https://www.digitalocean.com/community/tutorials/how-to-install-node-js-on-ubuntu-22-04):

```bash
# Download and install nvm:
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.1/install.sh | bash
source ~/.bashrc

# Download and install Node.js:
nvm install 22

# Verify the Node.js version:
node -v # Should print "v22.13.0".
nvm current # Should print "v22.13.0".

# Verify npm version:

npm -v # Should print "10.9.2".
```

Remove the ```node_modules``` directory if it exists, and then rebuild it with:

```bash
npm install
```

A number of run scripts are defined [here](package.json), run:

```bash
npm run dev
```

## SQLite

Laravel 11 target SQLite by default as its database, see the [configuration file](.env). This file is not normally
shared with other developers.

Install SQLite extension with

```bash
sudo apt install php-sqlite3
```

(use e.g. ```sudo apt install php8.3-sqlite3``` for a specific version)

To enable the SQLite driver, uncomment (remove the semicolon) from the following lines in php.ini:

```
;extension=sqlite3
```

The database tables are found in [database](/database), resulting from 
[migration](https://laravel.com/docs/11.x/installation#databases-and-migrations) (version control for databases,
enabling developers to define and share the application's schema).

To migrate a database (needed if one were to use a database other than SQLite), enter:

```bash
php artisan migrate
```

With SQLite, this command will generate a SQLite database file: [database.sqlite](/database/database.sqlite).

## The Application key

The Laravel App key is defined in [env](.env) under APP_KEY and must be initialised with

```bash
php artisan key:generate
```

The key is used to encrypt/decrypt data and generate unique authentication tokens that are part of securing protected 
resources.

## Laravel version check and running the server

Check the Laravel framework version (currently [v11.38.2](composer.json)) with:

```bash
php artisan --version
```

With all the above set up, run a server from localhost with e.g. port 9000:

```bash
php artisan serve --port=9000 
```

Opening this in a browser will yield a Laravel dashboard.

Close the server (Ubuntu) with CTRL-C.
