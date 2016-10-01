<?php

use function Dgame\Immutable\let;

require_once 'vendor/autoload.php';

function foo()
{
    let($b)->be(42);
    print $b . PHP_EOL;
    $b = 42;
}

try {
    foo();
} catch (Throwable $t) {
    print $t->getMessage();
}