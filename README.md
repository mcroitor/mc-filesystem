# mc-filesystem

Simple wrapper for PHP's filesystem functions.

## Interface

### Path class

```php
namespace Mc\Filesystem;

class Path {

    public function __construct(string | array $path);

    public function filename(): string;

    public function extension(): string;

    public function parent(): string;

    public function __toString();

    public function exists() : bool;

    public function isFile() : bool;

    public function isDir() : bool;

    public function isLink() : bool;

    public function isReadable() : bool;

    public function isWritable() : bool;

    public function isExecutable() : bool;

    public function size() : int;
}
```

### Manager class

```php
namespace Mc\Filesystem;

class Manager {

    public const US = "/";
    public const WS = "\\";

    public static function normalize(string $path, string $separator = DIRECTORY_SEPARATOR): string;

    public static function toUnix(string $path): string;

    public static function toWindows(string $path): string;
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
