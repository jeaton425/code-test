<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    /**
     * Test that requesting employees from School returns results
     */
    public function test_that_school_has_employees(): void
    {
    $client =  new \Wonde\Client(env('API_TOKEN'));
    $school = $client->school('A1930499544');
    $request = $school->employees->all();
    $this->assertNotEmpty($request);
    }

    /**
     * Test that requesting classes from School returns results
     */
    public function test_that_school_has_classes(): void
    {
    $client =  new \Wonde\Client(env('API_TOKEN'));
    $school = $client->school('A1930499544');
    $request = $school->classes->all();
    $this->assertNotEmpty($request);
    }

    /**
     * Test that requesting students from spesific class returns results
     */
    public function test_that_class_has_students(): void
    {
    $client =  new \Wonde\Client(env('API_TOKEN'));
    $school = $client->school('A1930499544');
    $request = $school->students->all();
    $this->assertNotEmpty($request);
    }
}
