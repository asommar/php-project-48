install:
	composer install;
lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin;
fix-lint:
	composer exec --verbose phpcbf -- --standard=PSR12 src bin;
test:
	composer exec --verbose phpunit Tests;
test-coverage:
	composer run test-coverage;
testcov-html:
	composer run test-coverage-html;
stan:
	vendor/bin/phpstan analyse bin src Tests --level=8;