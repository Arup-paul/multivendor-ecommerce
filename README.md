# ![Laravel Multivendor Ecommerce App]

 
This repo is functionality ongoing — PRs and issues welcome!

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

 

Clone the repository

    git clone https://github.com/Arup-paul/multivendor-ecommerce.git

Switch to the repo folder

    cd multivendor-ecommerce

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

 

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate 

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/Arup-paul/multivendor-ecommerce.git
    cd multivendor-ecommerce
    composer install
    cp .env.example .env
    php artisan key:generate  

**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate  
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the DataTableSeeder and set the property values as per your requirement

     

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

 
## Environment variables

- `.env` - Environment variables can be set in this file

 

##  Future Plan

   - Add More Payment Gateway(now only added paypal & COD)
   - Role wise permission (vendor and admin panel)
   - Brand List Page
   - Campaign Page
   - Special Offer Page
   - Social Login
   - More Feature
 

 
