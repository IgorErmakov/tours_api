## Tours/Travels API

## Deployment
```shell
composer install
./vendor/bin/sail up
./vendor/bin/sail migrate --env=testing
```

Run Unit tests:
```shell
./vendor/bin/sail test
```

Linters and analyzators

```shell
./vendor/bin/phpstan analyse
./vendor/bin/pint -v
```

