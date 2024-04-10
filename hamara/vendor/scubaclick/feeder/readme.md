ScubaClick Feeder
=================

Add RSS, Atom and JSON feeds to Eloquent models
Still being developed for [ScubaClick](http://scubaclick.com), so handle with care for now!

Stable Version
--------------
v1.0

Installation
------------

Install by adding the following to the require block in composer.json:
```
"scubaclick/feeder": "dev-master"
```

Then run `composer update`.

Laravel-specific Installation
-----------------------------

Then add the following in app/config/app.php to the service providers array:
```php
'ScubaClick\Feeder\Providers\LaravelServiceProvider',
```

Then add to the aliases array the following:
```php
'Feeder' => 'ScubaClick\Feeder\Facades\LaravelFacade',
```

To change the configuration values, run the following command in the console:
```php
php artisan config:publish scubaclick/feeder
```

Producing Feeds
---------------

To actually be able to produce any feeds, your models must implement `ScubaClick\Feeder\Contracts\FeedInterface`.
It consists of only one method, `getFeedItem($format)`, which should return the following array:

```php
[
    'title'       => $title,
    'author'      => $author,
    'link'        => $link,
    'pubDate'     => $pubdate,
    'description' => $description,
];
```

Usage
-----

You can use the feeder class like so, e.g. in a controller:
```php
$items = Post::orderBy('created_at', 'desc')
	->take(10)
	->get();

return Feeder::setChannel([
	    'title'       => 'Feed title',
	    'description' => 'Feed description',
	])
	->setFormat('atom')
	->setItems($items)
	->fetch();
```

Credits
-------

Thanks to [laravel4-feed](http://roumen.it/projects/laravel4-feed) for the feed templates.

License
-------

ScubaClick Feeder is licenced under the MIT license.
