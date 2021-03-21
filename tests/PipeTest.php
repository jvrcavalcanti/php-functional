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
        Pipe::create([2, 2])
        ->on(fn($arr) => array_sum($arr))
        ->getValue()
    )->toBe(4);
});

it('1 pipe String', function () {
    expect(
        Pipe::create([2, 2])
        ->on('array_sum')
        ->getValue()
    )->toBe(4);
});

it('1 pipe Array Object', function () {
    $people = new People(18);

    expect(
        Pipe::create(20)
        ->on([$people, 'setAge'])
        ->getValue()
    )->toBe(20);
});

it('1 pipe Array String', function () {
    expect(
        Pipe::create(20)
        ->on([People::class, 'getAge'])
        ->getValue()
    )->toBe(18);
});

it('Multi args', function () {
    expect(
        Pipe::create([2, 2])
        ->on('array_merge', [1, 3])
        ->getValue()
    )->toBe([2, 2, 1, 3]);
});

it('Multi pipes 1', function () {
    expect(
        Pipe::create([2, 2])
        ->on('array_merge', [1, 3])
        ->on('array_sum')
        ->on('intval')
        ->getValue()
    )->toBe(8);
});

it('Multi pipes 2', function () {
    expect(
        Pipe::create([2, 2])
        ->on('array_merge', [1, 3])
        ->on('array_sum')
        ->on(fn($sum) => $sum * $sum)
        ->getValue()
    )->toBe(64);
});
