<h4>Steps to installing project</h4>

To create a project from this repository:

1.  git clone https://github.com/GevorgPoghosyan95/csvAngular.git
2.  composer install
3.  create .env file use(.env.example)
4.  php artisan key:generate
5.  php artisan config:cache
6.  php artisan migrate
7.  php artisan queue:work

What is included
        "guzzlehttp/guzzle": "^6.3.1|^7.0.1",
        "laravel/framework": "^7.29",
        "maatwebsite/excel": "^3.1",
        "vladimir-yuldashev/laravel-queue-rabbitmq": "^10.2"


