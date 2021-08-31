## My Caffeine Calculator

This is a sample demo site that can calculate how much caffeine you drank and how much more can you drink while staying at a safe level.

## Setup

This demo uses docker to run locally. It will spin up the main laravel container, a MySQL database, and PHPMyAdmin to view the database. The utility `sail` is used. See Laravel's website for more info.

1. Clone this repo: `git clone git@github.com:unitiweb/caffeine.git`
1. Run command `cd caffeine`
1. Copy the env example `cp .env.example .env`
1. Install composer dependencies `composer install`
1. Run command `sail up -d`
1. Migrate the database `sail artisan migrate`
1. Install npm dependencies `sail npm install`

Other helpful commands

**Shut Down**

```shell
sail down
```

**See Services**

```shell
sail ps
```

## Viewing the website

Assuming the demo spun up without any problems you will be able to view the site at `http://127.0.0.1:8080`

You can view PHPMyAdmin at `http://127.0.0.1:8081`
