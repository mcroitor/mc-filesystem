<?php

namespace Mc\Filesystem;

class Manager {

    public const US = "/";
    public const WS = "\\";

    public static function Normalize(string $path, string $separator = DIRECTORY_SEPARATOR): string
    {
        $path = str_replace([self::US, self::WS], $separator, $path);
        while(strpos($path, $separator . $separator) !== false) {
            $path = str_replace($separator . $separator, $separator, $path);
        }
        return $path;
    }

    public static function ToUnix(string $path): string
    {
        return self::Normalize($path, self::US);
    }

    public static function ToWindows(string $path): string
    {
        return self::Normalize($path, self::WS);
    }

    public static function Root(string $path, string $separator = DIRECTORY_SEPARATOR): string
    {
        $path = self::Normalize($path, $separator);
        $chunks = explode($separator, $path);
        $last = array_pop($chunks);
        return implode($separator, $chunks);
    }

    public static function Children(string $path, string $separator = DIRECTORY_SEPARATOR): string
    {
        $path = self::Normalize($path, $separator);
        $chunks = explode($separator, $path);
        $last = array_pop($chunks);
        return $last;
    }

    public static function Implode(array $chunks, string $separator = DIRECTORY_SEPARATOR): string
    {
        $result = [];
        
        foreach ($chunks as $chunk) {
            $chunk = self::Normalize($chunk, $separator);
            $result = array_merge($result, explode($separator, $chunk));
        }
        return implode($separator, $result);
    }
}