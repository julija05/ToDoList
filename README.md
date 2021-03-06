# README

## ToDoList
To-Do List is an API made in Laravel that can be used for creating, updating, deleting, and reading To-Do Lists and tasks.
### Installation

#### Clone repository

     $ git clone https://github.com/julija05/ToDoList.git

#### Change directory

     $ cd toDoList

#### Install all required dependencies

    $ docker run --rm -v $(pwd):/opt -w /opt laravelsail/php80-composer:latest composer install

#### Set the proper permissions to the project files.

    $ sudo chown -R $USER: .

#### Copy .env File

    $ cp .env.example .env

#### Docker-compose rebuild the container

    docker-compose up --build

#### Start the container terminal

    $ vendor/bin/sail up

#### Migrate Database

    $ php artisan migrate OR $ php artisan migrate:fresh

#### Install passport 

    $ sail artisan passport:install
