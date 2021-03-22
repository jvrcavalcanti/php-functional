<?php

use Accolon\Functional\Pipe;

if (!function_exists('pipe')) {
    function pipe(mixed $value)
    {
        return new Pipe($value);
    }
}

if (!function_exists('map')) {
    function map(array $array, callable $callback)
    {
        $result = [];

        foreach ($array as $key => $value) {
            $result[$key] = $callback($value, $key, $array);
        }

        return $result;
    }
}

if (!function_exists('reduce')) {
    function reduce(array $array, callable $callback, mixed $initial = null)
    {
        $carry = $initial;

        foreach ($array as $key => $value) {
            $carry = $callback($carry, $value, $key, $array);
        }

        return $carry;
    }
}

if (!function_exists('filter')) {
    function filter(array $array, callable $callback)
    {
        $result = [];

        foreach ($array as $key => $value) {
            $passed = $callback($value, $key, $array);

            if ($passed) {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
