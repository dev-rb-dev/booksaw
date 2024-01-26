# clone the repo
git clone https://github.com/devzakir/laravel-complete-blog-development.git laravel-blog

# install composer dependency
composer install

# create a environment file
cp .env.example .env

# set the Application key
php artisan key:generate


# setup the database credentials and migrate database with seeders
php artisan migrate --seed

# Admin login
    email : admin@gmail.com
    password: password
