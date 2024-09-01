install:
	composer install;
lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin tests;
fix-lint:
	composer exec --verbose phpcbf -- --standard=PSR12 src bin tests;
test:
	composer exec --verbose phpunit tests;
test-coverage:
	composer run test-coverage;
testcov-html:
	composer run test-coverage-html;
stan:
	vendor/bin/phpstan analyse bin src tests --level=8;