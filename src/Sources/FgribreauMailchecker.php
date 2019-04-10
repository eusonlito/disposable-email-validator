<?php
namespace Eusonlito\DisposableEmail\Sources;

class FgribreauMailchecker extends SourceInterface
{
    /**
     * @return array
     */
    public static function getDomains()
    {
        return static::file('fgribreau/mailchecker/list.txt');
    }
}
