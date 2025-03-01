# Differ

This is educational project. CLI app buids diff of two files (JSON and YAML supported) in different formats (stylish, plain, json).

### Tests, Hexlet tests and Code Climate status:
[![Actions Status](https://github.com/asommar/php-project-48/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/asommar/php-project-48/actions)
[![Tests](https://github.com/asommar/php-project-48/actions/workflows/package-ci.yml/badge.svg)](https://github.com/asommar/php-project-48/actions/workflows/package-ci.yml)
[![Maintainability](https://api.codeclimate.com/v1/badges/7c6419b022891bc1034e/maintainability)](https://codeclimate.com/github/asommar/php-project-48/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/7c6419b022891bc1034e/test_coverage)](https://codeclimate.com/github/asommar/php-project-48/test_coverage)

## Prerequisites
* Linux, Macos, WSL
* PHP >=8.1
* Make
* Git
* wp-cli/php-cli-tools

## Setup
```bash
git clone https://github.com/asommar/php-project-45
cd php-project-45
make install
```
## Run app
  ```shell
  php bin/gendiff --format json  tests/fixtures/nested1.json tests/fixtures/nested2.json
  ```
