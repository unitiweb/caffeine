## My Caffeine Calculator

This is a sample demo site that can calculate how much caffeine you drank and how much more can you drink while staying at a safe level.

## Setup

This demo uses docker to run locally. It will spin up the main laravel container, a MySQL database, and PHPMyAdmin to view the database. The utility `sail` is used. See Laravel's website for more info.

**NOTE** If you `sail` commands are working you may not have an alias setup, so you can substitute it with `./vendor/bin/sail`.

1. Clone this repo: `git clone git@github.com:unitiweb/caffeine.git`
1. Run command `cd caffeine`
1. Copy the env example `cp .env.example .env`
1. Install composer dependencies `composer install`
1. Run command `sail up -d`
1. Migrate the database `sail artisan migrate`
1. Seed the database `sail artisan db:seed`
   
The website is now up. Here's how you can view it:

1. Visit the website at `http://127.0.0.1:8080`
1. Visit PHPMyAdmin at `http://127.0.0.1:8081`

Other helpful commands

**Shut Down**

```shell
sail down
```

**See Services Status**

```shell
sail ps
```

## Viewing the website

Assuming the demo spun up without any problems you will be able to view the site at `http://127.0.0.1:8080`

You can view PHPMyAdmin at `http://127.0.0.1:8081`
