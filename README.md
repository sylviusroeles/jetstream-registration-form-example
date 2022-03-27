## Pre-requisites
* php 8.1
* composer 2.*
* npm 8.4.1 or higher
* node v17.5.0 or higher

## Installation
```bash
composer install
npm install
npm run watch

cp .env.example .env
#edit .env with db credentials and postcodeapi key

php artisan migrate
```
