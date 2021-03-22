<?php

namespace Accolon\Functional;

use Accolon\Functional\Traits\ResolveAction;

class Pipe
{
    use ResolveAction;

    public function __construct(private mixed $value)
    {
        //
    }

    public function run(array|string|callable $action, mixed ...$args): self
    {
        $this->value = $this->resolveAction($action)($this->value, ...$args);
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public static function create(mixed $value)
    {
        return new Pipe($value);
    }
}
