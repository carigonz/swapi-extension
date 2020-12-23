# Swapi Vehicle Extension API

## Requirements
- For installing dependencies, [Composer](https://getcomposer.org/download/).
- [PHP](https://www.php.net/manual/es/install.php) version required: "^7.2.5|^8.0".
- Database set [MySQL](https://dev.mysql.com/doc/mysql-installation-excerpt/8.0/en/windows-install-archive.html).
- Or install [XAMPP environment](https://www.apachefriends.org/es/index.html) for PHP and MySQL.

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Please follow this instruccion to get proyect installed locally.

First clone proyect.

`git clone https://github.com/carigonz/swapi-extension.git`

Create and config .env file

`touch .env`

Copy .env.example file and add your database credentials.

Install dependencies.

`composer install`

Create app key.

`php artisan key:generate`

Run migrations.

`php artisan migrate`

Start Server.

`php artisan serve`

Enjoy!

### [API Documentation](https://drive.google.com/file/d/16AkkX8KQnAfoHSnN72i_ZV4YSVWk-Do7/view?usp=sharing)
### [Original API Documentation](https://swapi.dev/documentation)
