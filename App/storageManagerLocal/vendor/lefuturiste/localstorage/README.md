# PHP Local storage

[![Build Status](https://img.shields.io/endpoint.svg?url=https%3A%2F%2Factions-badge.atrox.dev%2Flefuturiste%2Flocalstorage%2Fbadge&style=for-the-badge)](https://actions-badge.atrox.dev/lefuturiste/localstorage/goto)

This library can be useful if you need localstorage/cache key:value on disk for your PHP application.

## Installation

You can easily install the localstorage lib using composer:

`composer require lefuturiste/localstorage`

## Usage

All methods are on the Lefuturiste\LocalStorage\LocalStorage class

This is a small and quick example of this lib.
```php
<?php
require 'vendor/autoload.php';

// simple key value store
$localStorage = new Lefuturiste\LocalStorage\LocalStorage();
$localStorage->set('my-key', 'my-value'); // set a value
$localStorage->set('my-key', ['object' => ['is_complex' => true, 'number' => 1]]); // all values are json encoded so you can save array with string, int, float, boolean and null values
$localStorage->save(); // this will write the file on disk, don't forget to call it when you mutate the state!
$localStorage->get('my-key'); // retrieve the value (this will decode the JSON)
$localStorage->has('my-key'); // will return true
$localStorage->has('unknown-key'); // will return false
$localStorage->del('my-key'); // yes it does what you think it will do
$localStorage->clear(); // you can remove all the keys using the clear() method
$localStorage->unlinkStorage(); // you can complety remove the .json file on the disk

// duration management
// by default all the keys are saved with the date of the creating, so you can if you want, delete all the keys olden than a specified duration.
$localStorage->deleteOlderThan(\Carbon\CarbonInterval::seconds(10));
```

## Tests

All the tests are in the test folder

`vendor/bin/phpunit test`
