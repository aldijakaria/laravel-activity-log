# Laravel Activity Log
aldijakaria/laravel-activity-log is a 
Laravel package that allows you to log user activity 
in your Laravel application. It provides a middleware that 
can be added to your application's routes to track user activity.

## Installation

You can install the package via Composer:

```shell
composer require aldijakaria/laravel-activity-log
```

## Usage
To use the package, add the TrackUserActivity middleware to your application's routes:
```php
Route::get('/home', function () {
    return view('home');
})->middleware('track:your activity name');
```

This middleware will automatically log the user's activity to the database.

## Configuration
You can customize the package's behavior by publishing its configuration file. 
To publish the configuration file, run the following command:

```shell
php artisan vendor:publish --provider="Aldijakaria\LaravelActivityLog\Providers\LaravelActivityLogProvider" --tag="config"
```
This will create a config/activity-log.php file in your application. 
You can modify this file to customize the package's behavior.

By default, the package will use the TRACK_ACTIVITY_LOG environment 
variable to determine whether to enable or disable activity logging. If this variable is not set, the package will default to logging activity.

To disable activity logging, you can set the TRACK_ACTIVITY_LOG environment
variable to false:
```env
TRACK_ACTIVITY_LOG=false
```

## License
The package is open-sourced software licensed under the MIT license.
