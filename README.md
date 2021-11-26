1.  Clone your repository, example:
    $ git clone https://github.com/julija05/toDoList.git

2.  Change directory into the newly created app/project.
    $ cd toDoList

3.  Install all required dependencies

    $ docker run --rm -v $(pwd):/opt -w /opt laravelsail/php80-composer:latest composer install

4.  Set the proper permissions to the project files.
    $ sudo chown -R $USER: .
5.  Copy .env File
    $ cp .env.example .env

6.  Docker-compose rebuild the container
    docker-compose up --build

7.  Start the container terminal
    $ vendor/bin/sail up

8.  Migrate Database
    $ php artisan migrate OR $ php artisan migrate:fresh
9.  Install passport as required if necessary
    $ sail artisan passport:install
