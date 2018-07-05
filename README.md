# Soccer Application
API based Soccer application using Laravel.

## Introduction

Soccer application for managing team amd player using laravel framework. Implemented Rest API to expose data. Implemented  Session based authentication used for API authentication.

## System requirements

Make sure your server meets the following requirements.

- PHP >= 7.0.0
- Node and Npm 
- Mysql >= 5.6

## Installation

To install the application please follow bellow steps.
 * clone the application 
 * cd soccer-application && cp .env.example .env
 * composer install && composer update
 * php artisan key:generate
 * update the .env file along with database connection
 * php artisan migrate
 * php artisan db:seed
 * npm install
 * Compile the assets by runing the node engine ( npm run development )
 
