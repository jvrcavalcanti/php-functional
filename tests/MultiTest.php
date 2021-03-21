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
        return $this;
    }

    public function save()
    {
        return true;
    }
}

it('User Multi', function () {
    $user = new User('no name');

    expect(
        Multi::create('user', $user)
        ->add('createUser', fn(User $user) => $user->save())
        ->add('updateUser', fn(User $user) => $user->setName('one name')->save())
        ->run(fn(bool $createUser, bool $updateUser) => $createUser === $updateUser)
    )->toBeTrue();
});
