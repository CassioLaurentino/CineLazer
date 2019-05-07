<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
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
                ->visit(route('login'))
                ->type('email', 'cassio.laurentino@compasso.com.br')
                ->type('password', 'C0nnect123')
                ->press('Sign In');
            $browser->assertSee('Dashboard');
        });
    }
}
