# laravel-settings
The laravel settings package let you save your settings in the database and access them easily.

## install
Add this package to your project using composer<br>
`composer require mjpakzad/laravel-settings`

Publish the migration file<br>
`php artisan vendor:publish --provider="Mjpakzad\LaravelSettings\SettingServiceProvider"`

Migrate the new migration to create settings table<br>
`php artisan migrate`

## Usage
Create a new setting<br>
`set_setting($key, $value, $group, $autoload)`

You can group settings for example `footer-settings` or `seo` or anything else, default value of `$group` is `null`.<br>
Also, you can autoload some settings to load in your AppServiceProvider, default value of `$autoload` is `false`.
examples<br>
`set_setting('site-name', 'Laravel settings')`<br>
`set_setting('blog-title', 'My personal blog', 'blog', true)`

Get a value by key<br>
`get_setting('site_name')`

Get values by group<br>
`setting_group('blog')`

Get autoload settings<br>
`setting_autoload($autoload)`<br>
default value of `$autoload` is `true`

Also, you can bring all settings out to config.<br>
`setting_config()`<br>
This function save all settings as key-value pairs in config, you can filter settings by parameters like below:<br>
`setting_config($keys, $groups, $autoload)`<br>
All parameters have `null` value.

Now, you can access them by `config()` method:<br>
`config('settings')`
