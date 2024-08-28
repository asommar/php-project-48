install:
	composer install;
lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin;
fix-lint:
	composer exec --verbose phpcbf -- --standard=PSR12 src bin;
test:
	composer exec --verbose phpunit Tests
stan:
	vendor/bin/phpstan analyse src Tests --level=8;