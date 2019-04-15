<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\User;
use App\Property;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createUser() {
        $u = factory(User::class)->create([
            'password' => bcrypt($password = 'limehome'),
        ]);
        return $u;
    }

    public function createProperty() {
        $p = factory(Property::class)->create();
        return $p;
    }

}
