<?php

namespace Mc\Filesystem;

use Mc\Filesystem\Manager;

class Sausage {
    public static function path(string $path): string {
        $path = str_replace(".", DIRECTORY_SEPARATOR, $path);

        return Manager::normalize($path);
    }

    public static function from(string $path): string {
        $path = Manager::normalize($path);
        return str_replace(["/", "\\"], ".", $path);
    }
}