## Tours/Travels API
That's a relatively small app that allows users to create Travels & Tours using the API.
Here are 4 endpoints:
1. An Endpoint for creating new travels (only for admins)
2. An Endpoint for creating new tours for a given travel (only for admins)
3. An Endpoint for updating the trave (editors can do that)
4. A public endpoint for getting a paginated list of tours by travel and other filters


## Setup env & run tests
```shell
composer install
./vendor/bin/sail up
./vendor/bin/sail artisan test
```

Run Unit & Feature tests:
```shell
./vendor/bin/sail test
```

Linters and analyzators
```shell
./vendor/bin/pint -v
./vendor/bin/phpstan analyse --memory-limit=245M
```
