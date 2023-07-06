<?php

namespace Tests\Unit;
use App\Models\area_medica;

use PHPUnit\Framework\TestCase;

class DepartmentsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function list_departments(){
        $departamentos = area_medica::all();
        $this->assertTrue($departamentos);

    }
}
