<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterUserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(route('register'))
                ->assertSee('Register a new membership')
                ->type('name', 'Teste Register User')
                ->type('email', 'registerUser9@test.com')
                ->type('password', '12345678')
                ->type('password_confirmation', '12345678')
                ->press('.btn')
                ->assertUrlIs('http://localhost:8000/home');
        });

        $this->assertDatabaseHas('users', [
            'email' => 'registerUser@test.com'
        ]);
    }
}
