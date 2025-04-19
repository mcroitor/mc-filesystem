<?php

include_once __DIR__ . "/mc/logger.php";
include_once __DIR__ . "/mc/assert.php";
include_once __DIR__ . "/mc/test.php";
include_once __DIR__ . "/mc/testsuite.php";
include_once __DIR__ . "/../src/mc/filesystem/manager.php";

use Mc\Assert;
use Mc\Test;
use Mc\TestSuite;
use Mc\Filesystem\Manager as FilesystemManager;
use Mc\Filesystem\Path as FilesystemPath;
use Mc\Filesystem\Path as Path;
use Mc\Logger;

TestSuite::Create("001: test filesystem manager")->Add(
    Test::Create(
        "normalize test 1",
        function () {
            $logger = Logger::StdOut();
            $path = "./this/is/a/test/";
            $expectedResult = "./this/is/a/test/";

            $result = FilesystemManager::Normalize($path, FilesystemManager::US);
            $logger->Info("Path: {$result}");
            $logger->Info("Expected: {$expectedResult}");
            $logger->Info("Result: {$result}");
            Assert::equal($expectedResult, $result);
        }
    )
)->Add(
    Test::Create(
        "normalize test 2",
        function () {
            $path = ".\\this\\is\\another\\test\\";
            $expectedResult = "./this/is/another/test/";

            $result = FilesystemManager::normalize($path, FilesystemManager::US);
            Assert::equal($expectedResult, $result);
        }
    )
)->Add(
    Test::Create(
        "normalize test 3",
        function () {
            $path = "drive\\this/is\\another\\test\\";
            $expectedResult = "drive/this/is/another/test/";

            $result = FilesystemManager::Normalize($path, FilesystemManager::US);
            Assert::equal($expectedResult, $result);
        }
    )
)->Add(
    Test::Create(
        "parse path test",
        function () {
            $logger = Logger::StdOut();
            $path = "./this/is/a/test/with/cool/file.txt";
            $expectedRoot = "./this/is/a/test/with/cool";

            $root = FilesystemManager::Root($path, FilesystemManager::US);
            $logger->Info("Root: {$root}");
            $logger->Info("Expected: {$expectedRoot}");
            Assert::equal($expectedRoot, $root);
        }
    )
)->Add(
    Test::Create(
        "remove double slashes test",
        function () {
            $path = "./this////is/a/test\\\with///cool/file.txt";
            $expectedResult = "./this/is/a/test/with/cool/file.txt";

            $normalizedPath = FilesystemManager::Normalize($path, FilesystemManager::US);
            Assert::equal($expectedResult, $normalizedPath);
        }
    )
)->Add(
    Test::Create(
        "implode test",
        function () {
            $chunks = ["this", "is", "a", "test", "path"];
            $expectedPath = "this/is/a/test/path";

            $path = FilesystemManager::Implode($chunks, FilesystemManager::US);
            Assert::equal($expectedPath, $path);
        }
    )
)->Run();
