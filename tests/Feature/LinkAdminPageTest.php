<?php

use Illegal\Linky\Http\Middleware\EncryptCookies;
use Illegal\Linky\Http\Middleware\VerifyCsrfToken;
use Illegal\Linky\Tests\Authenticated;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Testing\WithFaker;

uses(WithFaker::class);

test('link page is not accessible without auth and redirect to login', function () {
    $this->get(route('linky.admin.link.index'))
        ->assertStatus(302)
        ->assertRedirect('/login')
        ->assertSessionDoesntHaveErrors();
});

test('link page is accessible with auth', function () {
    $this->withoutVite();
    $this->actingAs(Authenticated::user())
        ->get(route('linky.admin.link.index'))
        ->assertStatus(200);
});

