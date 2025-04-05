# mc-filesystem

Simple wrapper for PHP's filesystem functions.

## Interface

### path class

```php
namespace mc\filesystem;

class path {

    public function __construct(string | array $path);

    public function filename(): string;

    public function extension(): string;

    public function parent(): string;

    public function __toString();

    public function exists() : bool;

    public function is_file() : bool;

    public function is_dir() : bool;

    public function is_link() : bool;

    public function is_readable() : bool;

    public function is_writable() : bool;

    public function is_executable() : bool;

    public function size() : int;
}
```

### manager class

```php
namespace mc\filesystem;

class manager {

    public const US = "/";
    public const WS = "\\";

    public static function normalize(string $path, string $separator = DIRECTORY_SEPARATOR): string;

    public static function to_unix(string $path): string;

    public static function to_windows(string $path): string;
    public static function root(string $path, string $separator = DIRECTORY_SEPARATOR): string;

    public static function children(string $path, string $separator = DIRECTORY_SEPARATOR): string;

    public static function implode(array $chunks, string $separator = DIRECTORY_SEPARATOR): string;
}
```

## run tests

```shell
php tests/001_test_manager.php
```

## TODO

- [ ] add documentation for path class
- [ ] add documentation for manager class
- [ ] add tests for path class
- [ ] more about sausage class
