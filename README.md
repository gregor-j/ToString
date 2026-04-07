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
// [name: "Hello", value: 2.7, nothing: null]

echo ToString::fromAny(new stdClass());
// stdClass
```

## Limitations

- Array output is currently designed for human readability, not for parsing back into PHP.
- Recursive/self-referencing arrays are currently not supported.

[license-mit]: https://img.shields.io/badge/license-MIT-blue.svg
