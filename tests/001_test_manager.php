<?php

include_once __DIR__ . "/mc/logger.php";
include_once __DIR__ . "/mc/assert.php";
include_once __DIR__ . "/mc/test.php";
include_once __DIR__ . "/mc/testsuite.php";
include_once __DIR__ . "/../src/mc/filesystem/manager.php";

\mc\TestSuite::create("001: test filesystem manager")->add(
    \mc\Test::create(
        "normalize test 1",
        function () {
            $path = "./this/is/a/test/";
            $aspectedResult = "./this/is/a/test/";

            $result = \mc\filesystem\manager::normalize($path);
            \mc\Assert::equal($aspectedResult, $result);
        }
    )
)->add(
    \mc\Test::create(
        "normalize test 2",
        function () {
            $path = ".\\this\\is\\another\\test\\";
            $aspectedResult = "./this/is/another/test/";

            $result = \mc\filesystem\manager::normalize($path);
            \mc\Assert::equal($aspectedResult, $result);
        }
    )
)->add(
    \mc\Test::create(
        "normalize test 3",
        function () {
            $path = "drive\\this/is\\another\\test\\";
            $aspectedResult = "drive/this/is/another/test/";

            $result = \mc\filesystem\manager::normalize($path);
            \mc\Assert::equal($aspectedResult, $result);
        }
    )
)->add(
    \mc\Test::create(
        "parse path test",
        function () {
            $path = "./this/is/a/test/with/cool/file.txt";
            $aspectedRoot = "./this/is/a/test/with/cool";

            $normalizedPath = \mc\filesystem\manager::normalize($path);
            $root = \mc\filesystem\manager::root($normalizedPath);
            \mc\Assert::equal($aspectedRoot, $root);
        }
    )
)->add(
    \mc\Test::create(
        "implode test",
        function () {
            $chunks = ["this", "is", "a", "test", "path"];
            $aspectedPath = "this/is/a/test/path";

            $path = \mc\filesystem\manager::implode($chunks);
            \mc\Assert::equal($aspectedPath, $path);
        }
    )
)->run();
