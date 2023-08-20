## How to install project

This is a project developed with Laravel v10 and use the next

- [Composer](https://getcomposer.org/download/).
- [Artisan](https://laravel.com/docs/10.x/artisan).
- [File Storage](https://laravel.com/docs/10.x/filesystem).
- [Php version 8](https://php.watch/articles/php-8.0-installation-update-guide-debian-ubuntu).

We need to do the next steps to run the project

## How to clone

Must clone the repository [documentation](https://docs.github.com/en/repositories/creating-and-managing-repositories/cloning-a-repository) be sure to follow the steps to clone it.

## Open terminal and go the path of this project, replace the pathFolder with the path of the folder on your compuetr

```
cd pathFolder
```

## Install dependencies 

To develop this project, we need some dependencies to install, run the next commando on your project folder

```
composer install
```

## Create link to Storage

This command help us to link the public folder with the storage of laravel.
```
php artisan storage:link
```

## if we install everything, run the next command to start the serve

```
php artisan serve
```

## Opne other terminal ang go again to the folder, them run this command to get the Assigment Address for all the Drivers

```
php artisan app:assign-routes
```
