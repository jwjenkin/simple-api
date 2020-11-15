# Simple API

## Short and Long of it...

This came about by me needing an API on a Pi Zero W with only 1G available storage. It follows
the same sort of pattern that Laravel does, in that one declares routes and handlers. Currently,
it can use some TLC in the way of how different params are passed around. *But*, the plan is to
keep it simple and not use composer or any libraries to ensure it stays nice and slim.

This repo includes some **very** basic Pin access, and an example LED controller. Feel free to
fork and change.

## Requirements

* `>=php7`
* `gpio` (if running on pi)
* `npm` (for commitizen)

## Usage

1. Create Controller

In `controllers`, add simple-named file (my example: PinController).

```
<?php

namespace Controller;

class PinController extends BaseController
{
    public function index()
    {
        return 'Use GET (read) & POST (write) /pin/{pin}';
    }
}

```

2. Add new route to `routes.php` (in our case, '/pin')

```
<?php

return = [
    'GET' => [
        '/' => 'BaseController@index',
        '/pin' => 'PinController@index'
    ]
];
```

3. Load up {localhost}/pin

```
Response-Type: application/json
{ "data": "Use GET (read) & POST (write) /pin/{pin} }
```

## Random Tidbits

* This "framework" has a faux `dd` command, which will just `var_dump` any
params given to it, then exit. I may make this prettier later.

* It's a bit of a pain to deal with both dynamic URLs *and* `POST` data. Currently,
it looks for any params in the slug, then grabs key => value pairs in the `$_REQUEST`
and passes the array to the handler.
