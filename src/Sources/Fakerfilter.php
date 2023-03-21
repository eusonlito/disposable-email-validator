<?php
namespace Eusonlito\DisposableEmail\Sources;

class Fakerfilter extends SourceInterface
{
    /**
     * @return array
     */
    public static function getDomains()
    {
        return static::remote('https://raw.githubusercontent.com/7c/fakefilter/main/txt/data.txt');
    }
}
