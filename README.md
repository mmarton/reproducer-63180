# reproducer-63180 Http cache state leaks through test after 7.3.10

Reproduction:

1. `composer install`
2. `vendor/bin/phpunit`
3. see tests pass
4. `composer require symfony/http-kernel:"7.3.10"`
5. `vendor/bin/phpunit`
6. see tests fail

