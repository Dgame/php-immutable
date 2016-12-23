<?php

namespace Dgame\Immutable;

use function Dgame\Ensurance\enforce;
use function Dgame\Ensurance\ensure;

/**
 * Class Immutable
 * @package Dgame\Immutable
 */
final class Immutable
{
    /**
     * @var string
     */
    private $file;
    /**
     * @var int
     */
    private $line = 0;
    /**
     * @var mixed
     */
    private $value;
    /**
     * @var bool
     */
    private $used = false;
    /**
     * @var mixed
     */
    private $ref;

    /**
     * ImmutableRef constructor.
     *
     * @param        $ref
     * @param string $file
     * @param int    $line
     */
    public function __construct(&$ref, string $file, int $line)
    {
        if (is_object($ref)) {
            ensure($ref)->isObject()->isNotInstanceOf(self::class)->orThrow('Tried to override immutable');
        }

        $this->ref  = &$ref;
        $this->file = $file;
        $this->line = $line;
    }

    /**
     *
     */
    public function __destruct()
    {
        enforce($this->used)->orThrow('Immutable was never used, declared in %s on line %d', $this->file, $this->line);
        ensure($this->ref)->isSameAs($this)->orThrow('Immutable was overridden, declared in %s on line %d', $this->file, $this->line);
        ensure($this->value)->isNotNull()->orThrow('Immutable was never assigned, declared in %s on line %d', $this->file, $this->line);
    }

    /**
     * @param $value
     */
    public function be($value)
    {
        ensure($this->value)->isNull()->orThrow('Immutable is already assigned, declared in %s on line %d', $this->file, $this->line);

        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        ensure($this->value)->isNotNull()->orThrow('Immutable is still not assigned, declared in %s on line %d', $this->file, $this->line);

        $this->used = true;

        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->get();
    }
}