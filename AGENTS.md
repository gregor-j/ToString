# AGENTS.md

## Project Snapshot
- This repository is a small PHP library that converts values into escaped, readable string representations.
- The public API lives in one class: `src/ToString.php` (`final class ToString`, static methods only).
- Namespace and autoloading are PSR-4: `GregorJ\\ToString\\` -> `src/` (`composer.json`).

## Big Picture Architecture
- Main entrypoint is `ToString::fromAny(mixed $value): string` in `src/ToString.php`.
- `fromAny()` dispatches by runtime type to specialized methods:
  - `fromBoolean(bool $value)`
  - `fromNumber(float|int $value)`
  - `fromString(string $value)`
  - `fromByte(int $byte)`
- String handling is byte-based (`unpack('C*', $value)`), then each byte is escaped via `fromByte()`.
- Array formatting is flat and recursive via `fromAny()`; object formatting uses `var_export($value, true)`.

## Developer Workflows (Use These First)
- Install dependencies:
  - `make install PHP_VERSION=8.1`
- Run tests:
  - `make test PHP_VERSION=8.1`
- Run static analysis (PHPStan level 9):
  - `make analyze PHP_VERSION=8.1`
- Run style checks / autofix:
  - `make sniff PHP_VERSION=8.1`
  - `make beautify PHP_VERSION=8.1`
- Security audit:
  - `make audit`

## Testing & Quality Conventions
- Tests are in `tests/ToStringTest.php` and heavily use data providers (including many byte-range cases).
- Keep `declare(strict_types=1);` in all PHP files (`src/ToString.php`, `tests/ToStringTest.php`).
- Preserve deterministic output formatting; tests assert exact strings.
- Invalid bytes must throw `OutOfBoundsException` (see `ToString::fromByte()`).

## Project-Specific Implementation Notes
- Escaping behavior mirrors PHP string escape conventions (`\n`, `\r`, `\t`, `\f`, `\v`, `\\`, `\"`, `\$`).
- Non-printable bytes are emitted as hex escapes (`\\xNN`), printable ASCII is emitted as-is.
- For numbers, special float values are normalized (`INF`, `-INF`, `NAN`) via `fromNumber()`.

## Dependencies & Boundaries
- Runtime has no external library dependencies.
- Dev tooling is defined in `composer.json` (`phpunit/phpunit`, `phpstan/phpstan`, `squizlabs/php_codesniffer`).
- CI-like behavior is encoded in `Makefile`; prefer `make` targets over ad-hoc command variants.

## When Changing Behavior
- Update/add data-provider cases in `tests/ToStringTest.php` first, then implement in `src/ToString.php`.
- Validate with `make test PHP_VERSION=8.1` and `make analyze PHP_VERSION=8.1` before finalizing changes.

