
# Cook Master Project 🍽️🍗

For the second year annual project in development, we had to create a website for a cooking company. This company aims to sell certified courses that are provided by external providers such as renowned chefs. The site provides a wide range of features such as the purchase of materials, lessons, certified courses or even the possibility of registering for an organized event. A shopping cart is available to sort all the desired objects.

You have 4 types of users

**The administrator :**
- Creates, modifies and deletes plans
- Manages users
- Creates coupons and promotion codes

**The manager :**
- Validates the certified courses
- Creates events
- Creates materials and rooms

**The provider :**
- Creates lessons
- Creates certified courses / classes
- Generates diplomas in pdf
- Creates recipes

**The user :**
- Manage billing
- Check invoices
- Subscribe and buy items
- Watch and learn lessons 
- Can participate to a certified course
## Documentation 📖

We are using the version 10.x of Laravel for this project.

Also, Laravel offers an easy way to render your front view vith blade framework for html templates and livewire for dynamic components.

**The stack :** 
- Laravel 10.x [https://laravel.com/docs/10.x/installation]
- Blade [https://laravel.com/docs/10.x/blade]
- Livewire [https://laravel-livewire.com/docs/2.x/quickstart]

**Api for payment :**
- Stripe [https://stripe.com/docs/api]

## Run Locally (on Linux only :p)

Update your dependencies
```bash
sudo apt update
sudo apt upgrade
```

Download or update PHP dependencies 

```bash
PHP >= 8.0
OpenSSL PHP Extension
PDO PHP Extension
Mbstring PHP Extension
Tokenizer PHP Extension
XML PHP Extension
Ctype PHP Extension
JSON PHP Extension
BCMath PHP Extension
```

Download Composer

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

Download NodeJS : 
https://nodejs.org/fr/download

Clone the project

```bash
  git clone https://github.com/c-salhab/deployed-cook-master.git
```

Go to the project directory

```bash
  cd deployed-cook-master
```

Install npm
```bash
  npm install
```

Create a build directory with a production build of your app
```bash
  npm run build
```

Add an .env file to the root directory with the correct informations like so (File's location : /deployed-cook-master/.env) :

```bash
APP_NAME="Cook Master"
APP_ENV=local
APP_KEY=base64:aYSTKc6Jr/H4/lXBq4qiViUOojqeoRlsLAmMHaWdsd8=
APP_DEBUG=true
APP_URL=http:

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_example // [MODIFY]
DB_USERNAME=root // [MODIFY]
DB_PASSWORD=password // [MODIFY]

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=465
MAIL_USERNAME=example@gmail.com
MAIL_PASSWORD=password
MAIL_ENCRYPTION=ssl

STRIPE_KEY=pk_example
STRIPE_SECRET=sk_example

SESSION_DRIVER=database
```

Launch the server 🐋
```bash
php artisan migrate:fresh --seed 
php artisan serve 
```

