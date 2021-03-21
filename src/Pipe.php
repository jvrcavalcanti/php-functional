<?php

namespace Accolon\Functional;

class Pipe
{
    public function __construct(private mixed $value)
    {
        //
    }

    private function resolveAction(array|string|callable $action): \Closure
    {
        if (is_array($action) && is_string($action[0])) {
            return \Closure::fromCallable([new $action[0], $action[1]]);
        } elseif (is_array($action) && is_object($action[0])) {
            return \Closure::fromCallable([$action[0], $action[1]]);
        } elseif (is_string($action) || is_callable($action)) {
            return \Closure::fromCallable($action);
        }
    }

    public function on(array|string|callable $action, mixed ...$args): self
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
