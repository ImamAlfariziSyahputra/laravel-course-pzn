<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession()
    {
        $this->get('/session/create')
            ->assertSeeText('OK')
            ->assertSessionHas('userId', 'ahok')
            ->assertSessionHas('isMember', true);
    }

    public function testGetSession()
    {
        $this->withSession([
            'userId' => 'ahok',
            'isMember' => 'true',
        ])
            ->get('/session/get')
            ->assertSeeText('User Id: ahok, Is Member: true');
    }

    public function testGetSessionFailed()
    {
        $this->withSession([])
            ->get('/session/get')
            ->assertSeeText('User Id: unknown, Is Member: false');
    }
}
