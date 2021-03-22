<?php

namespace Accolon\Functional;

use Accolon\Functional\Traits\ResolveAction;

class Multi
{
    use ResolveAction;

    private array $results = [];
    private array $operations = [];

    public static function create(?string $name = null, mixed $value = null)
    {
        return new self($name, $value);
    }

    public function __construct(?string $name = null, mixed $value = null)
    {
        if (!is_null($name)) {
            $this->results[$name] = $value;
        }
    }

    public function add(string $name, array|callable $action): self
    {
        $this->operations[$name] = $this->resolveAction($action);
        return $this;
    }

    public function run(callable $callback)
    {
        foreach ($this->operations as $name => $operation) {
            $this->results[$name] = $this->resolveOperation($operation);
        }

        return $this->resolveOperation($callback);
    }

    private function resolveOperation(callable $operation)
    {
        $reflection = new \ReflectionFunction($operation);

        if (empty($reflection->getParameters())) {
            $this->results[$name] = $operation();
        }

        $params = [];

        foreach ($reflection->getParameters() as $param) {
            $params[] = $this->results[$param->getName()];
        }

        return $operation(...$params);
    }
}
