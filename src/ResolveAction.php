<?php

namespace Accolon\Functional;

trait ResolveAction
{
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
}
