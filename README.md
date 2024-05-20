<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Pong CRM

This is a simple CRM application inspired from [PingCRM](https://demo.inertiajs.com/) & [Crater Invoice App](https://demo.craterapp.com)

## Installation

To run this project simplly run the commands below.
Open your terminal in computer run these commands sequencially.

-   `git clone https://github.com/ashraful-raju/laravel-crm.git crm`
-   `cd crm`
-   `cp .env.example .env` and configure the `.env` file
-   `composer install`
-   `yarn install` or `npm install`
-   `php artisan key:generate`
-   `php artisan migrate --seed`
-   `yarn build`
-   `php artisan serve`

## Architecture

Here is the system design information.

### Models

`User` - for authorization
`Customer` - Store the customer data
`Product` - Our Product
`Invoice` - Invoice models

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
