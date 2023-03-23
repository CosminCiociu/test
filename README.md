So, I finnished the test, it worked on my machine, I hope it will work on yours too. Follow this commands to install it on your machine:

Open Terminal:
git clone https://github.com/CosminCiociu/test.git
cp .env.example .env

Change this:
.env file

APP_NAME=Travellist
APP_ENV=dev
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=travellist
DB_USERNAME=travellist_user
DB_PASSWORD=password

Then run:
docker-compose build app
docker-compose up -d
docker-compose exec app rm -rf vendor composer.lock
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate:fresh --seed

The application will run on : http://localhost:8080

I used Postman to send requests (Accept: application/json, Content-Type:application/json) and to send request, I selected "Body" and then "raw" in the settings

Public
/api/register
{  
"email" : "cosmin123@gmail.com",
"password": "Cosmin123"
}

/api/login
{  
"email" : "employee2@employee2.com",
"password": "employee2"
}

/api/logout

You can see the in the api.php file or run docker-compose exec app php artisan route:list
In the controllers, for the post/put methods, you can see my json body content commented

I used laravel/sanctum for authentication

I didn't made a ManyToMany relationship between projects and employees but beside that, I think I covered all the rest

If you have any problems with setting it up, feel free to contact me and also if you have time, give me some feedback on the project.

Have a good day :3

P.S: I don't know how to write colorfull code in readme.md
