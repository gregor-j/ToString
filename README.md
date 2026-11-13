# ToString

[![License: MIT][license-mit]](LICENSE)

This is a simple PHP library for turning values into readable strings.
Its main purpose is to make strings and byte data printable by escaping non-printable
characters instead of returning raw control bytes. This means, binary data is supported.

The library currently provides helpers for:

- booleans
- bytes
- strings
- arrays
- generic `mixed` values


## Installation

```bash
composer require gregorj/to-string
```

## Usage

```php
<?php

use GregorJ\ToString\ToString;

echo ToString::fromAny(true);
// true

echo ToString::fromAny("hello\nworld");
// hello\nworld

echo ToString::fromAny(['name' => 'Hello', 'value' => 2.7, 'nothing' => null]);
// [name: "Hello", value: 2.7, nothing: NULL]

echo ToString::fromAny(new stdClass());
// stdClass
```

## Limitations

- Array output is currently designed for human readability, not for parsing back into PHP.
- Recursive/self-referencing arrays are currently not supported.

## Development

Development commands run through the Docker-backed `Makefile`; PHP need not be
installed locally. PHP `^8.1` is supported, and CI tests PHP 8.1 and 8.5 with
normal and lowest dependencies. During the required-check transition, CI also
retains the existing PHP 8.2–8.4 checks. Run `make help` for all targets.

```sh
make check PHP_VERSION=8.1
make check PHP_VERSION=8.5 DEPENDENCIES_LOWEST=1
```

`check` resolves dependencies, runs lint, PHPUnit, PHPStan and PHPCS, then
audits the same temporary lockfile. `install` removes its temporary lockfile, so
a later standalone `audit` does not verify that earlier snapshot. `clean`
removes `vendor/` and the PHPUnit cache, not a pre-existing lockfile. Composer
uses an isolated manifest copy in the project root and does not change the
checked-in Composer configuration. The host needs `flock` to serialize install,
check, audit and clean operations sharing `vendor/`.

The Composer executable comes from `COMPOSER_IMAGE` (default `composer:2`);
Composer and QA run under the requested PHP image. The container installs
`git` and `unzip` for dependency resolution. Proxy environment variables and an
optional `CA_CERT_FILE` are forwarded, and `COMPOSER_CACHE_DIR` controls the
cache. If `config.platform.php` is present, only the isolated manifest copy
uses the actual PHP patch version; other platform settings and the checked-in
manifest remain unchanged.

Changes to `main` use pull requests and squash merges. Issue branches should be
named `<issue-number>-<title-slug>`. The force-push ruleset excludes the broader
glob `[0-9]*-*`, which also matches some names outside that convention; it does
not enforce the PR source. Main is protected separately.

[license-mit]: https://img.shields.io/badge/license-MIT-blue.svg
