<?php

namespace Tests;

use Tests\UserLogin;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, UserLogin;
}
