<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function getUser(string $userName): ?User
    {
        return User::query()
            ->where('name', $userName)
            ->first();
    }
}
