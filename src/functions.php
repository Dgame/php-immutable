<?php

namespace Dgame\Immutable;

/**
 * @param $ref
 *
 * @return Immutable
 */
function let(&$ref): Immutable
{
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
    $ref   = new Immutable($ref, $trace['file'], $trace['line']);

    return $ref;
}
