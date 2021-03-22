<?php

namespace Accolon\Functional;

class Arr
{
    public function __construct(
        private array $values = []
    ) {
        //
    }

    public function each(callable $callback)
    {
        foreach ($this->values as $key => $value) {
            $callback($value, $key, $this->values);
        }

        return $this;
    }

    public function map(callable $callback)
    {
        $values = [];

        foreach ($this->values as $key => $value) {
            $values[$key] = $callback($value, $key, $this->values);
        }

        $this->values = $values;

        return $this;
    }

    public function filter(callable $callback)
    {
        $values = [];

        foreach ($this->values as $key => $value) {
            $result = $callback($value, $key, $this->values);

            if ($result) {
                $values[$key] = $value;
            }
        }

        $this->values = $values;

        return $this;
    }
}
