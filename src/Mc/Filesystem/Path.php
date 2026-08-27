<?php

namespace Mc\Filesystem;

use Mc\Filesystem\Manager;

class Path {

    private $path;

    public function __construct(string | array $path)
    {
        $p = $path;
        if (\is_array($path)) {
            $p = Manager::implode($path);
        }
        $this->path = Manager::normalize($p);
    }

    public function filename(): string {
        return Manager::children($this->path);
    }

    public function extension(): string {
        $filename = $this->filename();
        $chunks = \explode(".", $filename);
        return end($chunks);
    }

    public function parent(): string {
        return Manager::root($this->path);
    }

    public function __toString(): string
    {
        return $this->path;
    }

    public function exists() : bool {
        return \file_exists($this->path);
    }

    public function isFile() : bool {
        return \is_file($this->path);
    }

    public function isDir() : bool {
        return \is_dir($this->path);
    }

    public function isLink() : bool {
        return \is_link($this->path);
    }

    public function isReadable() : bool {
        return \is_readable($this->path);
    }

    public function isWritable() : bool {
        return \is_writable($this->path);
    }

    public function isExecutable() : bool {
        return \is_executable($this->path);
    }

    public function size() : int {
        return \filesize($this->path);
    }
}