# smsexpress
 steps to setup project locally:
 
 
- git clone https://github.com/majdch/smsexpress.git projectName

- composer install

-cp .env.example .env

-php artisan key:generate

-php artisan migrate

-php artisan storage:link

-composer require intervention/image

-composer require backpack/crud:"4.1.*"

-composer require backpack/generators --dev

-php artisan backpack:install

-composer require backpack/newscrud

php artisan vendor:publish --provider="Backpack\NewsCRUD\NewsCRUDServiceProvider"

-composer require consoletvs/charts:6.*
# latest
# latest
# latest
