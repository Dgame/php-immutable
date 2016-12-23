<?php

use function Dgame\Immutable\let;

require_once 'vendor/autoload.php';

print '<pre>';

function foo()
{
    try {
        let($b)->be(42);
        print $b . PHP_EOL;
//        $b = 42;
    } catch (Exception $e) {
        print $e->getMessage() . PHP_EOL;
    }
}

foo();

print 'end' . PHP_EOL;
