<?php

use Accolon\Functional\Pipe;

class People
{
    public function __construct(private int $age = 18)
    {
        //
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge(int $age)
    {
        $this->age = $age;
        return $this->age;
    }
}

it('1 pipe Callable', function () {
    expect(
        pipe([2, 2])
        ->run(fn($arr) => array_sum($arr))
        ->getValue()
    )->toBe(4);
});

it('1 pipe String', function () {
    expect(
        pipe([2, 2])
        ->run('array_sum')
        ->getValue()
    )->toBe(4);
});

it('1 pipe Array Object', function () {
    $people = new People(18);

    expect(
        pipe(20)
        ->run([$people, 'setAge'])
        ->getValue()
    )->toBe(20);
});

it('1 pipe Array String', function () {
    expect(
        pipe(20)
        ->run([People::class, 'getAge'])
        ->getValue()
    )->toBe(18);
});

it('Multi args', function () {
    expect(
        pipe([2, 2])
        ->run('array_merge', [1, 3])
        ->getValue()
    )->toBe([2, 2, 1, 3]);
});

it('Multi pipes 1', function () {
    expect(
        pipe([2, 2])
        ->run('array_merge', [1, 3])
        ->run('array_sum')
        ->run('intval')
        ->getValue()
    )->toBe(8);
});

it('Multi pipes 2', function () {
    expect(
        pipe([2, 2])
        ->run('array_merge', [1, 3])
        ->run('array_sum')
        ->run(fn($sum) => $sum * $sum)
        ->getValue()
    )->toBe(64);
});
