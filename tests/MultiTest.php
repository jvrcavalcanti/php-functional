<?php

use Accolon\Functional\Multi;

class User
{
    public function __construct(
        private string $name
    ) {
        //
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function save()
    {
        return true;
    }
}

it('Simple Multi', function () {
    $user = new User('no name');

    expect(
        Multi::create('user', $user)
        ->add('saveUser', fn(User $user) => $user->save())
        ->run(fn(bool $saveUser) => $saveUser)
    )->toBeTrue();
});
