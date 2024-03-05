# Movies project

This project contains a Laravel 10 backend which handles the API connection with TMDB.
And a frontend (another project) build with Next JS 13.

## Prerequisites

This project requires 
`php >= 8.1`
`MySQL >= 8.1`


## Run Docker

Download [Docker desktop](https://www.docker.com/products/docker-desktop/)

Open the project in your terminal and run

```
docker-compose up --build
```

If everything went well then it's time to run the migrations:
```bash
# Go into your docker container
docker exec -it movies-backend-app /bin/bash
```

Run the following commands:

```bash
php artisan migrate
php artisan db:seed
php artisan app:fetch-movies
````

### Frontend project

Now run the [frontend project](https://github.com/xCharlotte/movies-frontend) on your local machine with Node v.18 and npm run dev
http://localhost:3000

`node >= 18`

### Enjoy 🦄

## Useful links

### Laravel
- [Laravel Passport](https://laravel.com/docs/10.x/passport)
- [Routing](https://laravel.com/docs/eloquent](https://laravel.com/docs/10.x/routing))
- [HTTP Client](https://laravel.com/docs/migrations](https://laravel.com/docs/10.x/http-client)https://laravel.com/docs/10.x/http-client)
