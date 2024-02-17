## Tours/Travels API

## Deployment
```shell
composer install
./vendor/bin/sail up
./vendor/bin/sail migrate
./vendor/bin/sail artisan db:seed
```


Linters and analyzators

```shell
./vendor/bin/phpstan analyse
./vendor/bin/pint -v
```

Run Unit tests:
```shell
./vendor/bin/sail test
```
