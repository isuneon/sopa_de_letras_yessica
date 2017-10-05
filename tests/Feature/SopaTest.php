<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SopaTest extends TestCase
{
    /**
     * A basic test example.
     * 
     * @return void
     */
    public function testExample()
    {
        $this->visit('/')
        ->type("OIE","palabra") 
        ->type("1","matriz")
        ->press('enviar')
        ->see(3);
    }
}
