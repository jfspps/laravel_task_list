# Task List

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

## Laravel version check and running the server

Check the Laravel framework version (currently [v11.38.2](composer.json)) with:

```bash
php artisan --version
```

Run a server from localhost with e.g. port 9000:

```bash
php artisan serve --port=9000 
```

Close the server (Ubuntu) with CTRL-C.
