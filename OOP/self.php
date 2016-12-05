<?php
class selfCount
{
    private static $count = 0;

    public function __construct()
    {
        self::$count++;
    }

    /**
     * @return int
     */
    public static function getCount()
    {
        return self::$count;
    }
}

$a = new selfCount();
$b = new selfCount();
$c = new selfCount();

echo selfCount::getCount();