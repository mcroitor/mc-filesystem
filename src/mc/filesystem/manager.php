<?php

namespace mc\filesystem;

class manager {

    public const US = "/";
    public const WS = "\\";

    public static function normalize(string $path, string $separator = self::US): string
    {
        if ($separator === self::US) {
            return self::to_unix($path);
        } elseif ($separator === self::WS) {
            return self::to_windows($path);
        }
        return $path;
    }

    public static function to_unix(string $path): string
    {
        return str_replace(self::WS, self::US, $path);
    }

    public static function to_windows(string $path): string
    {
        return str_replace(self::US, self::WS, $path);
    }

    public static function root(string $path, string $separator = self::US): string
    {
        $path = self::normalize($path, $separator);
        $chunks = explode($separator, $path);
        $last = array_pop($chunks);
        return implode($separator, $chunks);
    }

    public static function children(string $path, string $separator = self::US): string
    {
        $path = self::normalize($path, $separator);
        $chunks = explode($separator, $path);
        $last = array_pop($chunks);
        return $last;
    }

    public static function implode(array $chunks, string $separator = self::US): string
    {
        $result = [];
        
        foreach ($chunks as $chunk) {
            $chunk = self::normalize($chunk, $separator);
            $result = array_merge($result, explode($separator, $chunk));
        }
        return implode($separator, $result);
    }
}