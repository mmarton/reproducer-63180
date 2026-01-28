# reproducer-63180 Http cache state leaks through test after 7.3.10

Reproduction:

1. `composer install`
2. `vendor/bin/phpunit`
3. see tests pass
4. `composer require symfony/http-kernel:"7.3.10"`
5. `vendor/bin/phpunit`
6. see tests fail


Update: 7.3.11 fixes this, but symfony 7.4 seems still effected.

Reproduction 2:

1. `composer install`
2. `vendor/bin/phpunit`
3. see tests fail
4. downgrade kernel `composer require symfony/http-kernel:"7.4.3"`
5. `vendor/bin/phpunit`
6. see tests pass
