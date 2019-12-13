# Poker chance calculator.

Poker chance calculator is a php script for choose card from 52 cards to start play then drawing a random card one by one and the script calculate your chance for draft chosen card

## Installation

install Laravel if you don't have it by blow command
```bash
composer global require laravel/installer
```

then run this command inside script folder for install vendor
```bash
composer install
```

then run this command inside script folder for create sqlite database as file
```bash
touch database/database.sqlite
```

then run migration command for create the table
```bash
php artisan migrate
```


## Run

run script by this code
```bash
php artisan serve
```

then go to `http://127.0.0.1:8000` from your browsing and play.

this script coding for Assessment Development for Awstreams.