<?php

namespace Tests\Unit;
use App\Models\area_medica;

use PHPUnit\Framework\TestCase;

class DepartmentTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);

        $departamentos = area_medica::all();
    }
}
