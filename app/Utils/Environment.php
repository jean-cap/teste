<?php


namespace App\Utils;


class Environment
{
    public static function load($dir)
    {
        $filename = "$dir/.env";

        if (!file_exists($filename)) {
            return false;
        }

        $lines = file($filename, FILE_IGNORE_NEW_LINES);

        foreach ($lines as $line) {
            putenv($line);
        }
    }
}