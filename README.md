# Differ

This is educational project. CLI app buids diff of two files (JSON and YAML supported) in different formats (stylish, plain, json).

### Tests, Hexlet tests and Code Climate status:
[![Tests](https://github.com/asommar/php-project-48/actions/workflows/package-ci.yml/badge.svg)](https://github.com/asommar/php-project-48/actions/workflows/package-ci.yml)
[![Actions Status](https://github.com/asommar/php-project-48/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/asommar/php-project-48/actions)
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
git clone https://github.com/asommar/php-project-48
cd php-project-48
make install
```
## Run app
  ```shell
  Usage:
    gendiff (-h|--help)
    gendiff (-v|--version)
    gendiff [--format <fmt>] <firstFile> <secondFile>
    
Options:
    -h --help           Show this screen
    -v --version        Show version
    --format <fmt>      Report format (stylish, plain or json) [default: stylish]
```
For example:
```shell
  bin/gendiff --format stylish file1.json file2.json
```

## Output formats
* Stylish (default)
  [![asciicast](https://asciinema.org/a/ePN4DVRstiXAfOPgqEPYkf5GO.svg)](https://asciinema.org/a/ePN4DVRstiXAfOPgqEPYkf5GO)
* Plain
  [![asciicast](https://asciinema.org/a/hJ77DjjuxfZMg1EsDCiBxUtzQ.svg)](https://asciinema.org/a/hJ77DjjuxfZMg1EsDCiBxUtzQ)
* JSON
  [![asciicast](https://asciinema.org/a/ImDiskLzMpr1GzZb98ym5xbKF.svg)](https://asciinema.org/a/ImDiskLzMpr1GzZb98ym5xbKF)
