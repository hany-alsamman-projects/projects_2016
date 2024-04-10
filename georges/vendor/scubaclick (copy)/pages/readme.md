ScubaClick Pages
=================

Add static and chronological pages to Laravel 4.
Still being developed for [ScubaClick](http://scubaclick.com), so handle with care for now!

Stable Version
--------------
v1.0

General Installation
--------------------

Install by adding the following to the require block in composer.json:
```
"scubaclick/pages": "dev-master"
```

Then run `composer update`.

Your user model also needs to implement `ScubaClick\Pages\Contracts\AuthorInterface`. It's only one method `getFullNameAttribute()` and should return the full name of the user, funnily enough.

Laravel-specific Installation
-----------------------------

Add the following in app/config/app.php to the service providers array:
```php
'ScubaClick\Pages\PagesServiceProvider',
```

To change the configuration values, run the following command in the console:
```php
php artisan config:publish scubaclick/pages
```

To create the migrations, run the following command in the console:
```php
php artisan migrate --package="scubaclick/pages"
```

Notes
-----

Please note that ScubaClick Pages does not provide any templates or controllers, only the models, migrations and repositories. You will have to implement these yourself.

License
-------

ScubaClick Pages is licenced under the MIT license.
